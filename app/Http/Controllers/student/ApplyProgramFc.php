<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\AppliedProgram;
use App\Models\ShortlistedProgram;
use Illuminate\Http\Request;

class ApplyProgramFc extends Controller
{
  public function applyProgram(Request $request)
  {
    $program_id = $request->program_id;
    $student_id = session()->get('student_id');
    $where = ['program_id' => $program_id, 'student_id' => $student_id];
    $check = AppliedProgram::where($where)->count();
    if ($check == 0) {
      $field = new AppliedProgram();
      $field->program_id = $request->program_id;
      $field->student_id = session()->get('student_id');
      $field->status = 1;
      return $field->save();
    } else {
      return '2';
    }
  }
  public function shortlistProgram(Request $request)
  {
    $program_id = $request->program_id;
    $student_id = session()->get('student_id');
    $where = ['program_id' => $program_id, 'student_id' => $student_id];
    $check = ShortlistedProgram::where($where)->count();
    if ($check == 0) {
      $field = new ShortlistedProgram();
      $field->program_id = $request->program_id;
      $field->student_id = session()->get('student_id');
      $field->status = 1;
      return $field->save();
    } else {
      return '2';
    }
  }
}
