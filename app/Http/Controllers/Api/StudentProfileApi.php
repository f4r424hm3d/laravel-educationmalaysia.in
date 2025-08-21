<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentDocument;
use App\Models\StudentSchool;
use Illuminate\Http\Request;

class StudentProfileApi extends Controller
{
  // Profile API (return JSON data)
  public function profile(Request $request)
  {
    $student = $request->user();

    $schools = StudentSchool::where('std_id', $student->id)->get();
    $stdDocs = StudentDocument::where('std_id', $student->id)->get();

    return response()->json([
      'status' => true,
      'data' => [
        'student' => $student,
        'schools' => $schools,
        'student_documents' => $stdDocs,
        // If you need URLs, provide as strings here or generate in frontend
      ]
    ]);
  }

  // Logout API (revoke token)
  public function logout(Request $request)
  {
    $request->user()->currentAccessToken()->delete();

    return response()->json([
      'status' => true,
      'message' => 'Successfully logged out.'
    ]);
  }
}
