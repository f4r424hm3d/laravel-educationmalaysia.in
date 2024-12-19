<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ExamTab;
use App\Models\ExamTabFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamTabFaqC extends Controller
{
  public function index($tab_id, $id = null)
  {
    $examtab = ExamTab::find($tab_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = ExamTabFaq::where('tab_id', $tab_id)->get();
    if ($id != null) {
      $sd = ExamTabFaq::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/exam-tab-faqs/' . $tab_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/exam-tab-faqs/' . $tab_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/exam-tab-faqs/' . $tab_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Exam Tab Faqs";
    $page_route = "exam-tab-faqs";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'examtab', 'page_no');
    return view('admin.exam-tab-faqs')->with($data);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = ExamTabFaq::where('id', '!=', '0');
    if ($request->has('tab_id') && $request->tab_id != '') {
      $rows = $rows->where('tab_id', $request->tab_id);
    }
    $rows = $rows->paginate(10)->withPath('/admin/doctor/hospitals/');
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
      <td>';

      if ($row->answer != null) {
        $output .= '<button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light"
          data-bs-toggle="modal" data-bs-target="#SeoModalScrollable' . $row->id . '">View</button>
        <div class="modal fade" id="SeoModalScrollable' . $row->id . '" tabindex="-1" role="dialog"
          aria-labelledby="SeoModalScrollableTitle' . $row->id . '" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="SeoModalScrollableTitle' . $row->id . '">
                  SEO
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                ' . $row->answer . '
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>';
      } else {
        $output .= 'Null';
      }
      $output .= '</td><td>
        <a href="javascript:void()" onclick="DeleteAjax(' . $row->id . ')"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . url('admin/exam-tab-faqs/' . $request->tab_id . '/update/' . $row->id) . '"
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
  public function storeAjax(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'question' => 'required',
      'answer' => 'required',
    ]);

    if ($validator->fails()) {

      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new ExamTabFaq();
    $field->tab_id = $request['tab_id'];
    $field->question = $request['question'];
    $field->answer = $request['answer'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function delete($id)
  {
    echo $result = ExamTabFaq::find($id)->delete();
  }
  public function update($tab_id, $id, Request $request)
  {
    $request->validate(
      [
        'question' => 'required',
        'answer' => 'required',
      ]
    );
    $field = ExamTabFaq::find($id);
    $field->question = $request['question'];
    $field->answer = $request['answer'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/exam-tab-faqs/' . $tab_id);
  }
}
