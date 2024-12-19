<?php

namespace App\Http\Controllers\admin;

use App\Exports\SpecializationExport;
use App\Http\Controllers\Controller;
use App\Imports\CourseSpecializationImport;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CourseSpecializationC extends Controller
{
  public function index(Request $request, $id = null)
  {
    $category = CourseCategory::all();

    $rows = CourseSpecialization::orderBy('specialization_name', 'ASC');
    if ($request->has('keyword') && $request->keyword != '') {
      $rows = $rows->where('specialization_name', 'like', '%' . $request->keyword . '%')->orWhere('id', 'like', '%' . $request->keyword)->orWhere('course_category_id', $request->keyword);
    }
    $rows = $rows->paginate(20)->withQueryString();

    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;
    if ($id != null) {
      $sd = CourseSpecialization::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/course-specialization/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/course-specialization');
      }
    } else {
      $ft = 'add';
      $url = url('admin/course-specialization/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Course Specialization";
    $page_route = "course-specialization";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'category', 'i');
    return view('admin.course-specialization')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'course_category_id' => 'required',
        'specialization_name' => 'required|unique:course_specializations,specialization_name',
      ]
    );
    $field = new CourseSpecialization;
    $field->course_category_id = $request['course_category_id'];
    $field->specialization_name = $request['specialization_name'];
    $field->specialization_slug = slugify($request['specialization_name']);
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/course-specialization');
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
        'course_category_id' => 'required',
        'specialization_name' => 'required|unique:course_specializations,specialization_name,' . $id,
      ]
    );
    $field = CourseSpecialization::find($id);
    $field->course_category_id = $request['course_category_id'];
    $field->specialization_name = $request['specialization_name'];
    $field->specialization_slug = slugify($request['specialization_name']);
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/course-specialization');
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
        return redirect('admin/course-specialization');
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
      $output .= '<option value="' . $row->id . '">' . $row->specialization_name . '</option>';
    }
    echo $output;
  }
}
