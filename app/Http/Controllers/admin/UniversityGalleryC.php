<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\UniversityPhoto;
use Illuminate\Http\Request;

class UniversityGalleryC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'university-photos';
  }
  public function index($university_id, $id = null)
  {
    $university = University::find($university_id);
    $rows = UniversityPhoto::where('university_id', $university_id)->get();
    if ($id != null) {
      $sd = UniversityPhoto::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/' . $this->page_route . '/' . $university_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/university-photos');
      }
    } else {
      $ft = 'add';
      $url = url('admin/' . $this->page_route . '/' . $university_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "University Photos";
    $page_route = "university-photos";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'university');
    return view('admin.university-photos')->with($data);
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
        $field = new UniversityPhoto;
        $field->university_id = $request['university_id'];
        $field->title = $request['title'];
        $fileOriginalName = $file->getClientOriginalName();
        $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $file_name_slug = slugify($fileNameWithoutExtention);
        $file_name = $file_name_slug . '-' . time() . '.' . $file->getClientOriginalExtension();
        $move = $file->move('uploads/university/', $file_name);
        if ($move) {
          $field->photo_name = $file_name;
          $field->photo_path = 'uploads/university/' . $file_name;
        } else {
          session()->flash('emsg', 'Images not uploaded.');
        }
        $field->save();
      }
    }

    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/' . $this->page_route . '/' . $university_id);
  }
  public function update($university_id, $id, Request $request)
  {
    $request->validate(
      [
        'title' => 'required',
        'photo' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
      ]
    );
    $field = UniversityPhoto::find($id);
    if ($request->hasFile('photo')) {
      $fileOriginalName = $request->file('photo')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('photo')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('photo')->move('uploads/university/', $file_name);
      if ($move) {
        if ($field->photo_path != null && file_exists($field->photo_path)) {
          unlink($field->photo_path);
        }
        $field->photo_name = $file_name;
        $field->photo_path = 'uploads/university/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->title = $request['title'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route . '/' . $university_id);
  }
  public function delete($id)
  {
    if ($id) {
      $row = UniversityPhoto::findOrFail($id);
      if ($row->photo_path != null && file_exists($row->photo_path)) {
        unlink($row->photo_path);
      }
      $row->delete();
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
}
