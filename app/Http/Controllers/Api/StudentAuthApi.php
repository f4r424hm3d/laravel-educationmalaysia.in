<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AsignedLead;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead;
use Carbon\Carbon;
use Illuminate\Support\Str;

class StudentAuthApi extends Controller
{
  /**
   * Register new student & send OTP
   */
  public function register(Request $request)
  {
    // Validate request
    $validator = Validator::make($request->all(), [
      'name' => 'required|regex:/^[a-zA-Z ]*$/',
      'email' => [
        'required',
        'email',
        Rule::unique('leads', 'email')->where('website', site_var),
      ],
      'c_code' => 'required|numeric',
      'mobile' => 'required|numeric',
      'password' => ['required', 'string', 'min:8'],
      'confirm_password' => 'required|same:password',
      'highest_qualification' => 'required',
      'interested_course_category' => 'required',
      'nationality' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => false,
        'message' => 'Validation failed',
        'errors' => $validator->errors()
      ], 422);
    }

    // Generate OTP
    $otp = rand(1000, 9999);
    $otp_expire_at = Carbon::now()->addMinutes(15);

    // Save student
    $student = new Lead();
    $student->name = $request->name;
    $student->email = $request->email;
    $student->highest_qualification = $request->highest_qualification;
    $student->interested_course_category = $request->interested_course_category;
    $student->nationality = $request->nationality;
    $student->c_code = $request->c_code;
    $student->mobile = $request->mobile;
    $student->password = $request->password;
    $student->source = 'Education Malaysia - Signup';
    $student->source_path = $request->source_path;
    $student->otp = $otp;
    $student->otp_expire_at = $otp_expire_at;
    $student->status = 0;
    $student->website = site_var;
    $student->save();
    AsignedLead::autoAssign($student->id);

    // Send OTP Email
    Mail::send('mails.send-otp', ['name' => $request->name, 'otp' => $otp], function ($message) use ($request) {
      $message->to($request->email, $request->name);
      $message->subject('Your OTP Code');
    });

