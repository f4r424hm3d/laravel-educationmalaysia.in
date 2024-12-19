<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Destination;
use App\Models\User;
use Illuminate\Http\Request;

class DestinationC extends Controller
{
  public function index($id = null)
  {
    $users = User::where('role', '!=', 'admin')->get();
    $countries = Country::all();
    $rows = Destination::get();
    if ($id != null) {
      $sd = Destination::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/destinations/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/destinations');
      }
    } else {
      $ft = 'add';
      $url = url('admin/destinations/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Destination";
    $page_route = "destinations";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'countries', 'users');
    return view('admin.destinations')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'destination_name' => 'required|unique:destinations,destination_name',
        'country' => 'required',
        'author_id' => 'required',
      ]
    );
    $field = new Destination;
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/destination/', $file_name);
      if ($move) {
        $field->thumbnail_name = $file_name;
        $field->thumbnail_path = 'uploads/destination/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('og_img')) {
      $fileOriginalName = $request->file('og_img')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('og_img')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('og_img')->move('uploads/seo/', $file_name);
      if ($move) {
        $field->og_img_name = $file_name;
        $field->og_img_path = 'uploads/seo/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->destination_name = $request['destination_name'];
    $field->destination_slug = slugify($request['destination_name']);
    $field->country = $request['country'];
    $field->author_id = $request['author_id'];
    $field->title = $request['title'];
    $field->description = $request['description'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/destinations');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = Destination::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'destination_name' => 'required|unique:destinations,destination_name,' . $id,
        'country' => 'required',
        'author_id' => 'required',
      ]
    );
    $field = Destination::find($id);
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/destination/', $file_name);
      if ($move) {
        $field->thumbnail_name = $file_name;
        $field->thumbnail_path = 'uploads/destination/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('og_img')) {
      $fileOriginalName = $request->file('og_img')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('og_img')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('og_img')->move('uploads/seo/', $file_name);
      if ($move) {
        $field->og_img_name = $file_name;
        $field->og_img_path = 'uploads/seo/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->destination_name = $request['destination_name'];
    $field->destination_slug = slugify($request['destination_name']);
    $field->country = $request['country'];
    $field->author_id = $request['author_id'];
    $field->title = $request['title'];
    $field->description = $request['description'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/destinations');
  }
}
