<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CourseMode;
use Illuminate\Http\Request;

class CourseModeC extends Controller
{
  public function index($id = null)
  {
    $rows = CourseMode::get();
    if ($id != null) {
      $sd = CourseMode::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/course-modes/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/course-modes');
      }
    } else {
      $ft = 'add';
      $url = url('admin/course-modes/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Course Modes";
    $page_route = "course-modes";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route');
    return view('admin.course-modes')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'course_mode' => 'required|unique:course_modes,course_mode',
      ]
    );
    $field = new CourseMode;
    $field->course_mode = $request['course_mode'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/course-modes');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = CourseMode::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'course_mode' => 'required|unique:course_modes,course_mode,' . $id,
      ]
    );

    $field = CourseMode::find($id);
    $field->course_mode = $request['course_mode'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/course-modes');
  }
}
