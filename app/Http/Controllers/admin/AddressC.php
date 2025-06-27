<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class AddressC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'addresses';
  }
  public function index($id = null)
  {
    $page_no = $_GET['page'] ?? 1;
    $countries = Country::orderBy('name')->get();
    $rows = Address::get();
    if ($id != null) {
      $sd = Address::find($id);
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

    $page_title = "Addresses";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'page_no', 'countries');
    return view('admin.addresses')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = Address::orderBy('id', 'desc');
    $rows = $rows->paginate(10)->withPath('/admin/' . $this->page_route);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Country</th>
        <th>City</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Address</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    if ($rows->count() > 0) {
      foreach ($rows as $row) {
        $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->country . '</td>
      <td>' . $row->city . '</td>
      <td>' . $row->mobile . '</td>
      <td>' . $row->email . '</td>
      <td>' . $row->address . '</td>
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
      'country' => 'required',
      'city' => 'required',
      'mobile' => 'required',
      'email' => 'required|email',
      'address' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new Address;
    $field->website = site_var;
    $field->country = $request['country'];
    $field->city = $request['city'];
    $field->mobile = $request['mobile'];
    $field->email = $request['email'];
    $field->address = $request['address'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'country' => 'required',
        'city' => 'required',
        'mobile' => 'required',
        'email' => 'required|email',
        'address' => 'required',
      ]
    );
    $field = Address::find($id);
    $field->country = $request['country'];
    $field->city = $request['city'];
    $field->mobile = $request['mobile'];
    $field->email = $request['email'];
    $field->address = $request['address'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route);
  }
  public function delete($id)
  {
    if ($id) {
      $row = Address::findOrFail($id);
      //   if ($row->photo_path != null) {
      //     unlink($row->photo_path);
      //   }
      $result = $row->delete();
      return response()->json(['success' => true]);
    }
  }
}
