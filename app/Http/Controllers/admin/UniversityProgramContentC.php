<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\UniversityProgram;
use App\Models\UniversityProgramContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class UniversityProgramContentC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'university-program-contents';
  }
  public function index(Request $request, $c_id, $id = null)
  {
    $program = UniversityProgram::find($c_id);
    $university = University::find($program->university_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = UniversityProgramContent::where('c_id', $c_id)->get();
    if ($id != null) {
      $sd = UniversityProgramContent::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/' . $this->page_route . '/' . $c_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/' . $this->page_route . '/' . $c_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/' . $this->page_route . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Program Contents";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url', 'c_id', 'program', 'university');
    return view('admin.university-program-contents')->with($data);
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'c_id' => 'required',
      'tab_title' => 'required',
      'heading' => 'required',
      'description' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }
    $field = new UniversityProgramContent;
    $field->c_id = $request['c_id'];
    $field->tab_title = $request['tab_title'];
    $field->heading = $request['heading'];
    $field->description = $request['description'];
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/university/', $file_name);
      if ($move) {
        $field->imgname = $file_name;
        $field->imgpath = 'uploads/university/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->save();

    return response()->json(['success' => 'Records inserted successfully.']);
  }
  public function delete($id)
  {
    if ($id) {
      $row = UniversityProgramContent::findOrFail($id);
      if ($row->imgpath != null && file_exists($row->imgpath)) {
        unlink($row->imgpath);
      }
      $row->delete();
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
  public function update($c_id, $id, Request $request)
  {
    $request->validate(
      [
        'c_id' => 'required',
        'tab_title' => 'required',
        'heading' => 'required',
        'description' => 'required',
      ]
    );
    $field = UniversityProgramContent::find($id);
    $field->c_id = $request['c_id'];
    $field->tab_title = $request['tab_title'];
    $field->heading = $request['heading'];
    $field->description = $request['description'];
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/university/', $file_name);
      if ($move) {
        $field->imgname = $file_name;
        $field->imgpath = 'uploads/university/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route . '/' . $c_id);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = UniversityProgramContent::where('c_id', $request->c_id)->paginate(10)->withPath('/admin/' . $this->page_route . '/' . $request->c_id);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Tab Title</th>
        <th>Heading</th>
        <th>Thumbnail</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
            <td>' . $i . '</td>
            <td>' . $row->tab_title . '</td>
            <td>' . $row->heading . '</td>
            <td>';
      if ($row->imgpath != null) {
        $output .= '<a href="' . asset($row->imgpath) . '" target="_blank"><img src="' . asset($row->imgpath) . '" height="40" width="40" /></a>';
      } else {
        $output .= 'N/A';
      }
      $output .= '</td>
            <td>' . Blade::render('<x-content-view-modal :row="$row" field="description" title="Description" />', ['row' => $row]) . '</td>
            <td>
              <a href="javascript:void()" onclick="deleteData(' . $row->id . ')"
                class="waves-effect waves-light btn btn-xs btn-outline btn-danger"><i class="fa fa-trash"
                  aria-hidden="true"></i></a>
              <a href="' . url('admin/' . $this->page_route . '/' . $request->c_id . '/update/' . $row->id) . '" class="waves-effect waves-light btn btn-xs btn-outline btn-info"><i
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
