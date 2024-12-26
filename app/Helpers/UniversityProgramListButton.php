<?php

namespace App\Helpers;

use App\Models\StudentApplication;

class UniversityProgramListButton
{
  public static function getApplyButton($programId)
  {
    if (session()->has('studentLoggedIn')) {
      $studentId = session()->get('student_id');
      $checkAppliedProgram = StudentApplication::where('stdid', $studentId)
        ->where('prog_id', $programId)
        ->first();

      if ($checkAppliedProgram) {
        if ($checkAppliedProgram->status == 1) {
          return '<button class="btn btn-modern2 univ-btn reviews-btn">Applied</button>';
        } else {
          return '<a href="' . route('student.apply.program', ['program_id' => $programId]) . '" class="btn btn-modern2 univ-btn reviews-btn">Apply Now</a>';
        }
      } else {
        return '<a href="' . route('student.apply.program', ['program_id' => $programId]) . '" class="btn btn-modern2 univ-btn reviews-btn">Apply Now</a>';
      }
    } else {
      return '<a href="' . url('sign-up?program_id=' . $programId) . '" class="btn btn-modern2 univ-btn reviews-btn">Apply Now</a>';
    }
  }
}
