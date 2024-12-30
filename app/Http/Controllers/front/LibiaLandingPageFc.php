<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\LandingPage;
use App\Models\Lead;
use App\Models\Level;
use App\Models\University;
use App\Models\UniversityProgram;
use App\Rules\MathCaptchaValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class LibiaLandingPageFc extends Controller
{
  public function index(Request $request)
  {
    $page_slug = $request->segment(1);
    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    $pageDetail = LandingPage::where(['page_slug' => $page_slug])->first();

    $countries = Country::orderBy('name', 'ASC')->get();
    $phonecodes = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
    $levels = Level::all();

    if (old('university') && old('university') != null) {
      $programs = UniversityProgram::where(['university_id' => old('university')])->get();
    } else {
      $programs = null;
    }

    // Get user IP
    //$userIP = $request->ip();

    // Get country details using ipinfo.io
    // $response = file_get_contents("http://ipinfo.io/{$userIP}/json");
    // $details = json_decode($response, true);
    //$curCountry = $details['country'] ?? 'Unknown';
    $curCountry = '';

    $data = compact('captcha', 'pageDetail', 'countries', 'phonecodes', 'levels', 'programs', 'curCountry');
    return view('front.education-fair-in-libia-2025')->with($data);
  }
  public function getProgramsByUniversity(Request $request)
  {
    $university_id = $request->university_id;
    $output = '<option>Select Program</option>';
    if (!empty($university_id)) {
      $programs = UniversityProgram::where('university_id', $university_id)->get();

      if (!empty($programs)) {
        foreach ($programs as $row) {
          $output .= '<option value="' . $row->course_name . '">' . $row->course_name . '</option>';
        }
      }
    }
    echo $output;
  }

  public function register(Request $request)
  {
    $otp = rand(1000, 9999);
    $otp_expire_at = date("YmdHis", strtotime("+5 minutes"));
    $request->validate(
      [
        'captcha_answer' => ['required', 'numeric', new MathCaptchaValidationRule()],
        'name' => 'required|regex:/^[a-zA-Z ]*$/',
        'email' => [
          'required',
          'email',
          Rule::unique('leads', 'email')->where('website', site_var),
        ],
        'c_code' => 'required|numeric',
        'mobile' => 'required|numeric',
        'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols()],
        'confirm_password' => 'required|same:password',
        'highest_qualification' => 'required',
        'university' => 'required',
        'nationality' => 'required'
      ]
    );
    $university = University::find($request->university);
    $field = new Lead();
    $field->name = $request['name'];
    $field->email = $request['email'];
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->highest_qualification = $request['highest_qualification'];
    $field->intrested_university = $university->name;
    $field->intrested_subject = $request->program;
    $field->interested_program = $request->program;
    $field->nationality = $request['nationality'];
    $field->password = $request['password'];
    $field->source = $request->source;
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
      $emsg = 'Sorry! Please try again later';
      session()->flash('emsg', $emsg);
      return redirect($request->return_path);
    } else {
      $field->save();
      session()->flash('smsg', 'An OTP has been send to your registered email address.');
      $request->session()->put('last_id', $field->id);
      return redirect('confirmed-email');
    }
  }
}
