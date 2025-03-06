<?php

namespace App\Http\Controllers\admin;

use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadFilesC extends Controller
{
  public function index($id = null)
  {
    $page_no = $_GET['page'] ?? 1;

    $rows = UploadFiles::orderBy('id', 'desc')->get();
    if ($id != null) {
      $sd = UploadFiles::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/upload-files/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/upload-files/');
      }
    } else {
      $ft = 'add';
      $url = url('admin/upload-files/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Upload Files";
    $page_route = "upload-files";
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url');
    return view('admin.upload-files')->with($data);
  }
  public function storeAjax(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'file' => 'required|max:5000|mimes:jpg,jpeg,png,gif,webp',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new UploadFiles();
    if ($request->hasFile('file')) {
      $fileOriginalName = $request->file('file')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('file')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('file')->move('uploads/files/', $file_name);
      if ($move) {
        $field->file_name = $file_name;
        $field->file_path = 'uploads/files/' . $file_name;
      }
    }

    // Handle Logo Upload
    // $fileUpload = FileUploadHelper::uploadFile($request, 'file', 'organizations/files');
    // if (!empty($fileUpload)) {
    //   $field->file_name = $fileUpload['fileName'];
    //   $field->file_path = $fileUpload['filePath'];
    // }


    $field->title = $request['title'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = UploadFiles::find($id)->delete();
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;

    //$rows = UploadFiles::where('status', $status);

    $rows = UploadFiles::orderBy('id', 'desc')->paginate(10)->withPath('/admin/upload-files/');
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Title</th>
        <th>Date</th>
        <th>File</th>
        <th>Url</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->title . '</td>
                  <td>' . getFormattedDate($row->created_at, 'd M Y - h:i A') . '</td>
                  <td>
                    <a href="' . asset($row->file_path) . '" target="_blank"
                      class="waves-effect waves-light btn btn-xs btn-info">view</a> | <a
                      href="' . asset($row->file_path) . '" download
                      class="waves-effect waves-light btn btn-xs btn-danger">download</a>
                  </td>
                  <td>
                    <input type="text" id="url' . $row->id . '" value="' . asset($row->file_path) . '">&nbsp;&nbsp;
                    <a onclick="copyFunc(`' . $row->id . '`)" href="javascript:void()" data-toggle="tooltip"
                      class="waves-effect waves-light btn btn-xs btn-warning" title="Copy to clipboard">Copy</a>
                  </td>
                  <td>
                    <a href="javascript:void()" onclick="DeleteAjax(`' . $row->id . '`,`' . $row->file_name . '`)"
                      class="waves-effect waves-light btn btn-xs btn-danger">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                  </td>
    </tr>';
      $i++;
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }
}
