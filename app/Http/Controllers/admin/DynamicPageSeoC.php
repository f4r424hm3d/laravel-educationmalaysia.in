<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DynamicPageSeo;
use Illuminate\Http\Request;

class DynamicPageSeoC extends Controller
{
  public function index($id = null)
  {
    $rows = DynamicPageSeo::get();
    if ($id != null) {
      $sd = DynamicPageSeo::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/dynamic-page-seos/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/dynamic-page-seos');
      }
    } else {
      $ft = 'add';
      $url = url('admin/dynamic-page-seos/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Dynamic Page SEO";
    $page_route = "dynamic-page-seos";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route');
    return view('admin.dynamic-page-seos')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'url' => 'required|unique:dynamic_page_seos,url',
        'seo_rating' => 'nullable|numeric',
      ]
    );
    $field = new DynamicPageSeo;
    $field->url = $request['url'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/dynamic-page-seos');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = DynamicPageSeo::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'url' => 'required|unique:dynamic_page_seos,url,' . $id,
        'seo_rating' => 'nullable|numeric',
      ]
    );
    $field = DynamicPageSeo::find($id);
    $field->url = $request['url'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/dynamic-page-seos');
  }
}
