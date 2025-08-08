<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\UniversityVideo;
use Illuminate\Http\Request;

class UniversityVideoGalleryC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'university-videos';
  }
  public function index($university_id, $id = null)
  {
    $university = University::find($university_id);
    $rows = UniversityVideo::where('university_id', $university_id)->get();
    if ($id != null) {
      $sd = UniversityVideo::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/' . $this->page_route . '/' . $university_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/university-videos');
      }
    } else {
      $ft = 'add';
      $url = url('admin/' . $this->page_route . '/' . $university_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "University Videos";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'university');
    return view('admin.university-videos')->with($data);
  }
  public function store($university_id, Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'title' => 'required',
        'video_link' => 'required',
      ]
    );
    $field = new UniversityVideo;
    $field->university_id = $request['university_id'];
    $field->title = $request['title'];
    $field->video_link = $request['video_link'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/' . $this->page_route . '/' . $university_id);
  }
  public function delete($id)
  {
    if ($id) {
      $row = UniversityVideo::findOrFail($id);
      $row->delete();
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
  public function update($university_id, $id, Request $request)
  {
    $request->validate(
      [
        'title' => 'required',
        'video_link' => 'required',
      ]
    );
    $field = UniversityVideo::find($id);
    $field->title = $request['title'];
    $field->video_link = $request['video_link'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route . '/' . $university_id);
  }
}
