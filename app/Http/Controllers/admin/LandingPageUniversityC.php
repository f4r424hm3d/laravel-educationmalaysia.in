<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\LandingPageUniversity;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class LandingPageUniversityC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'landing-page-universities';
  }
  public function index(Request $request, $landing_page_id, $id = null)
  {
    $universities = University::all();
    $page = LandingPage::find($landing_page_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = LandingPageUniversity::where('landing_page_id', $landing_page_id)->get();
    if ($id != null) {
      $sd = LandingPageUniversity::find($id);
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
    $page_title = "Universities";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url', 'landing_page_id',  'page', 'universities');
    return view('admin.landing-page-universities')->with($data);
  }
  public function store(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'landing_page_id' => 'required',
        'university_id' => 'required|array',
      ]
    );

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $landingPageId = $request->landing_page_id;
    $universitiesId = $request->university_id;
    $boothNo = $request->booth_no;

    $insertedCount = 0;
    foreach ($universitiesId as $id) {
      // Check if the record already exists
      $exists = LandingPageUniversity::where('landing_page_id', $landingPageId)
        ->where('university_id', $id)
        ->exists();

      if (!$exists) {
        // Insert only if the record does not exist
        $field = new LandingPageUniversity();
        $field->landing_page_id = $landingPageId;
        $field->booth_no = $boothNo;
        $field->university_id = $id;
        $field->save();
        $insertedCount++;
      }
    }

    if ($insertedCount > 0) {
      return response()->json(['success' => "$insertedCount records inserted successfully."]);
    }
    return response()->json(['success' => 'No new records were inserted as they already exist.']);
  }

  public function update($landing_page_id, $id, Request $request)
  {
    $request->validate(
      [
        'university_id' => 'required',
      ]
    );
    $field = LandingPageUniversity::find($id);
    $field->booth_no = $request['booth_no'];
    $field->university_id = $request['university_id'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route . '/' . $landing_page_id);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = LandingPageUniversity::where('landing_page_id', $request->landing_page_id)->paginate(30)->withPath('/admin/' . $this->page_route . '/' . $request->landing_page_id);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>University</th>
        <th>Booth No</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
            <td>' . $i . '</td>
            <td>' . $row->university->name . '</td>
            <td>' . $row->booth_no . '</td>
            <td>
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
      $row = LandingPageUniversity::findOrFail($id);
      $row->delete();
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
}
