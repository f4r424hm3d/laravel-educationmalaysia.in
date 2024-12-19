<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeStatusC extends Controller
{
  public function index($id = null)
  {
    $classes = ['info', 'primary', 'danger', 'warning', 'success'];
    $page_no = $_GET['page'] ?? 1;
    //$roles = Role::all();
    if ($id != null) {
      $sd = EmployeeStatus::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/employee-statuses/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/employee-statuses/');
      }
    } else {
      $ft = 'add';
      $url = url('admin/employee-statuses/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Employees";
    $page_route = "employee-statuses";
    $data = compact('sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url', 'classes');
    return view('admin.employee-statuses')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = EmployeeStatus::paginate(10)->withQueryString();
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
      <th>S.No.</th>
      <th>Status</th>
      <th>Shortnote</th>
      <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>
        <span class="badge bg-' . $row->class . '">' . $row->status . '</span>
      </td><td>' . $row->shortnote . '</td>';
      $output .= '<td>
        <a href="javascript:void()" onclick="DeleteAjax(`' . $row->id . '`)"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . url('admin/employee-statuses/update/' . $row->id) . '"
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
      'status' => 'required',
      'class' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new EmployeeStatus();
    $field->status = $request['status'];
    $field->class = $request['class'];
    $field->shortnote = $request['shortnote'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'status' => 'required',
        'class' => 'required',
      ]
    );

    $field = EmployeeStatus::find($id);
    $field->status = $request['status'];
    $field->class = $request['class'];
    $field->shortnote = $request['shortnote'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/employee-statuses');
  }
  public function delete($id)
  {
    echo $result = EmployeeStatus::find($id)->delete();
  }
}
