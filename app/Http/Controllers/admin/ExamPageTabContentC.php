<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamTab;
use App\Models\ExamTabContent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ExamPageTabContentC extends Controller
{
  public function index($tab_id, $id = null)
  {
    $users = User::all();
    $examtab = ExamTab::find($tab_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = ExamTabContent::where('tab_id', $tab_id)->where('parent_id', null)->orderBy('id', 'desc')->get();
    if ($id != null) {
      $sd = ExamTabContent::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/exam-page-tab-contents/' . $tab_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/exam-page-tab-contents/' . $tab_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/exam-page-tab-contents/' . $tab_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Exam Page Tab Contents";
    $page_route = "exam-page-tab-contents";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'examtab', 'page_no', 'users');
    return view('admin.exam-page-tab-contents')->with($data);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = ExamTabContent::where('id', '!=', '0');
    if ($request->has('tab_id') && $request->tab_id != '') {
      $rows = $rows->where('tab_id', $request->tab_id);
    }
    $rows = $rows->paginate(10)->withPath('/admin/exam-page-tab-contents/');
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Heading</th>
        <th>Parent Heading</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $parentHeading = $row->getParentHeading->heading ?? '';
      $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->heading . '</td>
      <td>' . $parentHeading . '</td>
      <td>';

      if ($row->description != null) {
        $output .= '<button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light"
                      data-bs-toggle="modal" data-bs-target="#descModalScrollable' . $row->id . '">View</button>
                    <div class="modal fade" id="descModalScrollable' . $row->id . '" tabindex="-1" role="dialog"
                      aria-labelledby="DescModalScrollableTitle' . $row->id . '" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="DescModalScrollableTitle' . $row->id . '">
                              SEO
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          <p>' . $row->description . '</p>
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
        <a href="' . url('admin/exam-page-tab-contents/' . $request->tab_id . '/update/' . $row->id) . '"
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
    $validator = FacadesValidator::make($request->all(), [
      'heading' => 'required',
    ]);

    if ($validator->fails()) {

      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new ExamTabContent();
    $field->tab_id = $request['tab_id'];
    $field->parent_id = $request['parent_id'];
    $field->heading = $request['heading'];
    $field->description = $request['description'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function delete($id)
  {
    echo $result = ExamTabContent::find($id)->delete();
  }
  public function update($tab_id, $id, Request $request)
  {
    $request->validate(
      [
        'heading' => 'required',
      ]
    );
    $field = ExamTabContent::find($id);
    $field->tab_id = $request['tab_id'];
    $field->parent_id = $request['parent_id'];
    $field->heading = $request['heading'];
    $field->description = $request['description'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/exam-page-tab-contents/' . $tab_id);
  }
  public function getHeadings(Request $request)
  {
    $rows = ExamTabContent::where('tab_id', $request->tab_id)->where('parent_id', null)->get();
    $output = '<option value="">Select</option>';
    foreach ($rows as $row) {
      $output .= '<option value="' . $row->id . '">' . $row->heading . '</option>';
    }
    return $output;
  }
}
