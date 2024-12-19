<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FeesAndDeadline;
use App\Models\University;
use Illuminate\Http\Request;

class FeesAndDeadlineC extends Controller
{
  public function index($university_id,$id = null)
  {
    $university = University::find($university_id);
    $rows = FeesAndDeadline::where('university_id',$university_id)->get();
    if ($id != null) {
      $sd = FeesAndDeadline::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/fees-and-deadline/'.$university_id.'/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/fees-and-deadline');
      }
    } else {
      $ft = 'add';
      $url = url('admin/fees-and-deadline/'.$university_id.'/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "University Fees and Deadline";
    $page_route = "fees-and-deadline";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route','university');
    return view('admin.fees-and-deadline')->with($data);
  }
  public function store($university_id,Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'program' => 'required',
        'application_deadline' => 'required',
        'fees' => 'required',
      ]
    );
    $field = new FeesAndDeadline;
    $field->university_id = $request['university_id'];
    $field->program = $request['program'];
    $field->application_deadline = $request['application_deadline'];
    $field->fees = $request['fees'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/fees-and-deadline/'.$university_id);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = FeesAndDeadline::find($id)->delete();
  }
  public function update($university_id,$id, Request $request)
  {
    $request->validate(
      [
        'program' => 'required',
        'application_deadline' => 'required',
        'fees' => 'required',
      ]
    );
    $field = FeesAndDeadline::find($id);

    $field->university_id = $request['university_id'];
    $field->program = $request['program'];
    $field->application_deadline = $request['application_deadline'];
    $field->fees = $request['fees'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/fees-and-deadline/'.$university_id);
  }
}
