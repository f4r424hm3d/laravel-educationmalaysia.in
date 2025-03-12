<?php

namespace App\Http\Controllers\admin;

use App\Exports\SpecializationExport;
use App\Http\Controllers\Controller;
use App\Imports\CourseSpecializationImport;
use App\Models\Author;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class CourseSpecializationC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'course-specializations';
  }
  public function index(Request $request, $id = null)
  {
    $authors = Author::all();
    $category = CourseCategory::all();

    $rows = CourseSpecialization::orderBy('name', 'ASC');
    if ($request->has('keyword') && $request->keyword != '') {
      $rows = $rows->where('name', 'like', '%' . $request->keyword . '%')->orWhere('id', 'like', '%' . $request->keyword)->orWhere('course_category_id', $request->keyword);
    }
    $rows = $rows->paginate(20)->withQueryString();

    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;
    if ($id != null) {
      $sd = CourseSpecialization::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/' . $this->page_route . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/' . $this->page_route . '');
      }
    } else {
      $ft = 'add';
      $url = url('admin/' . $this->page_route . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Course Specialization";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'category', 'i', 'authors');
    return view('admin.course-specialization')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'name' => [
          'required',
          Rule::unique('course_specializations', 'name')->where(function ($query) {
            $query->where('website', site_var);
          }),
        ],
        'thumbnail' => 'nullable|max:1000|mimes:jpg,jpeg,png,gif,webp,svg',
        'banner' => 'nullable|max:1000|mimes:jpg,jpeg,png,gif,webp,svg',
        'content_image' => 'nullable|max:1000|mimes:jpg,jpeg,png,gif,webp,svg',
        'og_image' => 'nullable|max:1000|mimes:jpg,jpeg,png,gif,webp,svg',
      ]
    );
    $field = new CourseSpecialization;
    $field->course_category_id = $request['course_category_id'];
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
    return redirect('admin/' . $this->page_route);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = CourseSpecialization::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'name' => [
          'required',
          Rule::unique('course_specializations', 'name')
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
    $field = CourseSpecialization::find($id);
    $field->course_category_id = $request['course_category_id'];
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
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route);
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
        $result = Excel::import(new CourseSpecializationImport, $file);
        // session()->flash('smsg', 'Data has been imported succesfully.');
        return redirect('admin/' . $this->page_route);
      } catch (\Exception $ex) {
        dd($ex);
      }
    }
  }
  public function export()
  {
    return Excel::download(new SpecializationExport, 'specialization-list.xlsx');
  }
  public function getByCategory(Request $request)
  {
    // printArray($data->all());
    // die;
    $rows = CourseSpecialization::where(['course_category_id' => $request->course_category_id])->get();
    $output = '<option value="">Select</option>';
    foreach ($rows as $row) {
      $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
    }
    echo $output;
  }
}
