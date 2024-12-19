<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InstituteType;
use Illuminate\Http\Request;

class InstituteTypeC extends Controller
{
  public function index($id = null)
  {
    $rows = InstituteType::get();
    // printArray($rows->toArray());
    // die;
    if ($id != null) {
      $sd = InstituteType::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/institute-types/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/institute-types');
      }
    } else {
      $ft = 'add';
      $url = url('admin/institute-types/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Institute Type";
    $page_route = "institute-types";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route');
    return view('admin.institute-types')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'type' => 'required|unique:institute_types,type',
        'seo_title' => 'nullable|unique:institute_types,seo_title',
      ]
    );
    $field = new InstituteType;
    $field->type = $request['type'];
    $field->slug = slugify($request['type']);
    $field->seo_title = $request['seo_title'];
    $field->seo_title_slug = slugify($request['seo_title']);
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/institute-types');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = InstituteType::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'type' => 'required|unique:institute_types,type,' . $id,
        'seo_title' => 'nullable|unique:institute_types,seo_title,' . $id,
      ]
    );
    $field = InstituteType::find($id);
    $field->type = $request['type'];
    $field->slug = slugify($request['type']);
    $field->seo_title = $request['seo_title'];
    $field->seo_title_slug = slugify($request['seo_title']);
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/institute-types');
  }
}
