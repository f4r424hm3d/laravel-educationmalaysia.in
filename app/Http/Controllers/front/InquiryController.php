<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Rules\MathCaptchaValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
  public function examPage(Request $request)
  {
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'captcha_answer' => ['required', 'numeric', new MathCaptchaValidationRule()],
        'name' => 'required',
        'source' => 'required',
        'source_path' => 'required',
        'c_code' => 'required|numeric',
        'mobile' => 'required|numeric',
        'email' => 'required|email',
      ]
    );
    $field = new Student();
    $field->name = $request['name'];
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->email = $request['email'];
    $field->source =  $request['source'];
    $field->source_path =  $request['source_path'];
    $field->save();
    session()->flash('smsg', 'Your inquiry has been submitted succesfully. We will contact you soon.');

    $form_data = [
      'website' => 'BRI',
      'name' => $request['name'],
      'email' => $request['email'],
      'c_code' => $request['c_code'],
      'mobile' => $request['mobile'],
      'source' => 'Education Malaysia Exam Page Enquiry',
    ];


    $api_url = "https://www.crm.educationmalaysia.in/api/lead-from-britannica-overseas-book-demo";
    $client = curl_init($api_url);
    curl_setopt($client, CURLOPT_POST, true);
    curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);

    $emaildata = [
      'name' => $request['name'],
      'email' => $request['email'],
      'c_code' => $request['c_code'],
      'mobile' => $request['mobile'],
      'intrest' => $request['intrest'],
    ];
    $dd = ['to' => $request['email'], 'to_name' => $request['name'], 'subject' => 'Inquiry'];

    Mail::send(
      'mails.inquiry-reply',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);
      }
    );

    $emaildata2 = [
      'name' => $request['name'],
      'email' => $request['email'],
      'c_code' => $request['c_code'],
      'mobile' => $request['mobile'],
      'intrest' => $request['intrest'],
    ];

    $dd2 = ['to' => TO_EMAIL, 'cc' => CC_EMAIL, 'to_name' => TO_NAME, 'cc_name' => CC_NAME, 'subject' => 'New Inquiry'];

    Mail::send(
      'mails.inquiry-mail-to-team',
      $emaildata2,
      function ($message) use ($dd2) {
        $message->to($dd2['to'], $dd2['to_name']);
        $message->cc($dd2['cc'], $dd2['cc_name']);
        $message->subject($dd2['subject']);
        $message->priority(1);
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

    return redirect($request->retpath);
  }
  public function jobPage(Request $request)
  {
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'captcha_answer' => ['required', 'numeric', new MathCaptchaValidationRule()],
        'name' => 'required',
        'source' => 'required',
        'source_path' => 'required',
        'mobile' => 'required',
        'email' => 'required|email',
        'intrested_program' => 'required',
        'state' => 'required',
      ]
    );

    $field = new Student();
    $field->name = $request['name'];
    $field->email = $request['email'];
    $field->mobile = $request['mobile'];
    $field->state = $request['state'];
    $field->intrested_program = $request['intrested_program'];
    $field->source =  $request['source'];
    $field->source_path =  $request['source_path'];
    $field->save();

    session()->flash('smsg', 'Your inquiry has been submitted succesfully. We will contact you soon.');

    $emaildata = [
      'name' => $request['name'],
      'email' => $request['email'],
      'mobile' => $request['mobile'],
      'intrest' => $request['intrested_program'],
    ];
    $dd = ['to' => $request['email'], 'to_name' => $request['name'], 'subject' => 'Inquiry'];

    Mail::send(
      'mails.inquiry-reply',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);
      }
    );

    $emaildata2 = [
      'name' => $request['name'],
      'email' => $request['email'],
      'mobile' => $request['mobile'],
      'intrest' => $request['intrest'],
    ];

    $dd2 = ['to' => TO_EMAIL, 'cc' => CC_EMAIL, 'to_name' => TO_NAME, 'cc_name' => CC_NAME, 'subject' => 'New Inquiry'];

    Mail::send(
      'mails.inquiry-mail-to-team',
      $emaildata2,
      function ($message) use ($dd2) {
        $message->to($dd2['to'], $dd2['to_name']);
        $message->cc($dd2['cc'], $dd2['cc_name']);
        $message->subject($dd2['subject']);
        $message->priority(1);
      }
    );

    return back();
  }
}
