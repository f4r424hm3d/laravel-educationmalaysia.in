<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\University;
use App\Models\UniversityScholarship;
use App\Models\UniversityScholarshipContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UniversityScholarshipContentC extends Controller
{
  public function index($scholarship_id, $id = null)
  {
    $page_no = $_GET['page'] ?? 1;
    $scholarship = UniversityScholarship::find($scholarship_id);
    // printArray($levels);
    // die;
    $rows = UniversityScholarshipContent::where('scholarship_id', $scholarship_id)->get();
    if ($id != null) {
      $sd = UniversityScholarshipContent::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/university-scholarship-contents/' . $scholarship_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/university-scholarship-contents/' . $scholarship_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/university-scholarship-contents/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Scholarship Contents";
    $page_route = "university-scholarship-contents";
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'scholarship', 'url');
    return view('admin.university-scholarship-contents')->with($data);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = UniversityScholarshipContent::find($id)->delete();
  }
  public function update($scholarship_id, $id, Request $request)
  {
    $request->validate(
      [
        'scholarship_id' => 'required',
        'title' => 'required',
        'description' => 'required',
      ]
    );
    $field = UniversityScholarshipContent::find($id);
    $field->scholarship_id = $request['scholarship_id'];
    $field->title = $request['title'];
    $field->description = $request['description'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/university-scholarship-contents/' . $scholarship_id);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = UniversityScholarshipContent::where('id', '!=', '0');
    if ($request->has('scholarship_id') && $request->scholarship_id != '') {
      $rows = $rows->where('scholarship_id', $request->scholarship_id);
    }
    $rows = $rows->paginate(10)->withPath('/admin/university-scholarship-contents/' . $request->scholarship_id);
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
      <td>' . $row->title . '</td><td>';
      if ($row->description != null) {
        $output .= '<button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light"
                      data-bs-toggle="modal" data-bs-target="#SeoModalScrollable' . $row->id . '">View</button>
                    <div class="modal fade" id="SeoModalScrollable' . $row->id . '" tabindex="-1" role="dialog"
                      aria-labelledby="SeoModalScrollableTitle' . $row->id . '" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="SeoModalScrollableTitle' . $row->id . '">
                              Description
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            ' . $row->description . '
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>';
      } else {
        $output .= 'Null';
      }
      $path = url('admin/university-scholarship-contents/' . $request->scholarship_id . '/update/' . $row->id);
      $output .= '</td><td>
        <a href="javascript:void()" onclick="DeleteAjax(' . $row->id . ')"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . $path . '" class="waves-effect waves-light btn btn-xs btn-outline btn-info"><i class="fa fa-edit" aria-hidden="true"></i></a>
      </td>
    </tr>';
      $i++;
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }
  public function storeAjax(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'scholarship_id' => 'required',
      'title' => 'required',
      'description' => 'required',
    ]);

    if ($validator->fails()) {

      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new UniversityScholarshipContent;
    $field->scholarship_id = $request['scholarship_id'];
    $field->title = $request['title'];
    $field->description = $request['description'];
    $field->save();
    return response()->json(['success' => 'Records inserted succesfully.']);
  }
}
