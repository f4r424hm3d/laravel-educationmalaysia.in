<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoC extends Controller
{
  public function index($id = null)
  {
    $rows = Seo::all();
    if ($id != null) {
      $sd = Seo::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/seos/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/seos');
      }
    } else {
      $ft = 'add';
      $url = url('admin/seos/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "SEO";
    $page_route = "seos";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route');
    return view('admin.seos')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'url' => 'required|unique:seos,url',
        'seo_rating' => 'nullable|numeric',
      ]
    );
    $field = new Seo;
    $field->url = $request['url'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/seos');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = Seo::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'url' => 'required|unique:seos,url,' . $id,
        'seo_rating' => 'nullable|numeric',
      ]
    );
    $field = Seo::find($id);
    $field->url = $request['url'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/seos');
  }
}
