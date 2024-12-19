<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobPage;
use App\Models\User;
use Illuminate\Http\Request;

class JobPageC extends Controller
{
  public function index($id = null)
  {
    $users = User::all();
    $rows = JobPage::get();
    if ($id != null) {
      $sd = JobPage::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/job-pages/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/job-pages');
      }
    } else {
      $ft = 'add';
      $url = url('admin/job-pages/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Job Pages";
    $page_route = "job-pages";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'users');
    return view('admin.job-pages')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'page_name' => 'required|unique:job_pages,page_name',
        'thumbnail' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
      ]
    );
    $field = new JobPage;
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/job/', $file_name);
      if ($move) {
        $field->thumbnail_name = $file_name;
        $field->thumbnail_path = 'uploads/job/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->page_name = $request['page_name'];
    $field->page_slug = slugify($request['page_name']);
    $field->title = $request['title'];
    $field->shortnote = $request['shortnote'];
    $field->description = $request['description'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->author_id = $request['author_id'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/job-pages');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = JobPage::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'page_name' => 'required|unique:job_pages,page_name,' . $id,
        'thumbnail' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp'
      ]
    );
    $field = JobPage::find($id);
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/job/', $file_name);
      if ($move) {
        $field->thumbnail_name = $file_name;
        $field->thumbnail_path = 'uploads/job/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->page_name = $request['page_name'];
    $field->page_slug = slugify($request['page_name']);
    $field->title = $request['title'];
    $field->shortnote = $request['shortnote'];
    $field->description = $request['description'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->author_id = $request['author_id'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/job-pages');
  }
}
