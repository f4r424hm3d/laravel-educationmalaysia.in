<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LandingPageC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'landing-pages';
  }
  public function index($id = null)
  {
    $page_no = $_GET['page'] ?? 1;
    $rows = LandingPage::get();
    if ($id != null) {
      $sd = LandingPage::find($id);
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
    $page_title = "Landing Pages";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'page_no');
    return view('admin.landing-pages')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = LandingPage::where('id', '!=', '0');
    $rows = $rows->paginate(10)->withPath('/admin/' . $this->page_route);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Page Name</th>
        <th>Date And Address</th>
        <th>Image</th>
        <th>Content</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    if ($rows->count() > 0) {
      foreach ($rows as $row) {
        $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->page_name . '</td>
      <td>' . $row->date_and_address . '</td>
      <td>
        <a href="' . asset($row->date_and_address_image) . '" target="_blank"><img src="' . asset($row->date_and_address_image) . '" height="20" width="20" /></a>
      </td>
      <td>
        ' . Blade::render('<x-custom-button :url="$url" label="Banners" :count="$count" />', ['url' => url('admin/landing-page-banners/' . $row->id), 'count' => $row->banners->count()]) . '<br>' . Blade::render('<x-custom-button :url="$url" label="Universities" :count="$count" />', ['url' => url('admin/landing-page-universities/' . $row->id), 'count' => $row->universities->count()]) . '<br>' . Blade::render('<x-custom-button :url="$url" label="Faqs" :count="$count" />', ['url' => url('admin/landing-page-faqs/' . $row->id), 'count' => $row->faqs->count()]) . '
      </td>
      <td>
      ' . Blade::render('<x-edit-button :url="$url" />', ['url' => url("admin/" . $this->page_route . "/update/" . $row->id)]) . '
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
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'page_name' =>  [
        'required',
        Rule::unique('landing_pages', 'page_name')->where('website', site_var),
      ],
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new LandingPage;
    $field->website = site_var;
    $field->page_name = $request['page_name'];
    $field->page_slug = slugify($request['page_slug']);
    $field->date_and_address = $request['date_and_address'];
    if ($request->hasFile('date_and_address_image')) {
      $fileOriginalName = $request->file('date_and_address_image')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('date_and_address_image')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('date_and_address_image')->move('uploads/scholarship/', $file_name);
      if ($move) {
        $field->date_and_address_image = 'uploads/scholarship/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'page_name' =>  [
          'required',
          Rule::unique('landing_pages', 'page_name')->where('website', site_var)->ignore($id),
        ],
      ]
    );
    $field = LandingPage::find($id);
    $field->website = site_var;
    $field->page_name = $request['page_name'];
    $field->page_slug = slugify($request['page_slug']);
    $field->date_and_address = $request['date_and_address'];
    if ($request->hasFile('date_and_address_image')) {
      $fileOriginalName = $request->file('date_and_address_image')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('date_and_address_image')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('date_and_address_image')->move('uploads/scholarship/', $file_name);
      if ($move) {
        $field->date_and_address_image = 'uploads/scholarship/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route);
  }
  public function delete($id)
  {
    if ($id) {
      $row = LandingPage::findOrFail($id);
      if ($row->date_and_address_image != null) {
        unlink($row->date_and_address_image);
      }
      $result = $row->delete();
      if ($result) {
        return response()->json(['success' => true]);
      }
    }
  }
}
