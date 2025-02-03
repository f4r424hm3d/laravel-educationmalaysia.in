<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\UniversityFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class UniversityFacilityC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'university-facilities';
  }
  public function index(Request $request, $u_id, $id = null)
  {
    $university = University::find($u_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = UniversityFacility::where('u_id', $u_id)->get();
    if ($id != null) {
      $sd = UniversityFacility::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/' . $this->page_route . '/' . $u_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/' . $this->page_route . '/' . $u_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/' . $this->page_route . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Program Contents";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url', 'u_id',  'university');
    return view('admin.university-facilities')->with($data);
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'u_id' => 'required',
      'title' => 'required',
      'description' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }
    $field = new UniversityFacility;
    $field->u_id = $request['u_id'];
    $field->title = $request['title'];
    $field->description = $request['description'];
    $field->save();

    return response()->json(['success' => 'Records inserted successfully.']);
  }
  public function delete($id)
  {
    if ($id) {
      $row = UniversityFacility::findOrFail($id);

      $row->delete();
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
  public function update($u_id, $id, Request $request)
  {
    $request->validate(
      [
        'u_id' => 'required',
        'title' => 'required',
        'description' => 'required',
      ]
    );
    $field = UniversityFacility::find($id);
    $field->u_id = $request['u_id'];
    $field->title = $request['title'];
    $field->description = $request['description'];

    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route . '/' . $u_id);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = UniversityFacility::where('u_id', $request->u_id)->paginate(10)->withPath('/admin/' . $this->page_route . '/' . $request->u_id);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Title</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
            <td>' . $i . '</td>
            <td>' . $row->title . '</td>';

      $output .= '<td>' . Blade::render('<x-content-view-modal :row="$row" field="description" title="Description" />', ['row' => $row]) . '</td>
            <td>
              <a href="javascript:void()" onclick="deleteData(' . $row->id . ')"
                class="waves-effect waves-light btn btn-xs btn-outline btn-danger"><i class="fa fa-trash"
                  aria-hidden="true"></i></a>
              <a href="' . url('admin/' . $this->page_route . '/' . $request->u_id . '/update/' . $row->id) . '" class="waves-effect waves-light btn btn-xs btn-outline btn-info"><i
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
