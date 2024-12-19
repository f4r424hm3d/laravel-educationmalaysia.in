<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamContent;
use Illuminate\Http\Request;

class ExamContentC extends Controller
{
  public function index($exam_id, $id = null)
  {
    $exam = Exam::find($exam_id);
    $rows = ExamContent::where('exam_id', $exam_id)->get();
    if ($id != null) {
      $sd = ExamContent::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/exam-content/' . $exam_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/exam-content');
      }
    } else {
      $ft = 'add';
      $url = url('admin/exam-content/' . $exam_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Exam Content";
    $page_route = "exam-content";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'exam');
    return view('admin.exam-content')->with($data);
  }
  public function store($exam_id, Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'title' => 'required',
        'description' => 'required',
      ]
    );
    $field = new ExamContent;
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/services/', $file_name);
      if ($move) {
        $field->thumbnail_name = $file_name;
        $field->thumbnail_path = 'uploads/services/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->exam_id = $request['exam_id'];
    $field->title = $request['title'];
    $field->description = $request['description'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/exam-content/' . $exam_id);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = ExamContent::find($id)->delete();
  }
  public function update($exam_id, $id, Request $request)
  {
    $request->validate(
      [
        'title' => 'required',
        'description' => 'required',
      ]
    );
    $field = ExamContent::find($id);
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/services/', $file_name);
      if ($move) {
        $field->thumbnail_name = $file_name;
        $field->thumbnail_path = 'uploads/services/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->exam_id = $request['exam_id'];
    $field->title = $request['title'];
    $field->description = $request['description'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/exam-content/' . $exam_id);
  }
}
