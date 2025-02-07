<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use App\Models\ScholarshipContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class ScholarshipContentC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'scholarship-contents';
  }
  public function index(Request $request, $scholarship_id, $id = null)
  {
    $blog = Scholarship::find($scholarship_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = ScholarshipContent::where('scholarship_id', $scholarship_id)->get();
    // $parentContents = ScholarshipContent::where('scholarship_id', $scholarship_id)->where('parent_id', null)->get();
    if ($id != null) {
      $sd = ScholarshipContent::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/' . $this->page_route . '/' . $scholarship_id . '/update/' . $id . '/');
        $title = 'Update';
      } else {
        return redirect('admin/' . $this->page_route . '/' . $scholarship_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/' . $this->page_route . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Scholarship Content";
    $page_route = $this->page_route;
    $lastPosition = $rows->count() + 1;
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url', 'scholarship_id', 'blog',  'lastPosition');
    return view('admin.scholarship-contents')->with($data);
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'scholarship_id' => 'required',
      'tab' => 'required',
      'description' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new ScholarshipContent();
    $field->scholarship_id = $request['scholarship_id'];
    $field->tab = $request['tab'];
    $field->description = $request['description'];
    $field->position = $request['position'];
    //$field->parent_id = $request['parent_id'];
    $field->save();
    return response()->json(['success' => 'Records inserted succesfully.']);
  }
  public function update($scholarship_id, $id, Request $request)
  {
    $request->validate(
      [
        'scholarship_id' => 'required',
        'tab' => 'required',
        'description' => 'required',
      ]
    );
    $field = ScholarshipContent::find($id);
    $field->scholarship_id = $request['scholarship_id'];
    $field->tab = $request['tab'];
    //$field->slug = slugify($request['title']);
    $field->description = $request['description'];
    $field->position = $request['position'];
    //$field->parent_id = $request['parent_id'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route . '/' . $scholarship_id);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = ScholarshipContent::orderBy('position')->where('scholarship_id', $request->scholarship_id)->paginate(10)->withPath('/admin/' . $this->page_route . '/' . $request->scholarship_id);
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
      //$parentTitle = $row->parent_id != null ? $row->parent->title : 'N/A';
      $output .= '<tr id="row'
        . $row->id . '">
            <td>' . $i . '</td>
            <td>' . $row->position . '</td>
            <td>' . $row->tab . '</td>
            <td>
              ' . Blade::render('<x-content-view-modal :row="$row" field="description" title="Description" />', ['row' => $row]) . '
            </td>

            <td>
             ' . Blade::render('<x-delete-button :id="$id" />', ['id' => $row->id]) . '
              ' . Blade::render('<x-edit-button :url="$url" />', ['url' => url('admin/' . $this->page_route . '/' . $request->scholarship_id . '/update/' . $row->id)]) . '
            </td>
          </tr>';
      $i++;
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }
  public function delete($id)
  {
    if ($id) {
      $row = ScholarshipContent::findOrFail($id);
      //   if ($row->thumbnail_path != null) {
      //     unlink($row->thumbnail_path);
      //   }
      $row->delete();
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
  public function getPosition(Request $request)
  {
    $rows = ScholarshipContent::where('scholarship_id', $request->scholarship_id)->count();
    $lastPosition = $rows + 1;
    return $lastPosition;
  }
}
