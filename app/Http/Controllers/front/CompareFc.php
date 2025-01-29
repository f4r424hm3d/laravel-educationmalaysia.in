<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Level;
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
      $programs = UniversityProgram::where(['level' => $request->level, 'course_category_id' => $request->course_category, 'specialization_id' => $request->specialization])->limit(10)->get();
    }

    //$levels = UniversityProgram::select('level')->whereNotNull('level')->where('level', '!=', '')->distinct()->get();
    $levels = Level::get();

    $path = implode('/', $request->segments());
    $data = compact('programs', 'levels', 'path');
    return view('front.compare')->with($data);
  }
  public function getCategoryByLevel(Request $request)
  {
    $rows = UniversityProgram::select('course_category_id')->groupBy('course_category_id')->where('level', $request->level)->get();
    $output = '<option value="">Select Category</option>';
    foreach ($rows as $row) {
      $output .= '<option value="' . $row->category->id . '">' . $row->category->name . '</option>';
    }
    return $output;
  }
  public function getSpcByLC(Request $request)
  {
    $rows = UniversityProgram::select('specialization_id')->groupBy('specialization_id')->where('course_category_id', $request->course_category_id)->get();
    $output = '<option value="">Select Specialization</option>';
    foreach ($rows as $row) {
      $output .= '<option value="' . $row->getSpecialization->id . '">' . $row->getSpecialization->name . '</option>';
    }
    return $output;
  }
}