    return response()->json([
      'status' => true,
      'message' => 'Registration successful. OTP sent to your email.',
      'data' => [
        'id' => $student->id,
        'email' => $student->email
      ]
    ], 200);
  }

  /**
   * Verify OTP
   */
  public function verifyOtp(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'id' => 'required|exists:leads,id',
      'otp' => 'required|numeric'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => false,
        'message' => 'Validation failed',
        'errors' => $validator->errors()
      ], 422);
    }

    $student = Lead::find($request->id);

    if (!$student) {
      return response()->json(['status' => false, 'message' => 'Student not found'], 404);
    }

    // Check OTP validity
    if ($student->otp != $request->otp) {
      return response()->json(['status' => false, 'message' => 'Invalid OTP'], 400);
    }

    if (Carbon::now()->gt($student->otp_expire_at)) {
      return response()->json(['status' => false, 'message' => 'OTP expired. Please request a new one.'], 400);
    }

    // Mark student as verified
    $student->otp = null;
    $student->otp_expire_at = null;
    $student->email_verified_at = Carbon::now();
    $student->email_verified = 1;
    $student->registered = 1;
    $student->status = 1;
    $student->save();

    // If you want to generate API tokens, add this section (optional)
    $token = $student->createToken('StudentAPIToken')->plainTextToken;

    return response()->json([
      'status' => true,
      'message' => 'Email verified successfully.',
      'data' => [
        'id' => $student->id,
        'email' => $student->email,
        'token' => $token
      ]
    ], 200);
  }

  /**
   * Resend OTP
   */
  public function resendOtp(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'id' => 'required|exists:leads,id'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => false,
        'message' => 'Validation failed',
        'errors' => $validator->errors()
      ], 422);
    }

    $student = Lead::find($request->id);

    $otp = rand(1000, 9999);
    $student->otp = $otp;
    $student->otp_expire_at = Carbon::now()->addMinutes(15);
    $student->save();

    // Send OTP Email again
    Mail::send('mails.send-otp', ['name' => $student->name, 'otp' => $otp], function ($message) use ($student) {
      $message->to($student->email, $student->name);
      $message->subject('New OTP Code');
    });

    return response()->json([
      'status' => true,
      'message' => 'New OTP sent to your email.'
    ], 200);
  }

  /**
   * Student Login API
   */
  public function login(Request $request)
  {
    // Validate request
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required|string'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => false,
        'message' => 'Validation failed',
        'errors' => $validator->errors()
      ], 422);
    }

    $student = Lead::where('email', $request['email'])->where('website', site_var)->first();

    if (!$student) {
      return response()->json([
        'status' => false,
        'message' => 'Email address does not exist.'
      ], 401);
    }

    if ($student->status != 1) {
      return response()->json([
        'status' => false,
        'message' => 'Account not verified. Please verify your email.'
      ], 403);
    }

    // Verify password (bcrypt or plain)
    if (Hash::check($request->password, $student->password)) {
      // If you want to generate API tokens, add this section (optional)
      $token = $student->createToken('StudentAPIToken')->plainTextToken;

      return response()->json([
        'status' => true,
        'message' => 'Login successful.',
        'data' => [
          'id' => $student->id,
          'email' => $student->email,
          'token' => $token,
        ]
      ], 200);
    } else {
      return response()->json([
        'status' => false,
        'message' => 'Password is incorrect.'
      ], 401);
    }
  }

  public function forgetPassword(Request $request)
  {
    // Validate request
    $request->validate([
      'email' => 'required|email'
    ]);

    $remember_token = Str::random(45);
    $otp_expire_at = now()->addMinutes(30); // Better than date()

    // Check if email exists
    $lead = Lead::where('email', $request->email)->first();

    if (!$lead) {
      return response()->json([
        'status' => false,
        'message' => 'Entered wrong email address. Please check.'
      ], 404);
    }

    // Prepare login & reset links
    $login_link = reacturl('email-login/?uid=' . $lead->id . '&token=' . $remember_token);
    $reset_password_link = reacturl('password/reset/?uid=' . $lead->id . '&token=' . $remember_token);

    // Prepare email data
    $emailData = [
      'name' => $lead->name,
      'id' => $lead->id,
      'remember_token' => $remember_token,
      'login_link' => $login_link,
      'reset_password_link' => $reset_password_link
    ];

    $mailDetails = [
      'to' => $request->email,
      'to_name' => $lead->name,
      'subject' => 'Password Reset'
    ];

    try {
      // Send mail
      Mail::send('mails.forget-password-link', $emailData, function ($message) use ($mailDetails) {
        $message->to($mailDetails['to'], $mailDetails['to_name']);
        $message->subject($mailDetails['subject']);
        $message->priority(1);
      });

      // Save token & expiry
      $lead->remember_token = $remember_token;
      $lead->otp_expire_at = $otp_expire_at;
      $lead->save();

      return response()->json([
        'status' => true,
        'message' => 'Password reset email sent successfully.',
        'data' => [
          'email' => $request->email,
          'reset_link' => $reset_password_link,
          'token_expiry' => $otp_expire_at
        ]
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status' => false,
        'message' => 'Sorry! Please try again later.',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  public function emailLogin(Request $request)
  {
    // Validate request
    $request->validate([
      'uid' => 'required|integer',
      'token' => 'required|string'
    ]);

    $id = $request->uid;
    $remember_token = $request->token;

    // Find user by id & token
    $lead = Lead::where([
      'id' => $id,
      'remember_token' => $remember_token
    ])->first();

    if (!$lead) {
      return response()->json([
        'status' => false,
        'message' => 'Invalid login link.'
      ], 404);
    }

    $current_time = now()->format('Y-m-d H:i:s');

    // Check token expiry
    if ($current_time > $lead->otp_expire_at) {
      return response()->json([
        'status' => false,
        'message' => 'This link has expired. Please request a new one.',
        'current_time' => $current_time,
        'otp_expire_at' => $lead->otp_expire_at,
      ], 410); // 410 = Gone / Expired
    }

    // Update login details
    $lead->login_count = $lead->login_count ? $lead->login_count + 1 : 1;
    $lead->last_login = now();
    $lead->remember_token = null;
    $lead->otp_expire_at = null;
    $lead->save();

    // If you want to generate API tokens, add this section (optional)
    $token = $lead->createToken('StudentAPIToken')->plainTextToken;

    // Return successful response
    return response()->json([
      'status' => true,
      'message' => 'Successfully logged in.',
      'data' => [
        'id' => $lead->id,
        'email' => $lead->email,
        'token' => $token,
      ]
    ], 200);
  }


  public function resetPassword(Request $request)
  {
    // Validate inputs
    $request->validate([
      'uid' => 'required|integer',
      'token' => 'required|string',
      'new_password' => 'required|min:8',
      'confirm_new_password' => 'required|min:8|same:new_password'
    ]);

    $id = $request->uid;
    $remember_token = $request->token;

    // Find lead by id & token
    $lead = Lead::where([
      'id' => $id,
      'remember_token' => $remember_token
    ])->first();

    if (!$lead) {
      return response()->json([
        'status' => false,
        'message' => 'Invalid password reset link.'
      ], 404);
    }

    $current_time = now()->format('Y-m-d H:i:s');

    // Check if OTP/token expired
    if ($current_time > $lead->otp_expire_at) {
      return response()->json([
        'status' => false,
        'message' => 'This reset link has expired. Please request a new one.'
      ], 410); // 410 = Gone (expired)
    }

    // Update lead details
    $lead->login_count = $lead->login_count ? $lead->login_count + 1 : 1;
    $lead->last_login = now();
    $lead->remember_token = null;
    $lead->otp_expire_at = null;
    $lead->password = Hash::make($request->new_password); // **Secure password hashing**
    $lead->save();

    // If you want to generate API tokens, add this section (optional)
    $token = $lead->createToken('StudentAPIToken')->plainTextToken;

    return response()->json([
      'status' => true,
      'message' => 'Password reset successful. You are now logged in.',
      'data' => [
        'id' => $lead->id,
        'email' => $lead->email,
        'token' => $token,
      ]
    ], 200);
  }
}
