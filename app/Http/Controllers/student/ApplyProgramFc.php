<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\StudentApplication;
use Illuminate\Http\Request;

class ApplyProgramFc extends Controller
{
  public function applyProgram($program_id, Request $request)
  {
    $student_id = session()->get('student_id');
    $where = ['prog_id' => $program_id, 'stdid' => $student_id];
    $check = StudentApplication::where($where)->count();
    if ($check == 0) {
      $field = new StudentApplication();
      $field->prog_id = $program_id;
      $field->stdid = $student_id;
      $field->status = 1;
      $field->save();
    }
    session()->flash('smsg', 'Program has been applied. Please complete you profile.');
    return redirect('student/profile');
  }
  public function shortlistProgram($program_id, Request $request)
  {
    $student_id = session()->get('student_id');
    $where = ['prog_id' => $program_id, 'stdid' => $student_id];
    $check = StudentApplication::where($where)->count();
    if ($check == 0) {
      $field = new StudentApplication();
      $field->prog_id = $program_id;
      $field->stdid = $student_id;
      $field->status = 1;
      return $field->save();
    }
    session()->flash('smsg', 'Program has been applied. Please complete you profile.');
    return redirect('student/profile');
  }
}
