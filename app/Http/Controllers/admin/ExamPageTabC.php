<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamTab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamPageTabC extends Controller
{
  public function index($exam_id, $id = null)
  {
    $users = User::all();
    $exam = Exam::find($exam_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = ExamTab::where('exam_id', $exam_id)->where('parent_id', null)->get();
    if ($id != null) {
      $sd = ExamTab::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/exam-page-tabs/' . $exam_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/exam-page-tabs/' . $exam_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/exam-page-tabs/' . $exam_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Exam Page Tabs";
    $page_route = "exam-page-tabs";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'exam', 'page_no', 'users');
    return view('admin.exam-page-tabs')->with($data);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = ExamTab::where('id', '!=', '0');
    if ($request->has('exam_id') && $request->exam_id != '') {
      $rows = $rows->where('exam_id', $request->exam_id);
    }
    $rows = $rows->paginate(10)->withPath('/admin/exam-page-tabs/');
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Tab</th>
        <th>Author</th>
        <th>Image</th>
        <th>Description</th>
        <th>SEO</th>
        <th>Header View</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $parentTab = $row->getParentTab->tab_name ?? '';
      $author = $row->getUser->name ?? '';
      $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>
      Tab Name : ' . $row->tab_name . ' <br>
      Tab URL : ' . $row->tab_slug . ' <br>
      Parent Tab : ' . $parentTab . ' <br>
      </td>
      <td>' . $author . '</td>
      <td>';
      if ($row->image_path != null) {
        $output .= '<img src="' . asset($row->image_path) . '" alt="" height="80" width="80">';
      } else {
        $output .= 'N/A';
      }
      $output .= '</td><td>';
      if ($row->heading != null) {
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
                          <h4>Title</h4>
                            ' . $row->heading . ' <br>
                            <h4>Description Top</h4>
                            ' . $row->description . ' <br>
                            <h4>Description Bottom</h4>
                            ' . $row->description2 . ' <br>
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
      $output .= '</td><td>';
      if ($row->meta_title != null) {
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
                            ' . $row->meta_title . '<br>
                            ' . $row->meta_keyword . ' <br>
                            ' . $row->meta_description . ' <br>
                            ' . $row->page_content . ' <br>
                            ' . $row->seo_rating . '
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
      $class1 = $row->header_view == 1 ? '' : 'hide-this';
      $class2 = $row->header_view == 0 ? '' : 'hide-this';
      $output .= '</td><td><span id="aheader_view' . $row->id . '"
      class="badge bg-success ' . $class1 . '"
      onclick="changeStatus(`' . $row->id . '`,`header_view`,`0`)">Active</span>
    <span id="iheader_view' . $row->id . '"
      class="badge bg-danger ' . $class2 . '"
      onclick="changeStatus(`' . $row->id . '`,`header_view`,`1`)">Inactive</span>';
      $output .= '</td><td>
        <a href="' . url('/admin/exam-page-tab-contents/' . $row->id) . '"
        class="waves-effect waves-light btn btn-xs btn-outline-success">Content <span class="badge bg-dark">' . $row->getAllContent->count() . '</span></a>
        <a href="javascript:void()" onclick="DeleteAjax(' . $row->id . ')"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . url('admin/exam-page-tabs/' . $request->exam_id . '/update/' . $row->id) . '"
          class="waves-effect waves-light btn btn-xs btn-outline btn-info">
          <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
        <a href="' . url('/admin/exam-tab-faqs/' . $row->id) . '" class="waves-effect waves-light btn btn-xs btn-outline btn-primary">Faq</a>
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
      'tab_slug' => 'required',
      'heading' => 'required',
      'description' => 'required',
      'thumbnail' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
    ]);

    if ($validator->fails()) {

      return response()->json([
        'error' => $validator->errors(),
      ]);
    }
    $chk = ExamTab::where('exam_id', $request['exam_id'])->where('tab_slug', slugify($request['tab_slug']))->count();
    if ($chk == 0) {
      $field = new ExamTab();
      $field->exam_id = $request['exam_id'];
      $field->author_id = $request['author_id'];
      $field->parent_id = $request['parent_id'];
      $field->tab_name = $request['tab_name'];
      $field->tab_slug = slugify($request['tab_slug']);
      $field->heading = $request['heading'];
      $field->description = $request['description'];
      $field->description2 = $request['description2'];
      $field->header_view = $request['header_view'];
      $field->meta_title = $request['meta_title'];
      $field->meta_keyword = $request['meta_keyword'];
      $field->meta_description = $request['meta_description'];
      $field->page_content = $request['page_content'];
      $field->seo_rating = $request['seo_rating'];
      if ($request->hasFile('thumbnail')) {
        $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
        $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $file_name_slug = slugify($fileNameWithoutExtention);
        $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
        $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
        $move = $request->file('thumbnail')->move('uploads/exams/', $file_name);
        if ($move) {
          $field->image_name = $file_name;
          $field->image_path = 'uploads/exams/' . $file_name;
        } else {
          session()->flash('emsg', 'Some problem occured. File not uploaded.');
        }
      }
      $field->save();
      return response()->json(['success' => 'Record hase been added succesfully.']);
    } else {
      return response()->json(['failed' => 'Tab URL already exist.']);
    }
  }
  public function delete($id)
  {
    echo $result = ExamTab::find($id)->delete();
  }
  public function update($exam_id, $id, Request $request)
  {
    $request->validate(
      [
        'tab_name' => 'required',
        'tab_slug' => 'required',
        'heading' => 'required',
        'description' => 'required',
        'thumbnail' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
      ]
    );
    $chk = ExamTab::where('exam_id', $request['exam_id'])->where('id', '!=', $id)->where('tab_slug', slugify($request['tab_slug']))->count();
    if ($chk == 0) {
      $field = ExamTab::find($id);
      $field->exam_id = $request['exam_id'];
      $field->author_id = $request['author_id'];
      $field->parent_id = $request['parent_id'];
      $field->tab_name = $request['tab_name'];
      $field->tab_slug = slugify($request['tab_slug']);
      $field->heading = $request['heading'];
      $field->description = $request['description'];
      $field->description2 = $request['description2'];
      $field->header_view = $request['header_view'];
      $field->meta_title = $request['meta_title'];
      $field->meta_keyword = $request['meta_keyword'];
      $field->meta_description = $request['meta_description'];
      $field->page_content = $request['page_content'];
      $field->seo_rating = $request['seo_rating'];
      if ($request->hasFile('thumbnail')) {
        $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
        $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $file_name_slug = slugify($fileNameWithoutExtention);
        $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
        $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
        $move = $request->file('thumbnail')->move('uploads/exams/', $file_name);
        if ($move) {
          $field->image_name = $file_name;
          $field->image_path = 'uploads/exams/' . $file_name;
        } else {
          session()->flash('emsg', 'Some problem occured. File not uploaded.');
        }
      }
      $field->save();
      session()->flash('smsg', 'Record has been updated successfully.');
    } else {
      session()->flash('emsg', 'Tab URl already exist.');
    }
    return redirect('admin/exam-page-tabs/' . $exam_id);
  }
  public function getTabs(Request $request)
  {
    $rows = ExamTab::where('exam_id', $request->exam_id)->where('parent_id', null)->get();
    $output = '<option value="">Select</option>';
    foreach ($rows as $row) {
      $output .= '<option value="' . $row->id . '">' . $row->tab_name . '</option>';
    }
    return $output;
  }
}
