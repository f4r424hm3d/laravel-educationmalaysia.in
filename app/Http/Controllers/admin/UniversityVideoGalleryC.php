<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\UniversityVideoGallery;
use Illuminate\Http\Request;

class UniversityVideoGalleryC extends Controller
{
  public function index($university_id,$id = null)
  {
    $university = University::find($university_id);
    $rows = UniversityVideoGallery::where('university_id',$university_id)->get();
    if ($id != null) {
      $sd = UniversityVideoGallery::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/university-video-gallery/'.$university_id.'/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/university-video-gallery');
      }
    } else {
      $ft = 'add';
      $url = url('admin/university-video-gallery/'.$university_id.'/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "University Video Gallery";
    $page_route = "university-video-gallery";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route','university');
    return view('admin.university-video-gallery')->with($data);
  }
  public function store($university_id,Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'title' => 'required',
        'link' => 'required',
      ]
    );
    $field = new UniversityVideoGallery;
    $field->university_id = $request['university_id'];
    $field->title = $request['title'];
    $field->link = $request['link'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/university-video-gallery/'.$university_id);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = UniversityVideoGallery::find($id)->delete();
  }
  public function update($university_id,$id, Request $request)
  {
    $request->validate(
      [
        'title' => 'required',
        'link' => 'required',
      ]
    );
    $field = UniversityVideoGallery::find($id);
    $field->title = $request['title'];
    $field->link = $request['link'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/university-video-gallery/'.$university_id);
  }
}
