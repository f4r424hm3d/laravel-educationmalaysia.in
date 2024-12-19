<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DefaultOgImage;
use Illuminate\Http\Request;

class DefaultOgImageC extends Controller
{
  public function index($id = null)
  {
    $rows = DefaultOgImage::get();
    if ($id != null) {
      $sd = DefaultOgImage::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/default-og-image/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/default-og-image');
      }
    } else {
      $ft = 'add';
      $url = url('admin/default-og-image/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Dynamic Page SEO";
    $page_route = "default-og-image";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route');
    return view('admin.default-og-image')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'page' => 'required|unique:default_og_images,page',
        'file' => 'required|max:5000|mimes:jpg,jpeg,png,gif,webp',
      ]
    );
    $field = new DefaultOgImage;
    $field->page = $request['page'];
    if ($request->hasFile('file')) {
      $fileOriginalName = $request->file('file')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('file')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('file')->move('uploads/seo/', $file_name);
      if ($move) {
        $field->file_name = $file_name;
        $field->file_path = 'uploads/seo/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/default-og-image');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = DefaultOgImage::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'page' => 'required|unique:default_og_images,page,' . $id,
        'file' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
      ]
    );
    $field = DefaultOgImage::find($id);
    $field->page = $request['page'];
    if ($request->hasFile('file')) {
      $fileOriginalName = $request->file('file')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('file')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('file')->move('uploads/seo/', $file_name);
      if ($move) {
        $field->file_name = $file_name;
        $field->file_path = 'uploads/seo/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/default-og-image');
  }
}
