<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Imports\LevelImport;
use App\Models\Destination;
use App\Models\Level;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LevelC extends Controller
{
  public function index($id = null)
  {
    $rows = Level::get();
    if ($id != null) {
      $sd = Level::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/levels/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/levels');
      }
    } else {
      $ft = 'add';
      $url = url('admin/levels/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "level";
    $page_route = "levels";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route');
    return view('admin.level')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        //'destination_id' => 'required|numeric',
        'level' => 'required|unique:levels,level',
      ]
    );
    $field = new Level;
    //$field->destination_id = $request['destination_id'];
    $field->level = $request['level'];
    $field->slug = slugify($request['level']);
    $field->short_name = $request['short_name'];
    $field->short_name_slug = slugify($request['short_name']);
    $field->seo_name = $request['seo_name'];
    $field->seo_name_slug = slugify($request['seo_name']);
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/levels');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = Level::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        //'destination_id' => 'required|numeric',
        'level' => 'required|unique:levels,level,' . $id,
      ]
    );
    $field = Level::find($id);
    $field->destination_id = $request['destination_id'];
    $field->level = $request['level'];
    $field->slug = slugify($request['level']);
    $field->short_name = $request['short_name'];
    $field->short_name_slug = slugify($request['short_name']);
    $field->seo_name = $request['seo_name'];
    $field->seo_name_slug = slugify($request['seo_name']);
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/levels');
  }
  public function Import(Request $request)
  {
    // printArray($data->all());
    // die;
    $request->validate([
      'file' => 'required|mimes:xlsx,csv,xls'
    ]);
    $file = $request->file;
    if ($file) {
      try {
        $result = Excel::import(new LevelImport, $file);
        // session()->flash('smsg', 'Data has been imported succesfully.');
        return redirect('admin/levels');
      } catch (\Exception $ex) {
        dd($ex);
      }
    }
  }
}
