<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AsignedLead;
use App\Models\CourseCategory;
use App\Models\Lead;
use App\Models\Level;
use App\Models\University;
use App\Models\UniversityBrochure;
use App\Rules\MathCaptchaValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class InquiryApi extends Controller
{
  public function universityProfile(Request $request)
  {
    // Validate request
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'source' => 'required',
      'source_path' => 'required',
      'c_code' => 'required|numeric',
      'mobile' => 'required|numeric',
      'email' => 'required|email',
      'university_id' => 'required',
      'interested_program' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => false,
        'errors' => $validator->errors()
      ], 422);
    }

    // Fetch university details
    $university = University::find($request->university_id);

    if (!$university) {
      return response()->json([
        'status' => false,
        'message' => 'University not found'
      ], 404);
    }

    // Create a new lead
    $lead = new Lead();
    $lead->name = $request->name;
    $lead->c_code = $request->c_code;
    $lead->mobile = $request->mobile;
    $lead->email = $request->email;
    $lead->source = 'Education Malaysia - University Profile Page';
    $lead->source_path = $request->source_path;
    $lead->university_id = $university->id;
    $lead->intrested_university = $university->name;
    $lead->interested_program = $request->interested_program;
    $lead->interested_course_category = $request->interested_program;
    $lead->website = site_var;
    $lead->save();

    // Auto assign lead
    AsignedLead::autoAssign($lead->id);

    // Prepare email data
    $emailData = [
      'name' => $request->name,
      'email' => $request->email,
      'c_code' => $request->c_code,
      'mobile' => $request->mobile,
      'source' => $request->source,
      'source_path' => $request->source_path,
      'nationality' => null,
      'university' => $university->name,
      'program' => $request->interested_program,
      'interest' => $request->interested_program,
    ];

    try {
      // Send email to user
      Mail::send('mails.inquiry-reply', $emailData, function ($message) use ($request) {
        $message->to($request->email, $request->name)
          ->subject('We have Received Your Request – Expect a Response Soon')
          ->priority(1);
      });

      // Send email to team
      Mail::send('mails.inquiry-mail-to-team', $emailData, function ($message) {
        $message->to(TO_EMAIL, TO_NAME)
          ->cc(CC_EMAIL, CC_NAME)
          ->subject('New Enquiry Alert – Team Attention Needed')
          ->priority(1);
      });
    } catch (\Exception $e) {
      return response()->json([
        'status' => false,
        'message' => 'Lead saved but email sending failed',
        'error' => $e->getMessage()
      ], 500);
    }

    // Success response
    return response()->json([
      'status' => true,
      'message' => 'Your inquiry has been submitted successfully. We will contact you soon.',
      'lead_id' => $lead->id
    ], 200);
  }

  public function brochureRequest(Request $request)
  {
    // printArray($request->toArray());
    // die;
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'c_code' => 'required|numeric',
      'mobile' => 'required|numeric',
      'email' => 'required|email',
      'nationality' => 'required',
      'highest_qualification' => 'required',
      'interested_course_category' => 'required',
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
    $levelDetail = Level::where('level', $request['highest_qualification'])->first();
    $courseCategory = CourseCategory::where('name', $request['interested_course_category'])->first();

    $brochures = UniversityBrochure::where(['university_id' => $university->id, 'category' => $request['interested_course_category'], 'level_id' => $levelDetail->id, 'brochure_type' => $request->requestfor, 'status' => 1])->get();
    if ($brochures->count() < 1) {
      $brochure_status = 'Brochure Not Available';
    } else {
      $brochure_status = 'Brochure Sended';
    }

    $field = new Lead();
    $field->name = $request['name'];
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->email = $request['email'];
    $field->nationality = $request['nationality'];
    $field->highest_qualification = $request['highest_qualification'];
    $field->interested_course_category = $request['interested_course_category'];
    $field->intrested_university = $university->name;
    $field->university_id = $university->id;
    $field->source = $request->requestfor == 'fees' ? 'Education Malaysia - Fees Request' : 'Education Malaysia - Brochure Request';
    $field->source_path = $request['source_path'];
    $field->website = site_var;
    $field->brochure_status = $brochure_status;
    $field->save();
    AsignedLead::autoAssign($field->id);

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

    // Mail::send(
    //   'mails.inquiry-reply',
    //   $emaildata,
    //   function ($message) use ($dd) {
    //     $message->to($dd['to'], $dd['to_name']);
    //     $message->subject($dd['subject']);
    //     $message->priority(1);
    //   }
    // );

    Mail::send(
      'mails.inquiry-reply', // View
      $emaildata,            // Data passed to the view
      function ($message) use ($dd, $brochures) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);

        // Attach each brochure file
        foreach ($brochures as $brochure) {
          $filePath = $brochure->file_link; // Adjust if the path is relative to storage
          if (file_exists($filePath)) {
            $message->attach($filePath, [
              'as' => basename($filePath), // Use the file's original name
              'mime' => mime_content_type($filePath) // Dynamically detect MIME type
            ]);
          }
        }
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


  public function simpleForm(Request $request)
  {
    // Validate the request
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'source' => 'required|string|max:255',
      'source_path' => 'required|string|max:255',
      'c_code' => 'required|numeric',
      'mobile' => 'required|numeric',
      'email' => 'required|email',
      'nationality' => 'required|string|max:100'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => false,
        'errors' => $validator->errors()
      ], 422);
    }

    try {
      // Store lead data
      $lead = new Lead();
      $lead->name = $request->name;
      $lead->c_code = $request->c_code;
      $lead->mobile = $request->mobile;
      $lead->email = $request->email;
      $lead->source = $request->source;
      $lead->source_path = $request->source_path;
      $lead->nationality = $request->nationality;
      $lead->website = site_var;
      $lead->save();

      // Auto-assign the lead to a counselor
      AsignedLead::autoAssign($lead->id);

      // Email data
      $emailData = [
        'name' => $request->name,
        'email' => $request->email,
        'c_code' => $request->c_code,
        'mobile' => $request->mobile,
        'source' => $request->source,
        'source_path' => $request->source_path,
        'nationality' => $request->nationality,
        'university' => null,
        'program' => null,
        'interest' => null,
      ];

      $userMailData = [
        'to' => $request->email,
        'to_name' => $request->name,
        'subject' => 'We have Received Your Request – Expect a Response Soon'
      ];

      // Send email to user
      Mail::send('mails.inquiry-reply', $emailData, function ($message) use ($userMailData) {
        $message->to($userMailData['to'], $userMailData['to_name']);
        $message->subject($userMailData['subject']);
        $message->priority(1);
      });

      // Send email to team
      $teamMailData = [
        'to' => TO_EMAIL,
        'cc' => CC_EMAIL,
        'to_name' => TO_NAME,
        'cc_name' => CC_NAME,
        'subject' => 'New Enquiry Alert – Team Attention Needed'
      ];

      Mail::send('mails.inquiry-mail-to-team', $emailData, function ($message) use ($teamMailData) {
        $message->to($teamMailData['to'], $teamMailData['to_name']);
        $message->cc($teamMailData['cc'], $teamMailData['cc_name']);
        $message->subject($teamMailData['subject']);
        $message->priority(1);
      });

      // Success response
      return response()->json([
        'status' => true,
        'message' => 'Your inquiry has been submitted successfully. We will contact you soon.',
        'lead_id' => $lead->id
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status' => false,
        'message' => 'Something went wrong while submitting your request.',
        'error' => $e->getMessage()
      ], 500);
    }
  }
}
