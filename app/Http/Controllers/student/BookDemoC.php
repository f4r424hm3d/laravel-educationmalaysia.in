<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CourseCategory;
use App\Models\Destination;
use App\Models\Level;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Rules\MathCaptchaValidationRule;

class BookDemoC extends Controller
{
  public function index(Request $request)
  {
    $levels = Level::all();
    $destinations = Destination::all();
    $countries = Country::where('phonecode', '!=', '0')->orderBy('phonecode')->get();

    $question = generateMathQuestion();
    //printArray($question);
    session(['captcha_answer' => $question['answer']]);

    $data = compact('levels', 'countries', 'destinations', 'question');
    return view('front.book-demo')->with($data);
  }
  public function saveInfo(Request $request)
  {
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'captcha_answer' => ['required', 'numeric', new MathCaptchaValidationRule()],
        'degree_planning_to_study' => 'required',
        'preferred_destination' => 'required',
        'year_planning_to_study' => 'required',
        'intrested_in_paid_counselling' => 'required',
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'country_code' => 'required|string|max:10',
        'mobile' => 'required|string|regex:/^\d{6,15}$/'
      ]
    );

    $field = new Student();
    $field->preferred_destination = $request['preferred_destination'];
    $field->degree_planning_to_study = $request['degree_planning_to_study'];
    $field->year_planning_to_study = $request['year_planning_to_study'];
    $field->intrested_in_paid_counselling = $request['intrested_in_paid_counselling'];
    $field->name = $request['name'];
    $field->email = $request['email'];
    $field->country_code = $request['country_code'];
    $field->mobile = $request['mobile'];
    $field->status = 0;
    $field->source_path = $request->source_path;
    $field->save();

    $form_data = [
      'website' => 'BRI',
      'name' => $request['name'],
      'email' => $request['email'],
      'country_code' => $request['country_code'],
      'mobile' => $request['mobile'],
      'preferred_destination' => $request['preferred_destination'],
      'interested_course_category' => $request['degree_planning_to_study'],
      'source' => 'Education Malaysia Book Demo',
    ];


    $api_url = "https://www.crm.educationmalaysia.in/api/lead-from-britannica-overseas-book-demo";
    $client = curl_init($api_url);
    curl_setopt($client, CURLOPT_POST, true);
    curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);

    $last_id = $field->id;
    session()->put('last_id', $last_id);
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('book-slot');
  }
  public function bookSlot(Request $request)
  {
    $courseCategories = CourseCategory::all();
    $countries = Country::where('phonecode', '!=', '0')->orderBy('phonecode')->get();
    $sajs = ['Just starting, research phase', 'Shortlisting colleges, planning tests', 'Tests done, finalising shortlist', 'Applied to a few colleges', 'Applications done, awaiting admit', 'Admits Received'];
    $data = compact('courseCategories', 'countries', 'sajs');
    return view('front.book-demo-slot')->with($data);
  }
  public function saveSlot(Request $request)
  {
    // printArray($request->toArray());
    // die;
    $otp = rand(1000, 9999);
    $otp_expire_at = date("YmdHis", strtotime("+5 minutes"));
    $request->validate(
      [
        'preferred_counselling_date' => 'required|date',
        'preferred_counselling_time' => 'required|date_format:H:i',
        'intrested_course_category' => 'required',
        'study_abroad_journey_status' => 'required'
      ]
    );
    $field = Student::find(session()->get('last_id'));
    $field->preferred_counselling_date = $request['preferred_counselling_date'];
    $field->preferred_counselling_time = $request['preferred_counselling_time'];
    $field->intrested_course_category = $request['intrested_course_category'];
    $field->study_abroad_journey_status = $request['study_abroad_journey_status'];
    $field->otp = $otp;
    $field->otp_expire_at = $otp_expire_at;
    $field->save();

    $emaildata = ['name' => $field->name, 'otp' => $field->otp];
    $dd = ['to' => $field->email, 'to_name' => $field->name, 'subject' => 'OTP'];

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
      $emsg = response()->Fail('Sorry! Please try again latter');
      session()->flash('emsg', $emsg);
    } else {
      session()->flash('smsg', 'An OTP has been send to your registered email address.');
    }
    return redirect('book-demo/verify-email');
  }

  public function verifyEmail(Request $request)
  {
    $student = Student::find(session()->get('last_id'));
    $data = compact('student');
    return view('front.book-demo-verify-email')->with($data);
  }
  public function submitOTP(Request $request)
  {
    $result = Student::find(session()->get('last_id'));
    $current_time = date("YmdHis");
    if ($result->otp == $request['otp']) {
      if ($current_time > $result->otp_expire_at) {
        $otp_expire_at = date("YmdHis", strtotime("+5 minute"));
        $new_otp = rand(1000, 9999);
        $result->otp = $new_otp;
        $result->otp_expire_at = $otp_expire_at;
        $result->save();
        $emaildata = ['name' => $result->name, 'otp' => $result->otp];
        $dd = ['to' => $result->email, 'to_name' => $result->name, 'subject' => 'OTP'];

        $chk = Mail::send(
          'mails.send-otp',
          $emaildata,
          function ($message) use ($dd) {
            $message->to($dd['to'], $dd['to_name']);
            $message->subject('OTP');
            $message->priority(1);
          }
        );
        session()->flash('emsg', 'OTP expired. New OTP has been send to your email id.');
        return redirect('book-demo/verify-email');
      } else {
        $result->otp = null;
        $result->otp_expire_at = null;
        $result->email_verified_at = date("Y-m-d H:i:s");
        $result->email_verified = 1;
        $result->status = 1;
        $result->lead_type = 'new';
        $result->source = 'book demo';
        $result->save();
        session()->flash('smsg', 'Email verified.');
        //$request->session()->put('studentLoggedIn', true);
        //$request->session()->put('student_id', $request->session()->get('last_id'));
        $this->sentEnquiryToTeam();
        return redirect('book-demo/thank-you');
      }
    } else {
      session()->flash('emsg', 'Enter incorrect OTP');
      return redirect('book-demo/verify-email');
    }
  }

  public function thankYou(Request $request)
  {
    $student = Student::find(session()->get('last_id'));
    $data = compact('student');
    return view('front.book-demo-thank-you')->with($data);
  }
  public function sentEnquiryToTeam()
  {
    $student = Student::find(session()->get('last_id'));

    $emaildata2 = [
      'name' => $student->name,
      'email' => $student->email,
      'country_code' => $student->country_code,
      'mobile' => $student->mobile,
      'preferred_counselling_date' => $student->preferred_counselling_date,
      'preferred_counselling_time' => $student->preferred_counselling_time,
      'preferred_destination' => $student->preferred_destination,
      'degree_planning_to_study' => $student->degree_planning_to_study,
      'year_planning_to_study' => $student->year_planning_to_study,
      'intrested_in_paid_counselling' => $student->intrested_in_paid_counselling,
      'source_path' => $student->source_path,
    ];

    $dd2 = ['to' => TO_EMAIL, 'cc' => CC_EMAIL, 'to_name' => TO_NAME, 'cc_name' => CC_NAME, 'subject' => 'New Inquiry'];

    Mail::send(
      'mails.book-demo-to-team',
      $emaildata2,
      function ($message) use ($dd2) {
        $message->to($dd2['to'], $dd2['to_name']);
        $message->cc($dd2['cc'], $dd2['cc_name']);
        $message->subject($dd2['subject']);
        $message->priority(1);
      }
    );
  }
}
