<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\LandingPageBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class LandingPageBannerC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'landing-page-banners';
  }
  public function index(Request $request, $landing_page_id, $id = null)
  {
    $page = LandingPage::find($landing_page_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = LandingPageBanner::where('landing_page_id', $landing_page_id)->get();
    if ($id != null) {
      $sd = LandingPageBanner::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/' . $this->page_route . '/' . $landing_page_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/' . $this->page_route . '/' . $landing_page_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/' . $this->page_route . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Banners";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url', 'landing_page_id',  'page');
    return view('admin.landing-page-banners')->with($data);
  }
  public function store(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'landing_page_id' => 'required',
        'alt_text' => 'required',
        'photo.*' => 'required|max:5000|mimes:jpg,jpeg,png,gif,webp',
      ],
      [
        'photo.*.required' => 'Please upload an image',
        'photo.*.mimes' => 'Only jpg, jpeg, png and gif images are allowed',
        'photo.*.max' => 'Sorry! Maximum allowed size for an image is 5MB',
      ]
    );

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    if ($request->hasFile('photo')) {
      foreach ($request->file('photo') as $key => $file) {
        $field = new LandingPageBanner();
        $field->landing_page_id = $request['landing_page_id'];
        $field->alt_text = $request['alt_text'];
        $fileOriginalName = $file->getClientOriginalName();
        $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $file_name_slug = slugify($fileNameWithoutExtention);
        $file_name = $file_name_slug . '-' . time() . '.' . $file->getClientOriginalExtension();
        $move = $file->move('uploads/landingpage/', $file_name);
        if ($move) {
          $field->file_name = $file_name;
          $field->file_path = 'uploads/landingpage/' . $file_name;
        } else {
          session()->flash('emsg', 'Images not uploaded.');
        }
        $field->save();
      }
    }

    return response()->json(['success' => 'Records inserted successfully.']);
  }
  public function update($landing_page_id, $id, Request $request)
  {
    $request->validate(
      [
        'landing_page_id' => 'required',
        'alt_text' => 'required',
        'photo' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
      ]
    );
    $field = LandingPageBanner::find($id);
    if ($request->hasFile('photo')) {
      $fileOriginalName = $request->file('photo')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('photo')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('photo')->move('uploads/landingpage/', $file_name);
      if ($move) {
        if ($field->file_path != null && file_exists($field->file_path)) {
          unlink($field->file_path);
        }
        $field->file_name = $file_name;
        $field->file_path = 'uploads/landingpage/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->alt_text = $request['alt_text'];

    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route . '/' . $landing_page_id);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = LandingPageBanner::where('landing_page_id', $request->landing_page_id)->paginate(10)->withPath('/admin/' . $this->page_route . '/' . $request->landing_page_id);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Alt Text</th>
        <th>Banner</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
            <td>' . $i . '</td>
            <td>' . $row->alt_text . '</td>
            <td>
            <a href="' . asset($row->file_path) . '" target="_blank" ><img src="' . asset($row->file_path) . '" height="20" width="20" /></a>
            </td><td>
              ' . Blade::render('<x-delete-button :id="$id" />', ['id' => $row->id]) . '
              ' . Blade::render('<x-edit-button :url="$url" />', ['url' => url('admin/' . $this->page_route . '/' . $request->landing_page_id . '/update/' . $row->id)]) . '
            </td>
          </tr>';
      $i++;
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }
  public function delete($id)
  {
    if ($id) {
      $row = LandingPageBanner::findOrFail($id);
      if ($row->file_path != null && file_exists($row->file_path)) {
        unlink($row->file_path);
      }
      $row->delete();
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
}
