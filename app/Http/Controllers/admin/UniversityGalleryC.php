<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\UniversityGallery;
use Illuminate\Http\Request;

class UniversityGalleryC extends Controller
{
  public function index($university_id, $id = null)
  {
    $university = University::find($university_id);
    $rows = UniversityGallery::where('university_id', $university_id)->get();
    if ($id != null) {
      $sd = UniversityGallery::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/university-gallery/' . $university_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/university-gallery');
      }
    } else {
      $ft = 'add';
      $url = url('admin/university-gallery/' . $university_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "University Gallery";
    $page_route = "university-gallery";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'university');
    return view('admin.university-gallery')->with($data);
  }
  public function store($university_id, Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'title' => 'required',
        'photo.*' => 'required|max:5000|mimes:jpg,jpeg,png,gif,webp',
      ],
      [
        'photo.*.required' => 'Please upload an image',
        'photo.*.mimes' => 'Only jpg, jpeg, png and gif images are allowed',
        'photo.*.max' => 'Sorry! Maximum allowed size for an image is 5MB',
      ]
    );
    if ($request->hasFile('photo')) {
      foreach ($request->file('photo') as $key => $file) {
        $field = new UniversityGallery;
        $field->university_id = $request['university_id'];
        $field->title = $request['title'];
        $fileOriginalName = $file->getClientOriginalName();
        $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $file_name_slug = slugify($fileNameWithoutExtention);
        $file_name = $file_name_slug . '-' . time() . '.' . $file->getClientOriginalExtension();
        $move = $file->move('uploads/university/', $file_name);
        if ($move) {
          $field->image_name = $file_name;
          $field->image_path = 'uploads/university/' . $file_name;
        } else {
          session()->flash('emsg', 'Images not uploaded.');
        }
        $field->save();
      }
    }

    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/university-gallery/' . $university_id);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = UniversityGallery::find($id)->delete();
  }
  public function update($university_id, $id, Request $request)
  {
    $request->validate(
      [
        'title' => 'required',
        'photo' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
      ]
    );
    $field = UniversityGallery::find($id);
    if ($request->hasFile('photo')) {
      $fileOriginalName = $request->file('photo')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('photo')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('photo')->move('uploads/university/', $file_name);
      if ($move) {
        $field->image_name = $file_name;
        $field->image_path = 'uploads/university/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->title = $request['title'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/university-gallery/' . $university_id);
  }
}
