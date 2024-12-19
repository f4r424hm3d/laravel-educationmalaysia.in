<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobPage;
use App\Models\JobPageTab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobPageTabC extends Controller
{
  public function index($page_id, $id = null)
  {
    $users = User::all();
    $jobpage = JobPage::find($page_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = JobPageTab::where('page_id', $page_id)->get();
    if ($id != null) {
      $sd = JobPageTab::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/job-page-tabs/' . $page_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/job-page-tabs/' . $page_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/job-page-tabs/' . $page_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Job Page Tabs";
    $page_route = "job-page-tabs";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'jobpage', 'page_no', 'users');
    return view('admin.job-page-tabs')->with($data);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = JobPageTab::orderBy('position')->where('id', '!=', '0');
    if ($request->has('page_id') && $request->page_id != '') {
      $rows = $rows->where('page_id', $request->page_id);
    }
    $rows = $rows->paginate(10)->withPath('/admin/job-page-tabs/');
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Tab</th>
        <th>Position [To Change Press ENTER button]</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->tab_name . '</td>
      <td><input class="position-update" type="number" value="' . $row->position . '" data-id="' . $row->id . '" /></td>';
      $output .= '<td>
        <a href="' . url('/admin/job-page-tab-contents/' . $row->id) . '"
        class="waves-effect waves-light btn btn-xs btn-outline-success">Content <span class="badge bg-dark">' . $row->getAllContent->count() . '</span></a>
        <a href="javascript:void()" onclick="DeleteAjax(' . $row->id . ')"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . url('admin/job-page-tabs/' . $request->page_id . '/update/' . $row->id) . '"
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
      'tab_name' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }
    $chk = JobPageTab::where('page_id', $request['page_id'])->where('tab_name', $request['tab_name'])->count();
    if ($chk == 0) {
      $field = new JobPageTab();
      $field->page_id = $request['page_id'];
      $field->tab_name = $request['tab_name'];
      $field->tab_slug = slugify($request['tab_name']);
      $field->save();
      return response()->json(['success' => 'Record hase been added succesfully.']);
    } else {
      return response()->json(['failed' => 'Tab URL already exist.']);
    }
  }
  public function delete($id)
  {
    echo $result = JobPageTab::find($id)->delete();
  }
  public function update($page_id, $id, Request $request)
  {
    $request->validate(
      [
        'tab_name' => 'required',
      ]
    );
    $chk = JobPageTab::where('page_id', $request['page_id'])->where('id', '!=', $id)->where('tab_name', $request['tab_name'])->count();
    if ($chk == 0) {
      $field = JobPageTab::find($id);
      $field->page_id = $request['page_id'];
      $field->tab_name = $request['tab_name'];
      $field->tab_slug = slugify($request['tab_name']);
      $field->save();
      session()->flash('smsg', 'Record has been updated successfully.');
    } else {
      session()->flash('emsg', 'Tab URl already exist.');
    }
    return redirect('admin/job-page-tabs/' . $page_id);
  }
}
