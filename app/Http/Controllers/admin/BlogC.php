<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Http\Request;

class BlogC extends Controller
{
  public function index($id = null)
  {
    $users = Author::all();
    $category = BlogCategory::all();
    $rows = Blog::get();
    if ($id != null) {
      $sd = Blog::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/blogs/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/blogs');
      }
    } else {
      $ft = 'add';
      $url = url('admin/blogs/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Blogs";
    $page_route = "blogs";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'category', 'users');
    return view('admin.blogs')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'cate_id' => 'required',
        'headline' => 'required|unique:blogs,headline',
      ]
    );
    $field = new Blog;
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/blogs/', $file_name);
      if ($move) {
        $field->imgname = $file_name;
        $field->imgpath = 'uploads/blogs/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->cate_id = $request['cate_id'];
    $field->author_id = $request['author_id'];
    $field->headline = $request['headline'];
    $field->slug = slugify($request['headline']);
    $field->description = $request['description'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/blogs');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = Blog::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'cate_id' => 'required',
        'headline' => 'required|unique:blogs,headline,' . $id,
      ]
    );
    $field = Blog::find($id);
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/blogs/', $file_name);
      if ($move) {
        $field->imgname = $file_name;
        $field->imgpath = 'uploads/blogs/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->cate_id = $request['cate_id'];
    $field->author_id = $request['author_id'];
    $field->headline = $request['headline'];
    $field->slug = slugify($request['headline']);
    $field->description = $request['description'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/blogs');
  }
}
