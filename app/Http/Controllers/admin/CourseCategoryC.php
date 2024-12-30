<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Imports\CourseCategoryImport;
use App\Models\Author;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class CourseCategoryC extends Controller
{
  public function index($id = null)
  {
    $authors = Author::all();
    $rows = CourseCategory::get();
    if ($id != null) {
      $sd = CourseCategory::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/course-category/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/course-category');
      }
    } else {
      $ft = 'add';
      $url = url('admin/course-category/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Course Category";
    $page_route = "course-category";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'authors');
    return view('admin.course-category')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'name' => [
          'required',
          Rule::unique('course_categories', 'name')->where(function ($query) {
            $query->where('website', site_var);
          }),
        ],
        'thumbnail' => 'nullable|max:1000|mimes:jpg,jpeg,png,gif,webp,svg',
        'banner' => 'nullable|max:1000|mimes:jpg,jpeg,png,gif,webp,svg',
        'content_image' => 'nullable|max:1000|mimes:jpg,jpeg,png,gif,webp,svg',
        'og_image' => 'nullable|max:1000|mimes:jpg,jpeg,png,gif,webp,svg',
      ]
    );
    $field = new CourseCategory;
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/category/', $file_name);
      if ($move) {
        $field->thumbnail_path = 'uploads/category/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('banner')) {
      $fileOriginalName = $request->file('banner')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('banner')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('banner')->move('uploads/category/', $file_name);
      if ($move) {
        $field->banner_path = 'uploads/category/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('content_image')) {
      $fileOriginalName = $request->file('content_image')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('content_image')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('content_image')->move('uploads/category/', $file_name);
      if ($move) {
        $field->content_image_name = $file_name;
        $field->content_image_path = 'uploads/category/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('og_image')) {
      $fileOriginalName = $request->file('og_image')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('og_image')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('og_image')->move('uploads/category/', $file_name);
      if ($move) {
        $field->og_image_path = 'uploads/category/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->name = $request['name'];
    $field->slug = slugify($request['name']);
    $field->author_id = $request->author_id;
    $field->shortnote = $request->shortnote;
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->best_rating = $request['best_rating'];
    $field->review_number = $request['review_number'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/course-category');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = CourseCategory::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'name' => [
          'required',
          Rule::unique('course_categories', 'name')
            ->ignore($id) // Exclude the given ID
            ->where(function ($query) {
              $query->where('website', site_var);
            }),
        ],
        'thumbnail' => 'nullable|max:1000|mimes:jpg,jpeg,png,gif,webp,svg',
        'banner' => 'nullable|max:1000|mimes:jpg,jpeg,png,gif,webp,svg',
        'content_image' => 'nullable|max:1000|mimes:jpg,jpeg,png,gif,webp,svg',
        'og_image' => 'nullable|max:1000|mimes:jpg,jpeg,png,gif,webp,svg',
      ]
    );
    $field = CourseCategory::find($id);
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/category/', $file_name);
      if ($move) {
        // Remove the previous file if it exists
        if (!empty($field->thumbnail_path) && file_exists($field->thumbnail_path)) {
          unlink($field->thumbnail_path);
        }
        $field->thumbnail_path = 'uploads/category/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('banner')) {
      $fileOriginalName = $request->file('banner')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('banner')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('banner')->move('uploads/category/', $file_name);
      if ($move) {
        // Remove the previous file if it exists
        if (!empty($field->banner_path) && file_exists($field->banner_path)) {
          unlink($field->banner_path);
        }
        $field->banner_path = 'uploads/category/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('content_image')) {
      $fileOriginalName = $request->file('content_image')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('content_image')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('content_image')->move('uploads/category/', $file_name);
      if ($move) {
        if (!empty($field->content_image_path) && file_exists($field->content_image_path)) {
          unlink($field->content_image_path);
        }
        $field->content_image_name = $file_name;
        $field->content_image_path = 'uploads/category/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('og_image')) {
      $fileOriginalName = $request->file('og_image')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('og_image')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('og_image')->move('uploads/category/', $file_name);
      if ($move) {
        if (!empty($field->og_image_path) && file_exists($field->og_image_path)) {
          unlink($field->og_image_path);
        }
        $field->og_image_path = 'uploads/category/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->name = $request['name'];
    $field->slug = slugify($request['name']);
    $field->author_id = $request->author_id;
    $field->shortnote = $request->shortnote;
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->best_rating = $request['best_rating'];
    $field->review_number = $request['review_number'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/course-category');
  }
  public function Import(Request $request)
  {
    // printArray($data->all());
    // die;
    $request->validate([
      'file' => 'required|mimes:xlsx,csv,xls'
    ]);
    $file = $request->file;
    if ($file) {
      try {
        $result = Excel::import(new CourseCategoryImport, $file);
        // session()->flash('smsg', 'Data has been imported succesfully.');
        return redirect('admin/course-category');
      } catch (\Exception $ex) {
        dd($ex);
      }
    }
  }
}
