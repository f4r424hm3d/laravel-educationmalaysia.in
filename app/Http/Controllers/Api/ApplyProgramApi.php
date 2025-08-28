<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentApplication;
use Illuminate\Http\Request;

class ApplyProgramApi extends Controller
{
  public function applyProgram($program_id, Request $request)
  {
    $student = $request->user();

    $student_id = $student->id;

    // Check if already applied
    $exists = StudentApplication::where([
      'prog_id' => $program_id,
      'stdid' => $student_id
    ])->exists();

    if ($exists) {
      return response()->json([
        'status' => false,
        'message' => 'You have already applied for this program.'
      ], 409); // 409 = Conflict
    }

    // Create new application
    $application = new StudentApplication();
    $application->prog_id = $program_id;
    $application->stdid = $student_id;
    $application->status = 1;
    $application->save();

    return response()->json([
      'status' => true,
      'message' => 'Program applied successfully. Please complete your profile.',
      'data' => $application
    ], 201);
  }

  public function shortlistProgram($program_id, Request $request)
  {
    $student = $request->user();

    $student_id = $student->id;

    // Check if already shortlisted/applied
    $exists = StudentApplication::where([
      'prog_id' => $program_id,
      'stdid' => $student_id
    ])->exists();

    if ($exists) {
      return response()->json([
        'status' => false,
        'message' => 'Program already shortlisted or applied.'
      ], 409);
    }

    // Shortlist program
    $application = new StudentApplication();
    $application->prog_id = $program_id;
    $application->stdid = $student_id;
    $application->status = 0;
    $application->save();

    return response()->json([
      'status' => true,
      'message' => 'Program shortlisted successfully.',
      'data' => $application
    ], 201);
  }

  public function deleteProgram($id, Request $request)
  {
    // Check if the program application exists
    $application = StudentApplication::find($id);

    if (!$application) {
      return response()->json([
        'status' => false,
        'message' => 'Program application not found.'
      ], 404);
    }

    // Delete the application
    $application->delete();

    return response()->json([
      'status' => true,
      'message' => 'Program application deleted successfully.'
    ], 200);
  }
}
