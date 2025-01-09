<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceContent;
use Illuminate\Http\Request;

class ServiceContentC extends Controller
{
  public function index($page_id, $id = null)
  {
    $service = Service::find($page_id);
    $rows = ServiceContent::where('page_id', $page_id)->get();
    if ($id != null) {
      $sd = ServiceContent::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/service-content/' . $page_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/service-content');
      }
    } else {
      $ft = 'add';
      $url = url('admin/service-content/' . $page_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Service Content";
    $page_route = "service-content";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'service');
    return view('admin.service-content')->with($data);
  }
  public function store($page_id, Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'tab_title' => 'required',
        'tab_content' => 'required',
      ]
    );
    $field = new ServiceContent;
    $field->page_id = $request['page_id'];
    $field->tab_title = $request['tab_title'];
    $field->tab_content = $request['tab_content'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/service-content/' . $page_id);
  }
  public function delete($id)
  {
    //echo $id;
    $result = ServiceContent::find($id)->delete();
    if ($result) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
  public function update($page_id, $id, Request $request)
  {
    $request->validate(
      [
        'tab_title' => 'required',
        'tab_content' => 'required',
      ]
    );
    $field = ServiceContent::find($id);
    $field->page_id = $request['page_id'];
    $field->tab_title = $request['tab_title'];
    $field->tab_content = $request['tab_content'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/service-content/' . $page_id);
  }
}
