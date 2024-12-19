<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CareerC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'career';
  }
  public function index($id = null)
  {
    $page_no = $_GET['page'] ?? 1;
    $rows = Career::get();
    if ($id != null) {
      $sd = Career::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/' . $this->page_route . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/' . $this->page_route);
      }
    } else {
      $ft = 'add';
      $url = url('admin/' . $this->page_route . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Career";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'page_no');
    return view('admin.career')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = Career::where('id', '!=', '0');
    $rows = $rows->paginate(10)->withPath('/admin/' . $this->page_route);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Designation</th>
        <th>Location</th>
        <th>No of Position</th>
        <th>Last Date</th>
        <th>Experience</th>
        <th>Job Type</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    if ($rows->count() > 0) {
      foreach ($rows as $row) {
        $class = $row->status == 1 ? 'success' : 'danger';
        $status = $row->status == 1 ? 'Active' : 'Inactive';
        $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->designation . '</td>
      <td>' . $row->location . '</td>
      <td>' . $row->no_of_position . '</td>
      <td>' . $row->last_date . '</td>
      <td>' . $row->experience . '</td>
      <td>' . $row->job_type . '</td>
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
        <span class="badge bg-' . $class . '" onclick="changeStatus(' . $row->id . ')">' . $status . '</span>
      </td>
      <td>
        <a href="javascript:void()" onclick="DeleteAjax(' . $row->id . ')"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . url("admin/" . $this->page_route . "/update/" . $row->id) . '"
                      class="waves-effect waves-light btn btn-xs btn-outline btn-info">
                      <i class="fa fa-edit" aria-hidden="true"></i>
                    </a>
      </td>
    </tr>';
        $i++;
      }
    } else {
      $output .= '<tr><td colspan="9"><center>No data found</center></td></tr>';
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }
  public function storeAjax(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'designation' => 'required|unique:careers,designation',
      'location' => 'required',
      'no_of_position' => 'required',
      'last_date' => 'required',
      'experience' => 'required',
      'job_type' => 'required',
      'description' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new Career;
    $field->designation = $request['designation'];
    $field->slug = slugify($request['designation']);
    $field->location = $request['location'];
    $field->no_of_position = $request['no_of_position'];
    $field->experience = $request['experience'];
    $field->job_type = $request['job_type'];
    $field->last_date = $request['last_date'];
    $field->description = $request['description'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function delete($id)
  {
    if ($id) {
      $row = Career::findOrFail($id);
      //   if ($row->photo_path != null) {
      //     unlink($row->photo_path);
      //   }
      echo $result = $row->delete();
    }
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'designation' => 'required|unique:careers,designation,' . $id,
        'location' => 'required',
        'no_of_position' => 'required',
        'last_date' => 'required',
        'experience' => 'required',
        'job_type' => 'required',
        'description' => 'required',
      ]
    );
    $field = Career::find($id);
    $field->designation = $request['designation'];
    $field->slug = slugify($request['designation']);
    $field->location = $request['location'];
    $field->no_of_position = $request['no_of_position'];
    $field->experience = $request['experience'];
    $field->job_type = $request['job_type'];
    $field->last_date = $request['last_date'];
    $field->description = $request['description'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route);
  }
}
