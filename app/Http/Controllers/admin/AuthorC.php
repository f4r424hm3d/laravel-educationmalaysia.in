<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorC extends Controller
{
  public function index($id = null)
  {
    $page_no = $_GET['page'] ?? 1;

    $rows = Author::all();
    if ($id != null) {
      $sd = Author::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/authors/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/authors/');
      }
    } else {
      $ft = 'add';
      $url = url('admin/authors/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Authors";
    $page_route = "authors";
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url');
    return view('admin.authors')->with($data);
  }
  public function storeAjax(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'profile_pic' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new Author();
    if ($request->hasFile('profile_pic')) {
      $fileOriginalName = $request->file('profile_pic')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('profile_pic')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('profile_pic')->move('uploads/authors/', $file_name);
      if ($move) {
        $field->profile_pic = $file_name;
        $field->profile_pic_path = 'uploads/authors/' . $file_name;
      }
    }
    $field->name = $request['name'];
    $field->email = $request['email'];
    $field->mobile = $request['mobile'];
    $field->role = $request['role'];
    $field->shortnote = $request['shortnote'];
    $field->highlights = $request['highlights'];
    $field->experiance = $request['experiance'];
    $field->education = $request['education'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = Author::find($id)->delete();
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;

    //$rows = Author::where('status', $status);

    $rows = Author::paginate(10)->withPath('/admin/authors/');
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
      <th>S.No.</th>
      <th>Name</th>
      <th>Pic</th>
      <th>Details</th>
      <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>
        <span>' . $row->name . '</span><br>
        <span>' . $row->email . '</span><br>
        <span>' . $row->mobile . '</span>
      </td>
      <td>';
      if ($row->profile_pic_path != null) {
        $output .= '<img src="' . asset($row->profile_pic_path) . '" alt="" height="80" width="80">';
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
                ' . $row->experiance . '
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
      <td>
        <a href="javascript:void()" onclick="DeleteAjax(`' . $row->id . '`)"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . url('admin/authors/update/' . $row->id) . '"
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
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'name' => 'required',
        'profile_pic' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
      ]
    );

    $field = Author::find($id);
    if ($request->hasFile('profile_pic')) {
      $fileOriginalName = $request->file('file')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('profile_pic')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('profile_pic')->move('uploads/authors/', $file_name);
      if ($move) {
        $field->profile_pic = $file_name;
        $field->profile_pic_path = 'uploads/authors/' . $file_name;
      }
    }
    $field->name = $request['name'];
    $field->email = $request['email'];
    $field->mobile = $request['mobile'];
    $field->role = $request['role'];
    $field->shortnote = $request['shortnote'];
    $field->highlights = $request['highlights'];
    $field->experiance = $request['experiance'];
    $field->education = $request['education'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/authors');
  }
}
