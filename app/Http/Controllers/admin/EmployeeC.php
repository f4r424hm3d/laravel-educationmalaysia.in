<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmployeeC extends Controller
{
  public function index($id = null)
  {
    $ws = EmployeeStatus::all();
    $page_no = $_GET['page'] ?? 1;

    $designations = User::select('designation')->groupBy('designation')->get();
    $departments = User::select('department')->groupBy('department')->get();
    $branches = User::select('branch')->groupBy('branch')->get();

    if ($id != null) {
      $sd = User::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/employees/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/employees/');
      }
    } else {
      $ft = 'add';
      $url = url('admin/employees/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Employees";
    $page_route = "employees";
    $data = compact('sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url', 'ws', 'designations', 'departments', 'branches');
    return view('admin.employees')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = User::orderBy('priority', 'asc')->employees()->paginate(10)->withQueryString();
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
      <th>S.No.</th>
      <th></th>
      <th>Contact</th>
      <th>Company Detail</th>
      <th>Pic</th>
      <th>More</th>
      <th>Status</th>
      <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td><input type="number" onchange="updateField(`' . $row->id . '`,this.value)" value="' . $row->priority . '" class="form-control" style="width:45%" /></td>
      <td>
        <span>' . $row->name . '</span><br>
        <span>' . $row->email . '</span><br>
        <span>' . $row->mobile . '</span>
      </td>
      <td>
        Designation : <span>' . $row->designation . '</span><br>
        Department : <span>' . $row->department . '</span><br>
        Branch : <span>' . $row->branch . '</span><br>
        Experience : <span>' . $row->experience_short . '</span><br>
      </td>
      <td>';
      if ($row->profile_picture != null) {
        $output .= '<img src="' . asset($row->profile_picture) . '" alt="" height="80" width="80">';
      } else {
        $output .= 'N/A';
      }
      $output .= '</td>
      <td>';
      if ($row->shortnote != null || $row->highlights != null || $row->experiance != null || $row->education != null) {
        $output .= '<button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#SModalScrollable' . $row->id . '">View</button>
        <div class="modal fade" id="SModalScrollable' . $row->id . '" tabindex="-1" role="dialog"
          aria-labelledby="SModalScrollableTitle' . $row->id . '" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <h4>Shortnote</h4>
                ' . $row->shortnote . '
                <hr>
                <h4>Highlights</h4>
                ' . $row->highlights . '
                <hr>
                <h4>Education</h4>
                ' . $row->education . '
                <hr>
                <h4>Experiance</h4>
                ' . $row->experience_description . '
                <hr>
                <hr>
                <h4>Languages</h4>
                ' . $row->languages . '
                <hr>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>';
      } else {
        $output .= 'N/A';
      }
      $output .= '</td>
      <td>';
      if ($row->working_status != null) {
        $output .= '<span class="badge bg-' . $row->ws->class . '">' . $row->ws->status . '</span>';
      } else {
        $output .= 'N/A';
      }
      $output .= '</td>
      <td>
        <a href="javascript:void()" onclick="DeleteAjax(`' . $row->id . '`)"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . url('admin/employees/update/' . $row->id) . '"
          class="waves-effect waves-light btn btn-xs btn-outline btn-info">
          <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
      </td>
    </tr>';
      $i++;
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'department' => 'required',
      'designation' => 'required',
      'branch' => 'required',
      'experience_short' => 'required',
      'profile_picture' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new User();
    if ($request->hasFile('profile_picture')) {
      $fileOriginalName = $request->file('profile_picture')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('profile_picture')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('profile_picture')->move('uploads/employees/', $file_name);
      if ($move) {
        $field->profile_picture = 'uploads/employees/' . $file_name;
      }
    }
    $field->name = $request['name'];
    $field->slug = slugify($request['name']);
    $field->email = $request['email'];
    $field->username = $request['email'];
    $field->password = Str::random(10);
    $field->mobile = $request['mobile'];
    $field->role = 'employee';
    $field->designation = $request['designation'];
    $field->department = $request['department'];
    $field->branch = $request['branch'];
    $field->experience_short = $request['experience_short'];
    $field->shortnote = $request['shortnote'];
    $field->highlights = $request['highlights'];
    $field->experience_description = $request['experience_description'];
    $field->education = $request['education'];
    $field->languages = $request['languages'];
    $field->working_status = $request['working_status'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'name' => 'required',
        'department' => 'required',
        'designation' => 'required',
        'branch' => 'required',
        'experience_short' => 'required',
        'profile_picture' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
      ]
    );

    $field = User::find($id);
    if ($request->hasFile('profile_picture')) {
      $fileOriginalName = $request->file('profile_picture')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('profile_picture')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('profile_picture')->move('uploads/employees/', $file_name);
      if ($move) {
        $field->profile_picture = 'uploads/employees/' . $file_name;
      }
    }
    $field->name = $request['name'];
    $field->slug = slugify($request['name']);
    $field->email = $request['email'];
    $field->username = $request['email'];
    $field->password = Str::random(10);
    $field->mobile = $request['mobile'];
    $field->role = 'employee';
    $field->designation = $request['designation'];
    $field->department = $request['department'];
    $field->branch = $request['branch'];
    $field->experience_short = $request['experience_short'];
    $field->shortnote = $request['shortnote'];
    $field->highlights = $request['highlights'];
    $field->experience_description = $request['experience_description'];
    $field->education = $request['education'];
    $field->languages = $request['languages'];
    $field->working_status = $request['working_status'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/employees');
  }
  public function delete($id)
  {
    echo $result = User::find($id)->delete();
  }
}
