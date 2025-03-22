<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UrlRedirection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class UrlRedirectionC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'url-redirections';
  }
  public function index($id = null)
  {
    $page_no = $_GET['page'] ?? 1;
    $rows = UrlRedirection::get();
    if ($id != null) {
      $sd = UrlRedirection::find($id);
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

    $page_title = "Url Redirections";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'page_no');
    return view('admin.url-redirections')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = UrlRedirection::where('id', '!=', '0');
    $rows = $rows->paginate(10)->withPath('/admin/' . $this->page_route);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Urls</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    if ($rows->count() > 0) {
      foreach ($rows as $row) {
        $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>
        <a href="' . url($row->old_url) . '" target="_blank">Old Url</a> : <input class="form-control form-group" type="text" value="' . $row->old_url . '" /> <br>
        <a href="' . url($row->new_url) . '" target="_blank">New Url</a> : <input class="form-control form-group" type="text" value="' . $row->new_url . '" />
      </td>
      <td>
        ' . Blade::render('<x-delete-button :id="$id" />', ['id' => $row->id]) . '
        ' . Blade::render('<x-edit-button :url="$url" />', ['url' => url("admin/" . $this->page_route . "/update/" . $row->id)]) . '
      </td>
    </tr>';
        $i++;
      }
    } else {
      $output .= '<tr><td colspan="4"><center>No data found</center></td></tr>';
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'old_url' => 'required',
      'new_url' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new UrlRedirection;
    $field->old_url = $request['old_url'];
    $field->new_url = $request['new_url'];
    $field->save();
    Artisan::call('optimize');
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function delete($id)
  {
    if ($id) {
      $row = UrlRedirection::findOrFail($id);
      //   if ($row->photo_path != null) {
      //     unlink($row->photo_path);
      //   }
      $result = $row->delete();
      return response()->json(['success' => true]);
    }
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'old_url' => 'required',
        'new_url' => 'required',
      ]
    );
    $field = UrlRedirection::find($id);
    $field->old_url = $request['old_url'];
    $field->new_url = $request['new_url'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route);
  }
}
