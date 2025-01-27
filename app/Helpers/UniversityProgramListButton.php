<?php

namespace App\Helpers;

use App\Models\StudentApplication;

class UniversityProgramListButton
{
  public static function getApplyButton($programId, $class = null)
  {
    $class = $class == null ? 'btn btn-modern2 univ-btn reviews-btn' : $class;
    if (session()->has('studentLoggedIn')) {
      $studentId = session()->get('student_id');
      $checkAppliedProgram = StudentApplication::where('stdid', $studentId)
        ->where('prog_id', $programId)
        ->first();

      if ($checkAppliedProgram) {
        if ($checkAppliedProgram->status == 1) {
          return '<button class="' . $class . '">Applied</button>';
        } else {
          return '<a href="' . route('student.apply.program', ['program_id' => $programId]) . '" class="' . $class . '">Apply Now</a>';
        }
      } else {
        return '<a href="' . route('student.apply.program', ['program_id' => $programId]) . '" class="' . $class . '">Apply Now</a>';
      }
    } else {
      return '<a href="' . url('sign-up?program_id=' . $programId) . '" class="' . $class . '">Apply Now</a>';
    }
  }
}
