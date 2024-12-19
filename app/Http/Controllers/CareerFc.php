<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\JobApplication;
use App\Rules\MathCaptchaValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CareerFc extends Controller
{
  public function index(Request $request)
  {
    $jobs = Career::active()->get();
    $experienceList = ['Less than 1 year', '1-2 Year', '2-3 Year', '3-4 Year', 'More than 5'];

    $question = generateMathQuestion();
    session(['captcha_answer' => $question['answer']]);

    $data = compact('jobs', 'experienceList', 'question');
    return view('front.career')->with($data);
  }
  public function apply(Request $request)
  {
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'captcha_answer' => ['required', 'numeric', new MathCaptchaValidationRule()],
        'position' => 'required|numeric',
        'name' => [
          'required',
          'regex:/^[a-zA-Z\s]+$/u', // Allow only alphabetic characters and spaces
        ],
        'mobile' => 'required|numeric',
        'email' => 'required|email',
        'experience' => 'required',
        'resume' => 'required|max:1024|mimes:pdf',
        'message' => [
          'nullable',
          'string',
          'max:500', // You can adjust the max length as needed
          'regex:/^[a-zA-Z0-9\s!@#$%^&*(),.?:"{}|<>]+$/',
        ],
      ]
    );
    $field = new JobApplication();
    $field->name = $request['name'];
    $field->mobile = $request['mobile'];
    $field->email = $request['email'];
    $field->experience = $request['experience'];
    $field->message = $request['message'];
    $field->position_id = $request['position'];
    if ($request->hasFile('resume')) {
      $fileOriginalName = $request->file('resume')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('resume')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('resume')->move('uploads/resume/', $file_name);
      if ($move) {
        $field->resume = $file_name;
        $field->resume_path = 'uploads/resume/' . $file_name;
      }
    }
    $field->save();
    session()->flash('smsg', 'Your Job Application has been submitted succesfully. We will contact you soon.');

    $position = Career::find($request['position']);

    $emaildata = [
      'name' => $request['name'],
      'email' => $request['email'],
      'mobile' => $request['mobile'],
      'experience' => $request['experience'],
      'inquiry_message' => $request['message'],
      'position' => $position->designation,
    ];
    $dd = ['to' => $request['email'], 'to_name' => $request['name'], 'subject' => 'Job Application | ' . $position->designation];

    Mail::send(
      'mails.job-application-reply',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);
      }
    );

    $dd2 = ['to' => TO_EMAIL, 'cc' => CC_EMAIL, 'to_name' => TO_NAME, 'cc_name' => CC_NAME, 'subject' => 'New Job Application | ' . $position->designation, 'resume' => $field->resume_path];

    Mail::send(
      'mails.job-application-mail-to-team',
      $emaildata,
      function ($message) use ($dd2) {
        $message->to($dd2['to'], $dd2['to_name']);
        $message->cc($dd2['cc'], $dd2['cc_name']);
        $message->subject($dd2['subject']);
        $message->priority(1);
        // Attach a file to the email
        $message->attach($dd2['resume'], [
          'mime' => 'application/pdf',
        ]);
      }
    );

    // $api_url = "https://www.tutelagestudy.com/crm/Api/submitInquiryFromTutelageWeb";
    // $form_data = $emaildata;
    // //echo json_encode($form_data, true);
    // $client = curl_init($api_url);
    // curl_setopt($client, CURLOPT_POST, true);
    // curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
    // curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    // $response = curl_exec($client);
    // curl_close($client);

    session()->flash('smsg', 'Your application has been submitted successfully.');
    return redirect('career');
  }
  public function thankYou(Request $request)
  {
    return view('front.thank-you-career');
  }
}
