<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Student;
use App\Rules\MathCaptchaValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFc extends Controller
{
  public function index(Request $request)
  {
    $allCountries = Address::where('website', site_var)->orderBy('id', 'ASC')->select('country')->distinct()->get();

    $addressesByCountry = Address::where('website', site_var)->orderBy('id', 'ASC')->get()->groupBy('country');

    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);
    $data = compact('captcha', 'allCountries', 'addressesByCountry');
    return view('front.contact')->with($data);
  }
  public function submitInquiry(Request $request)
  {
    // printArray($request->toArray());
    // die;
    $request->validate(
      [
        'captcha_answer' => ['required', 'numeric', new MathCaptchaValidationRule()],
        'name' => 'required',
        'source' => 'required',
        'source_path' => 'required',
        'email' => 'required|email',
        'message' => [
          'required',
          'string',
          'max:500', // You can adjust the max length as needed
          'regex:/^[a-zA-Z0-9\s!@#$%^&*(),.?:"{}|<>]+$/',
        ],
      ]
    );
    $field = new Student();
    $field->name = $request['name'];
    $field->email = $request['email'];
    $field->message = $request['message'];
    $field->source =  $request['source'];
    $field->source_path =  $request['source_path'];
    $field->save();
    session()->flash('smsg', 'Your inquiry has been submitted succesfully. We will contact you soon.');
    return redirect($request->source_path);


    $emaildata = [
      'name' => $request['name'],
      'email' => $request['email'],
      'msg' => $request['message'],
    ];
    $dd = ['to' => $request['email'], 'to_name' => $request['name'], 'subject' => 'Inquiry'];

    Mail::send(
      'mails.inquiry-reply',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->priority(1);
      }
    );

    $emaildata2 = [
      'name' => $request['name'],
      'email' => $request['email'],
      'msg' => $request['message'],
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
  }
}
