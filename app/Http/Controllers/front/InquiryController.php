<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Student;
use App\Models\University;
use App\Rules\MathCaptchaValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
  public function universityProfile(Request $request)
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
        'university_id' => 'required',
        'interested_program' => 'required',
      ]
    );
    $university = University::find($request['university_id']);
    $field = new Lead();
    $field->name = $request['name'];
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->email = $request['email'];
    $field->source = $request['source'];
    $field->source_path = $request['source_path'];
    $field->university_id = $university->id;
    $field->intrested_university = $university->name;
    $field->interested_program = $request->interested_program;
    $field->intrested_subject = $request->interested_program;
    $field->website = site_var;
    $field->save();
    session()->flash('smsg', 'Your inquiry has been submitted succesfully. We will contact you soon.');

    $emaildata = [
      'name' => $request['name'],
      'email' => $request['email'],
      'c_code' => $request['c_code'],
      'mobile' => $request['mobile'],
      'source' => $request['source'],
      'source_path' => $request['source_path'],
      'nationality' => null,
      'university' => $university->name ?? null,
      'program' => $request->interested_program ?? null,
      'interest' => $request->interested_program,
    ];
    $dd = ['to' => $request['email'], 'to_name' => $request['name'], 'subject' => 'We have Received Your Request – Expect a Response Soon'];

    Mail::send(
      'mails.inquiry-reply',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);
      }
    );

    $dd2 = ['to' => TO_EMAIL, 'cc' => CC_EMAIL, 'to_name' => TO_NAME, 'cc_name' => CC_NAME, 'subject' => 'New Enquiry Alert – Team Attention Needed'];

    Mail::send(
      'mails.inquiry-mail-to-team',
      $emaildata,
      function ($message) use ($dd2) {
        $message->to($dd2['to'], $dd2['to_name']);
        $message->cc($dd2['cc'], $dd2['cc_name']);
        $message->subject($dd2['subject']);
        $message->priority(1);
      }
    );
    return redirect($request->return_path);
  }
  public function streamPage(Request $request)
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
        'nationality' => 'required',
        'interested_program' => 'required',
      ]
    );
    $field = new Lead();
    $field->name = $request['name'];
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->email = $request['email'];
    $field->source = $request['source'];
    $field->source_path = $request['source_path'];
    $field->nationality = $request['nationality'];
    $field->interested_program = $request->interested_program;
    $field->intrested_subject = $request->interested_program;
    $field->website = site_var;
    $field->save();
    session()->flash('smsg', 'Your inquiry has been submitted succesfully. We will contact you soon.');

    $emaildata = [
      'name' => $request['name'],
      'email' => $request['email'],
      'c_code' => $request['c_code'],
      'mobile' => $request['mobile'],
      'source' => $request['source'],
      'source_path' => $request['source_path'],
      'nationality' => $request['nationality'] ?? null,
      'university' => null,
      'program' => $request->interested_program ?? null,
      'interest' => $request->interested_program,
    ];
    $dd = ['to' => $request['email'], 'to_name' => $request['name'], 'subject' => 'We have Received Your Request – Expect a Response Soon'];

    Mail::send(
      'mails.inquiry-reply',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);
      }
    );

    $dd2 = ['to' => TO_EMAIL, 'cc' => CC_EMAIL, 'to_name' => TO_NAME, 'cc_name' => CC_NAME, 'subject' => 'New Enquiry Alert – Team Attention Needed'];

    Mail::send(
      'mails.inquiry-mail-to-team',
      $emaildata,
      function ($message) use ($dd2) {
        $message->to($dd2['to'], $dd2['to_name']);
        $message->cc($dd2['cc'], $dd2['cc_name']);
        $message->subject($dd2['subject']);
        $message->priority(1);
      }
    );
    return redirect($request->return_path);
  }
  public function simpleForm(Request $request)
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
        'nationality' => 'required'
      ]
    );
    $field = new Lead();
    $field->name = $request['name'];
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->email = $request['email'];
    $field->source = $request['source'];
    $field->source_path = $request['source_path'];
    $field->nationality = $request['nationality'];
    $field->website = site_var;
    $field->save();
    session()->flash('smsg', 'Your inquiry has been submitted succesfully. We will contact you soon.');

    $emaildata = [
      'name' => $request['name'],
      'email' => $request['email'],
      'c_code' => $request['c_code'],
      'mobile' => $request['mobile'],
      'source' => $request['source'],
      'source_path' => $request['source_path'],
      'nationality' => $request['nationality'] ?? null,
      'university' => null,
      'program' => null,
      'interest' => null,
    ];
    $dd = ['to' => $request['email'], 'to_name' => $request['name'], 'subject' => 'We have Received Your Request – Expect a Response Soon'];

    Mail::send(
      'mails.inquiry-reply',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);
      }
    );

    $dd2 = ['to' => TO_EMAIL, 'cc' => CC_EMAIL, 'to_name' => TO_NAME, 'cc_name' => CC_NAME, 'subject' => 'New Enquiry Alert – Team Attention Needed'];

    Mail::send(
      'mails.inquiry-mail-to-team',
      $emaildata,
      function ($message) use ($dd2) {
        $message->to($dd2['to'], $dd2['to_name']);
        $message->cc($dd2['cc'], $dd2['cc_name']);
        $message->subject($dd2['subject']);
        $message->priority(1);
      }
    );
    return redirect($request->return_path);
  }
  public function brochureRequest(Request $request)
  {
    // printArray($request->toArray());
    // die;
    $validator = Validator::make($request->all(), [
      'captcha_answer' => ['required', 'numeric', new MathCaptchaValidationRule()],
      'name' => 'required',
      'c_code' => 'required|numeric',
      'mobile' => 'required|numeric',
      'email' => 'required|email',
      'nationality' => 'required',
      'highest_qualification' => 'required',
      'intrested_subject' => 'required',
      'university_id' => 'required',
      'source_path' => 'required',
      'requestfor' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $university = University::find($request->university_id);

    $field = new Lead();
    $field->name = $request['name'];
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->email = $request['email'];
    $field->nationality = $request['nationality'];
    $field->highest_qualification = $request['highest_qualification'];
    $field->intrested_subject = $request['intrested_subject'];
    $field->intrested_university = $university->name;
    $field->university_id = $university->id;
    $field->source = $request->requestfor == 'fees' ? 'Education Malaysia - Fees Request' : 'Education Malaysia - Brochure Request';
    $field->source_path = $request['source_path'];
    $field->website = site_var;
    $field->save();

    $emaildata = [
      'name' => $request['name'],
      'email' => $request['email'],
      'c_code' => $request['c_code'],
      'mobile' => $request['mobile'],
      'source' => $request['source'],
      'source_path' => $request['source_path'],
      'nationality' => $request['nationality'] ?? null,
      'university' => $university->name,
      'program' => null,
      'interest' => null,
    ];
    $dd = ['to' => $request['email'], 'to_name' => $request['name'], 'subject' => 'We have Received Your Request for brochure/fees of ' . $university->name . ' – Expect a Response Soon'];

    Mail::send(
      'mails.inquiry-reply',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);
      }
    );

    $dd2 = ['to' => TO_EMAIL, 'cc' => CC_EMAIL, 'to_name' => TO_NAME, 'cc_name' => CC_NAME, 'subject' => 'New Brochure/Fees request inquiry for ' . $university->name . ' – Team Attention Needed'];

    Mail::send(
      'mails.inquiry-mail-to-team',
      $emaildata,
      function ($message) use ($dd2) {
        $message->to($dd2['to'], $dd2['to_name']);
        $message->cc($dd2['cc'], $dd2['cc_name']);
        $message->subject($dd2['subject']);
        $message->priority(1);
      }
    );

    return response()->json(['success' => true, 'message' => 'Your inquiry has been submitted succesfully. We will contact you soon.']);
  }
}
