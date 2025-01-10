<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\LandingPageFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class LandingPageFaqC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'landing-page-faqs';
  }
  public function index(Request $request, $landing_page_id, $id = null)
  {
    $page = LandingPage::find($landing_page_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = LandingPageFaq::where('landing_page_id', $landing_page_id)->get();
    if ($id != null) {
      $sd = LandingPageFaq::find($id);
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
    $page_title = "Faqs";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url', 'landing_page_id',  'page');
    return view('admin.landing-page-faqs')->with($data);
  }
  public function store(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'landing_page_id' => 'required',
        'question' => 'required',
        'answer' => 'required',
      ]
    );

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new LandingPageFaq();
    $field->landing_page_id = $request['landing_page_id'];
    $field->question = $request['question'];
    $field->answer = $request['answer'];
    $field->save();

    return response()->json(['success' => 'Records inserted successfully.']);
  }
  public function update($landing_page_id, $id, Request $request)
  {
    $request->validate(
      [
        'question' => 'required',
        'answer' => 'required',
      ]
    );
    $field = LandingPageFaq::find($id);
    $field->question = $request['question'];
    $field->answer = $request['answer'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route . '/' . $landing_page_id);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = LandingPageFaq::where('landing_page_id', $request->landing_page_id)->paginate(10)->withPath('/admin/' . $this->page_route . '/' . $request->landing_page_id);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Question</th>
        <th>Answer</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
            <td>' . $i . '</td>
            <td>' . $row->question . '</td>
            <td>' . Blade::render('<x-content-view-modal :row="$row" field="answer" title="Answer" />', ['row' => $row]) . '</a>
            </td>
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
      $row = LandingPageFaq::findOrFail($id);

      $row->delete();
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
}
