<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\UniversityOverview;
use Illuminate\Http\Request;

class UniversityOverviewC extends Controller
{
  public function index($university_id, $id = null)
  {
    $university = University::find($university_id);
    $rows = UniversityOverview::orderBy('position')->where('u_id', $university_id)->get();
    $lastPosition = $rows->count() + 1;
    if ($id != null) {
      $sd = UniversityOverview::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/university-overview/' . $university_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/university-overview');
      }
    } else {
      $ft = 'add';
      $url = url('admin/university-overview/' . $university_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "University Overview";
    $page_route = "university-overview";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'university', 'lastPosition');
    return view('admin.university-overview')->with($data);
  }
  public function store($university_id, Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'h' => 'required',
        'p' => 'required',
      ]
    );
    $field = new UniversityOverview;
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/university/', $file_name);
      if ($move) {
        $field->imgname = $file_name;
        $field->imgpath = 'uploads/university/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->u_id = $request['university_id'];
    $field->h = $request['h'];
    $field->p = $request['p'];
    $field->position = $request['position'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/university-overview/' . $university_id);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = UniversityOverview::find($id)->delete();
  }
  public function update($university_id, $id, Request $request)
  {
    $request->validate(
      [
        'h' => 'required',
        'p' => 'required',
      ]
    );
    $field = UniversityOverview::find($id);
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/university/', $file_name);
      if ($move) {
        $field->imgname = $file_name;
        $field->imgpath = 'uploads/university/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->u_id = $request['university_id'];
    $field->h = $request['h'];
    $field->p = $request['p'];
    $field->position = $request['position'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/university-overview/' . $university_id);
  }
}
