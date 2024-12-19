<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;

class CompareFc extends Controller
{
  public function index(Request $request)
  {
    //printArray($request->toArray());
    //die;
    $programs = NULL;
    if ($request->has('level') && $request->has('course_category') && $request->has('specialization')) {
      $programs = UniversityProgram::where(['level_id' => $request->level, 'course_category_id' => $request->course_category, 'specialization_id' => $request->specialization])->limit(10)->get();
    }

    $levels = UniversityProgram::select('level_id')->groupBy('level_id')->get();
    $path = implode('/', $request->segments());
    $data = compact('programs', 'levels', 'path');
    return view('front.compare')->with($data);
  }
  public function getCategoryByLevel(Request $request)
  {
    $rows = UniversityProgram::select('course_category_id')->groupBy('course_category_id')->where('level_id', $request->level_id)->get();
    $output = '<option value="">Select Category</option>';
    foreach ($rows as $row) {
      $output .= '<option value="' . $row->getCategory->id . '">' . $row->getCategory->category_name . '</option>';
    }
    return $output;
  }
  public function getSpcByLC(Request $request)
  {
    $rows = UniversityProgram::select('specialization_id')->groupBy('specialization_id')->where('course_category_id', $request->course_category_id)->get();
    $output = '<option value="">Select Specialization</option>';
    foreach ($rows as $row) {
      $output .= '<option value="' . $row->getSpecialization->id . '">' . $row->getSpecialization->specialization_name . '</option>';
    }
    return $output;
  }
}
