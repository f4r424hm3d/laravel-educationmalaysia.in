<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceContent;
use Illuminate\Http\Request;

class ServiceContentC extends Controller
{
  public function index($service_id,$id = null)
  {
    $service = Service::find($service_id);
    $rows = ServiceContent::where('service_id',$service_id)->get();
    if ($id != null) {
      $sd = ServiceContent::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/service-content/'.$service_id.'/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/service-content');
      }
    } else {
      $ft = 'add';
      $url = url('admin/service-content/'.$service_id.'/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Service Content";
    $page_route = "service-content";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route','service');
    return view('admin.service-content')->with($data);
  }
  public function store($service_id,Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'title' => 'required',
        'description' => 'required',
      ]
    );
    $field = new ServiceContent;
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
    $field->service_id = $request['service_id'];
    $field->title = $request['title'];
    $field->description = $request['description'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/service-content/'.$service_id);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = ServiceContent::find($id)->delete();
  }
  public function update($service_id,$id, Request $request)
  {
    $request->validate(
      [
        'title' => 'required',
        'description' => 'required',
      ]
    );
    $field = ServiceContent::find($id);
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
    $field->service_id = $request['service_id'];
    $field->title = $request['title'];
    $field->description = $request['description'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/service-content/'.$service_id);
  }
}
