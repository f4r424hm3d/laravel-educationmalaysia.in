<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\AsignedLead;
use App\Models\StudentApplication;
use App\Models\Country;
use App\Models\CourseCategory;
use App\Models\Level;
use App\Models\Lead;
use App\Models\UniversityProgram;
use App\Models\User;
use App\Rules\MathCaptchaValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use RuntimeException;

class StudentLoginFc extends Controller
{
  public function signUp(Request $request)
  {
    $url = url('sign-up');
    $countries = Country::orderBy('name', 'ASC')->get();
    $phonecodes = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
    $levels = Level::groupBy('level')->orderBy('level', 'ASC')->get();
    $course_categories = CourseCategory::orderBy('name', 'asc')->get();

    $question = generateMathQuestion();
    session(['captcha_answer' => $question['answer']]);

    $data = compact('url', 'countries', 'phonecodes', 'levels', 'course_categories', 'question');
    return view('front.student.sign-up')->with($data);
  }
  public function register(Request $request)
  {
    // printArray($request->all());
    // die;
    $seg1 = $request['return_to'] != null ? 'return_to=' . $request['return_to'] : null;
    $return_url = 'sign-up?' . $seg1;
    $otp = rand(1000, 9999);
    $otp_expire_at = date("YmdHis", strtotime("+15 minutes"));
    $request->validate(
      [
        'captcha_answer' => ['required', 'numeric', new MathCaptchaValidationRule()],
        'name' => 'required|regex:/^[a-zA-Z ]*$/',
        'email' => [
          'required',
          'email',
          Rule::unique('leads', 'email')->where('website', site_var),
        ],
        'country_code' => 'required|numeric',
        'mobile' => 'required|numeric',
        'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols()],
        'confirm_password' => 'required|same:password',
        'highest_qualification' => 'required',
        'interested_course_category' => 'required',
        'nationality' => 'required'
      ]
    );
    $field = new Lead();
    $field->name = $request['name'];
    $field->email = $request['email'];
    $field->highest_qualification = $request['highest_qualification'];
    $field->interested_course_category = $request['interested_course_category'];
    $field->nationality = $request['nationality'];
    $field->country_code = $request['country_code'];
    $field->mobile = $request['mobile'];
    $field->password = $request['password'];
    $field->source = 'Education Malaysia - Signup';
    $field->source_path = $request->source_path;
    $field->otp = $otp;
    $field->otp_expire_at = $otp_expire_at;
    $field->status = 0;
    $field->website = site_var;

    $emaildata = ['name' => $request['name'], 'otp' => $otp];
    $dd = ['to' => $request['email'], 'to_name' => $request['name'], 'subject' => 'OTP'];

    $chk = Mail::send(
      'mails.send-otp',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject('OTP');
        $message->priority(1);
      }
    );
    if ($chk == false) {
      $emsg = 'Sorry! Please try again latter';
      session()->flash('emsg', $emsg);
      return redirect($return_url);
    } else {
      $field->save();

      AsignedLead::autoAssign($field->id);

      session()->flash('smsg', 'An OTP has been send to your registered email address.');
      $request->session()->put('last_id', $field->id);
      if ($request['program_id'] != null) {
        return redirect('confirmed-email?' . $seg1 . '&program_id=' . $request['program_id']);
      } else {
        return redirect('confirmed-email?' . $seg1);
      }
    }
  }
  public function confirmedEmail()
  {
    return view('front.student.confirmed-email-form');
  }
  public function submitOtp(Request $request)
  {
    //printArray($request->all());
    $seg1 = $request['return_to'] != null ? 'return_to=' . $request['return_to'] : null;
    $return_url = 'sign-up?' . $seg1;
    $result = Lead::find($request['id']);
    $current_time = date("YmdHis");
    if ($result->otp == $request['otp']) {
      if ($current_time > $result->otp_expire_at) {
        $otp_expire_at = date("YmdHis", strtotime("+15 minute"));
        $new_otp = rand(1000, 9999);
        $result->otp = $new_otp;
        $result->otp_expire_at = $otp_expire_at;
        $result->save();
        session()->flash('smsg', 'OTP expired. New OTP has been send to your email id.');
        if ($request['program_id'] != null) {
          return redirect('confirmed-email?' . $seg1 . '&program_id=' . $request['program_id']);
        } else {
          return redirect('confirmed-email?' . $seg1);
        }
      } else {
        $result->otp = null;
        $result->otp_expire_at = null;
        $result->email_verified_at = date("Y-m-d H:i:s");
        $result->email_verified = 1;
        $result->registered = 1;
        $result->status = 1;
        $result->save();
        session()->flash('smsg', 'Email verified. Succesfully logged in.');
        $request->session()->put('studentLoggedIn', true);
        $request->session()->put('student_id', $request->session()->get('last_id'));
        if ($request->has('program_id') && $request->program_id != null) {
          $program_id = $request->program_id;
          $chkProg = UniversityProgram::where('id', $program_id)->first();
          if ($chkProg != null) {
            $where = ['prog_id' => $program_id, 'stdid' => $request->session()->get('last_id')];
            $check = StudentApplication::where($where)->count();
            if ($check == 0) {
              $field = new StudentApplication();
              $field->prog_id = $request->program_id;
              $field->stdid = session()->get('student_id');
              $field->status = 1;
              $field->website = site_var;
              $field->save();
              session()->flash('smsg', 'Congratulation! You succesfully Applied for ' . $chkProg->course_name);
            }
          }
        }

        $emaildata = ['name' => $result['name']];
        $dd = ['to' => $result['email'], 'to_name' => $result['name'], 'subject' => 'Successfully registration on Education Malaysia.'];

        Mail::send(
          'mails.student-welcome-mail',
          $emaildata,
          function ($message) use ($dd) {
            $message->to($dd['to'], $dd['to_name']);
            $message->subject($dd['subject']);
            $message->priority(1);
          }
        );

        if ($request['return_to'] != null) {
          return redirect($request['return_to']);
        } else {
          return redirect('student/profile');
        }
      }
    } else {
      session()->flash('emsg', 'Enter incorrect OTP');
      if ($request['program_id'] != null) {
        return redirect('confirmed-email?' . $seg1 . '&program_id=' . $request['program_id']);
      } else {
        return redirect('confirmed-email?' . $seg1);
      }
    }
  }
  public function login()
  {
    return view('front.student.sign-in');
  }
  public function signin(Request $request)
  {
    $seg1 = $request['return_to'] != null ? 'return_to=' . $request['return_to'] : null;
    $seg2 = $request['program_id'] != null ? 'program_id=' . $request['program_id'] : null;
    $return_url = 'sign-in?' . $seg1 . ($seg2 != null ? '&' . $seg2 : '');

    $field = Lead::whereEmail($request['email'])->first();

    if (is_null($field)) {
      session()->flash('emsg', 'Email address does not exist.');
      return redirect($return_url);
    }

    if ($field->status != 1) {
      return $this->sendOtp($field, $return_url);
      //return;
    }

    $password = $request->password;

    try {
      // Check if the password matches (for Bcrypt-hashed passwords)
      if (Hash::check($password, $field->password)) {
        $this->updateLoginDetails($field, $request);
        return redirect($request['return_to'] ?? 'student/profile');
      }
    } catch (RuntimeException $e) {
      // Handle cases where Hash::check() throws an exception
    }

    // Additional check for legacy or plain text passwords (if applicable)
    if ($field->password === $password) {
      // Rehash the plain text password with Bcrypt and save
      $field->password = Hash::make($password);
      $field->save();

      $this->updateLoginDetails($field, $request);
      return redirect($request['return_to'] ?? 'student/profile');
    } else {
      // Password does not match (generic error message)
      session()->flash('emsg', 'Password is incorrect.');
    }


    return redirect($return_url);
  }

  private function updateLoginDetails($field, $request)
  {
    $field->login_count = ($field->login_count ?? 0) + 1;
    $field->last_login = now();
    $field->save();

    session()->flash('smsg', 'Successfully logged in.');
    $request->session()->put('studentLoggedIn', true);
    $request->session()->put('student_id', $field->id);

    if ($request->has('program_id') && $request->program_id != null) {
      $program_id = $request->program_id;
      $chkProg = UniversityProgram::where('id', $program_id)->first();
      if ($chkProg != null) {
        $where = ['prog_id' => $program_id, 'stdid' => $field->id];
        $check = StudentApplication::where($where)->count();
        if ($check == 0) {
          $application = new StudentApplication();
          $application->prog_id = $program_id;
          $application->stdid = $field->id;
          $application->status = 1;
          $application->website = site_var;
          $application->save();
          session()->flash('smsg', 'Congratulations! You successfully applied for ' . $chkProg->course_name);
        }
      }
    }
  }

  private function sendOtp($field, $return_url)
  {
    $otp = rand(1000, 9999);
    $otp_expire_at = now()->addMinutes(15);

    $emaildata = ['name' => $field->name, 'otp' => $otp];
    $dd = ['to' => $field->email, 'to_name' => $field->name, 'subject' => 'Email OTP'];

    $result = Mail::send(
      'mails.send-otp',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);
      }
    );

    if ($result == false) {
      session()->flash('emsg', 'Sorry! Please try again later.');
      return redirect($return_url);
    } else {
      $field->otp = $otp;
      $field->otp_expire_at = $otp_expire_at;
      $field->save();
      session()->flash('smsg', 'An OTP has been sent to your registered email. It will expire in 15 minutes.');
      session()->put('last_id', $field->id);
      return redirect('confirmed-email');
    }
  }

  public function sendMail()
  {
    $emaildata = ['name' => 'Mohd Faraz', 'otp' => '1278'];
    $dd = ['to' => 'farazahmad280@gmail.com', 'subject' => 'OTP'];
    Mail::send('mails.send-otp', $emaildata, function ($message) use ($dd) {
      $message->to($dd['to']);
      $message->from('info@mudraeducation.org', 'Mudra Education');
      $message->subject($dd['subject']);
    });
  }
  public function viewForgetPassword()
  {
    return view('front.student.forget-password');
  }

  public function forgetPassword(Request $request)
  {
    // printArray($request->all());
    // die;
    $remember_token = Str::random(45);
    $otp_expire_at = date("YmdHis", strtotime("+15 minutes"));
    $field = Lead::whereEmail($request['email'])->first();
    if (is_null($field)) {
      session()->flash('emsg', 'Entered wrong email address. Please check.');
      return redirect('account/password/reset');
    } else {
      $login_link = url('email-login/?uid=' . $field->id . '&token=' . $remember_token);

      $reset_password_link = url('password/reset/?uid=' . $field->id . '&token=' . $remember_token);

      $emaildata = ['name' => $field->name, 'id' => $field->id, 'remember_token' => $remember_token, 'login_link' => $login_link, 'reset_password_link' => $reset_password_link];

      $dd = ['to' => $request['email'], 'to_name' => $field->name, 'subject' => 'Password Reset'];

      $chk = Mail::send(
        'mails.forget-password-link',
        $emaildata,
        function ($message) use ($dd) {
          $message->to($dd['to'], $dd['to_name']);
          $message->subject($dd['subject']);
          $message->priority(1);
        }
      );
      if ($chk == false) {
        $emsg = 'Sorry! Please try again latter';
        session()->flash('emsg', $emsg);
        return redirect('account/password/reset');
      } else {
        $field->remember_token = $remember_token;
        $field->otp_expire_at = $otp_expire_at;
        $field->save();
        $request->session()->put('forget_password_email', $request['email']);
        return redirect('forget-password/email-sent');
      }
    }
  }

  public function emailSent()
  {
    return view('front.student.email-sent');
  }

  public function emailLogin(Request $request)
  {
    //printArray($request->all());
    //die;
    $id = $request['uid'];
    $remember_token = $request['token'];
    $where = ['id' => $id, 'remember_token' => $remember_token];
    $field = Lead::where($where)->first();
    $current_time = date("YmdHis");
    //printArray($field->all());
    if (is_null($field)) {
      return redirect('account/invalid_link');
    } else {
      if ($current_time > $field->otp_expire_at) {
        return redirect('account/invalid_link');
      } else {
        $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
        $field->login_count = $lc;
        $field->last_login = date("Y-m-d H:i:s");
        $field->remember_token = null;
        $field->otp_expire_at = null;
        $field->save();
        session()->flash('smsg', 'Succesfully logged in');
        $request->session()->put('studentLoggedIn', true);
        $request->session()->put('student_id', $field->id);
        return redirect('student/profile');
      }
    }
  }

  public function invalidLink()
  {
    return view('front.student.invalid-link');
  }
  public function viewResetPassword(Request $request)
  {
    //printArray($request->all());
    //die;
    $id = $request['uid'];
    $remember_token = $request['token'];
    $where = ['id' => $id, 'remember_token' => $remember_token];
    $field = Lead::where($where)->first();
    $current_time = date("YmdHis");
    //printArray($field->all());
    if (is_null($field)) {
      return redirect('account/invalid_link');
    } else {
      return view('front.student.reset-password');
    }
  }
  public function resetPassword(Request $request)
  {
    //printArray($request->all());
    //die;
    $request->validate(
      [
        'new_password' => 'required|min:8',
        'confirm_new_password' => 'required|min:8|same:new_password'
      ]
    );
    $id = $request['id'];
    $remember_token = $request['remember_token'];
    $where = ['id' => $id, 'remember_token' => $remember_token];
    $field = Lead::where($where)->first();
    $current_time = date("YmdHis");
    //printArray($field->all());
    if (is_null($field)) {
      return redirect('account/invalid_link');
    } else {
      if ($current_time > $field->otp_expire_at) {
        return redirect('account/invalid_link');
      } else {
        $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
        $field->login_count = $lc;
        $field->last_login = date("Y-m-d H:i:s");
        $field->remember_token = null;
        $field->otp_expire_at = null;
        $field->password = $request['new_password'];
        $field->save();
        session()->flash('smsg', 'Succesfully logged in');
        $request->session()->put('studentLoggedIn', true);
        $request->session()->put('student_id', $field->id);
        return redirect('student/profile');
      }
    }
  }
}
