<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\StudyMode;
use Illuminate\Http\Request;

class StudyModeC extends Controller
{
  public function index($id = null)
  {
    $rows = StudyMode::get();
    if ($id != null) {
      $sd = StudyMode::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/study-modes/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/study-modes');
      }
    } else {
      $ft = 'add';
      $url = url('admin/study-modes/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Study Modes";
    $page_route = "study-modes";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route');
    return view('admin.study-modes')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'study_mode' => 'required|unique:study_modes,study_mode',
      ]
    );
    $field = new StudyMode;
    $field->study_mode = $request['study_mode'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/study-modes');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = StudyMode::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'study_mode' => 'required|unique:study_modes,study_mode,' . $id,
      ]
    );

    $field = StudyMode::find($id);
    $field->study_mode = $request['study_mode'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/study-modes');
  }
}
