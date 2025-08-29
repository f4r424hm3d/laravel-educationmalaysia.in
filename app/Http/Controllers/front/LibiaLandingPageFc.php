<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CourseCategory;
use App\Models\LandingPage;
use App\Models\LandingPageUniversity;
use App\Models\Lead;
use App\Models\Level;
use App\Models\University;
use App\Models\UniversityProgram;
use App\Rules\MathCaptchaValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class LibiaLandingPageFc extends Controller
{
  public function index(Request $request)
  {
    $page_slug = $request->segment(2);
    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    $pageDetail = LandingPage::where(['page_slug' => $page_slug])->firstOrFail();

    $universityIds = $pageDetail->universities->pluck('university_id')->toArray();

    $result = [];

    if ($pageDetail) {
      $universityIds = $pageDetail->universities->pluck('university_id')->toArray();

      $universityCourses = UniversityProgram::whereIn('university_id', $universityIds)
        ->with(['category:id,name', 'getSpecialization:id,name']) // Load category and specialization names
        ->get()
        ->groupBy('course_category_id');

      // Prepare structured data for the view
      foreach ($universityCourses as $course_category_id => $specializations) {
        $categoryName = optional($specializations->first()->category)->name;
        $uniqueSpecializations = $specializations->unique('specialization_id')->map(function ($program) {
          return optional($program->getSpecialization)->name;
        })->filter()->toArray(); // Remove null values

        $result[] = [
          'category_name' => $categoryName,
          'specializations' => $uniqueSpecializations,
        ];
      }
    }

    $countries = Country::orderBy('name', 'ASC')->get();
    $phonecodes = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
    $levels = Level::all();
    $categories = CourseCategory::all();

    if (old('university') && old('university') != null) {
      $programs = UniversityProgram::where(['university_id' => old('university')])->get();
    } else {
      $programs = null;
    }

    $curCountry = '';

    $data = compact('captcha', 'pageDetail', 'countries', 'phonecodes', 'levels', 'programs', 'curCountry', 'categories', 'result');
    return view('front.education-fair-in-libia-2025')->with($data);
  }
  public function courses(Request $request)
  {
    return view('front.libya-courses');
  }
  public function institutions(Request $request)
  {
    $page_slug = $request->segment(2);
    $pageDetail = LandingPage::where(['page_slug' => $page_slug])->first();
    $universities = LandingPageUniversity::where(['landing_page_id' => $pageDetail->id])->get();
    $data = compact('pageDetail', 'universities');
    return view('front.libya-institutions')->with($data);
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
    $password = Str::random(10);
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
        'nationality' => 'required'
      ]
    );
    $university = University::find($request->university);
    $field = new Lead();
    $field->name = $request['name'];
    $field->email = $request['email'];
    $field->country_code = $request['country_code'];
    $field->mobile = $request['mobile'];
    $field->highest_qualification = $request['highest_qualification'];
    $field->interested_course_category = $request->program;
    $field->interested_program = $request->program;
    $field->nationality = $request['nationality'];
    $field->password = $password;
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
