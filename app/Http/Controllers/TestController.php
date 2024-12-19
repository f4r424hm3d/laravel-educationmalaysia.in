<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;

class TestController extends Controller
{
  public function index(Request $request)
  {
    //echo $id;
    die;
    $up = UniversityProgram::find(25);
    $universities = University::all();
    foreach ($universities as $row) {
      $field = new UniversityProgram;
      $field->program_name = $up->program_name;
      $field->program_slug = $up->program_slug;
      $field->university_id = $row->id;
      $field->course_category_id = $up->course_category_id;
      $field->specialization_id = $up->specialization_id;
      $field->level_id  = $up->level_id;
      $field->save();
    }
  }
}
