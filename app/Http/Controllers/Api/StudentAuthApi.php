<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead;
use Carbon\Carbon;

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
    $otp_expire_at = Carbon::now()->addMinutes(5);

    // Save student
    $student = new Lead();
    $student->name = $request->name;
    $student->email = $request->email;
    $student->highest_qualification = $request->highest_qualification;
    $student->interested_course_category = $request->interested_course_category;
    $student->nationality = $request->nationality;
    $student->c_code = $request->c_code;
    $student->mobile = $request->mobile;
    $student->password = Hash::make($request->password);
    $student->source = 'Education Malaysia - Signup';
    $student->source_path = $request->source_path;
    $student->otp = $otp;
    $student->otp_expire_at = $otp_expire_at;
    $student->status = 0;
    $student->website = site_var;
    $student->save();

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

    return response()->json([
      'status' => true,
      'message' => 'Email verified successfully.'
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
    $student->otp_expire_at = Carbon::now()->addMinutes(5);
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
}
