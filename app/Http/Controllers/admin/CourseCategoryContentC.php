<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\CourseCategoryContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseCategoryContentC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'course-category-contents';
  }
  public function index(Request $request, $course_category_id, $id = null)
  {
    $categories = CourseCategory::find($course_category_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = CourseCategoryContent::where('course_category_id', $course_category_id)->get();
    if ($id != null) {
      $sd = CourseCategoryContent::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/' . $this->page_route . '/' . $course_category_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/' . $this->page_route . '/' . $course_category_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/' . $this->page_route . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Course Category Contents";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url', 'course_category_id', 'categories');
    return view('admin.course-category-contents')->with($data);
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'course_category_id' => 'required',
      'tab' => 'required',
      'position' => 'required',
      'description' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new CourseCategoryContent();
    $field->course_category_id = $request['course_category_id'];
    $field->tab = $request['tab'];
    $field->description = $request['description'];
    $field->position = $request['position'];
    $field->save();
    return response()->json(['success' => 'Records inserted succesfully.']);
  }
  public function delete($id)
  {
    if ($id) {
      $row = CourseCategoryContent::findOrFail($id);
      //   if ($row->thumbnail_path != null) {
      //     unlink($row->thumbnail_path);
      //   }
      $result = $row->delete();
      if ($result) {
        return response()->json(['success' => true]);
      }
    }
  }
  public function update($course_category_id, $id, Request $request)
  {
    $request->validate(
      [
        'course_category_id' => 'required',
        'tab' => 'required',
        'position' => 'required',
        'description' => 'required',
      ]
    );
    $field = CourseCategoryContent::find($id);
    $field->course_category_id = $request['course_category_id'];
    $field->tab = $request['tab'];
    $field->description = $request['description'];
    $field->position = $request['position'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route . '/' . $course_category_id);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = CourseCategoryContent::where('course_category_id', $request->course_category_id)->paginate(10)->withPath('/admin/' . $this->page_route . '/' . $request->course_category_id);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Position</th>
        <th>Tab</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row'
        . $row->id . '">
            <td>' . $i . '</td>
            <td>' . $row->position . '</td>
            <td>' . $row->tab . '</td>
            <td>
              <button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light"
                data-bs-toggle="modal" data-bs-target="#SeoModalScrollable' . $row->id . '">View</button>
              <div class="modal fade" id="SeoModalScrollable' . $row->id . '" tabindex="-1" role="dialog"
                aria-labelledby="SeoModalScrollableTitle' . $row->id . '" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="SeoModalScrollableTitle' . $row->id . '">SEO</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      ' . $row->description . '
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <a href="javascript:void()" onclick="deleteData(' . $row->id . ')"
                class="waves-effect waves-light btn btn-xs btn-outline btn-danger"><i class="fa fa-trash"
                  aria-hidden="true"></i></a>
              <a href="' . url('admin/' . $this->page_route . '/' . $request->course_category_id . '/update/' . $row->id) . '" class="waves-effect waves-light btn btn-xs btn-outline btn-info"><i
                  class="fa fa-edit" aria-hidden="true"></i></a>
            </td>
          </tr>';
      $i++;
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }
}
