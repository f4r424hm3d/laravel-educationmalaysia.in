<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\University;
use App\Models\UniversityScholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UniversityScholarshipC extends Controller
{
  public function index($university_id, $id = null)
  {
    $page_no = $_GET['page'] ?? 1;
    $university = University::find($university_id);
    $levels = Level::where('destination_id', $university->destination_id)->get();
    // printArray($levels);
    // die;
    $rows = UniversityScholarship::where('university_id', $university_id)->get();
    if ($id != null) {
      $sd = UniversityScholarship::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/university-scholarships/' . $university_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/university-scholarships/' . $university_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/university-scholarships/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "University Scholarship";
    $page_route = "university-scholarships";
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'university', 'levels', 'url');
    return view('admin.university-scholarships')->with($data);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = UniversityScholarship::find($id)->delete();
  }
  public function update($university_id, $id, Request $request)
  {
    $request->validate(
      [
        'university_id' => 'required',
        'scholarship_name' => 'required',
      ]
    );
    $field = UniversityScholarship::find($id);
    $field->university_id = $request['university_id'];
    $field->scholarship_name = $request['scholarship_name'];
    $field->scholarship_slug = slugify($request['scholarship_slug']);
    $field->international_student_eligible = $request['international_student_eligible'];
    $field->amount = $request['amount'];
    $field->number_of_scholarship = $request['number_of_scholarship'];
    $field->level_id = $request['level_id'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/university-scholarships/' . $university_id);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = UniversityScholarship::where('id', '!=', '0');
    if ($request->has('university_id') && $request->university_id != '') {
      $rows = $rows->where('university_id', $request->university_id);
    }
    $rows = $rows->paginate(10)->withPath('/admin/university-scholarships/' . $request->university_id);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Scholarship</th>
        <th>Amount</th>
        <th>Level</th>
        <th>Other</th>
        <th>Content</th>
        <th>SEO</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>
      Name - ' . $row->scholarship_name . '<br>
      Slug - ' . $row->scholarship_slug . '
      </td>
      <td>' . $row->amount . '</td>
      <td>' . $row->getLevel->level . '</td>
      <td>
      International Student Eligible - ' . $row->international_student_eligible . '<br>
      Number Of Scholarship - ' . $row->number_of_scholarship . '
      </td>
      <td>
        <a title="Profile" href="' . aurl("university-scholarship-contents/") . '/' . $row->id . '"
        class="waves-effect waves-light btn btn-xs btn-outline btn-success">
        View
        </a>
      </td><td>';
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
      $path = url('admin/university-scholarships/' . $request->university_id . '/update/' . $row->id);
      $output .= '</td><td>
        <a href="javascript:void()" onclick="DeleteAjax(' . $row->id . ')"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . $path . '" class="waves-effect waves-light btn btn-xs btn-outline btn-info"><i class="fa fa-edit" aria-hidden="true"></i></a>
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
      'university_id' => 'required',
      'scholarship_name' => 'required',
    ]);

    if ($validator->fails()) {

      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $chk = UniversityScholarship::where(['university_id' => $request['university_id'], 'scholarship_name' => $request['scholarship_name']])->count();
    if ($chk == 0) {
      $field = new UniversityScholarship;
      $field->university_id = $request['university_id'];
      $field->scholarship_name = $request['scholarship_name'];
      $field->scholarship_slug = slugify($request['scholarship_slug']);
      $field->international_student_eligible = $request['international_student_eligible'];
      $field->amount = $request['amount'];
      $field->number_of_scholarship = $request['number_of_scholarship'];
      $field->level_id = $request['level_id'];
      $field->meta_title = $request['meta_title'];
      $field->meta_keyword = $request['meta_keyword'];
      $field->meta_description = $request['meta_description'];
      $field->page_content = $request['page_content'];
      $field->seo_rating = $request['seo_rating'];
      $field->save();

      return response()->json(['success' => 'Records inserted succesfully.']);
    } else {
      return response()->json(['failed' => 'Data not inserted. Duplicate rows found.']);
    }
  }
}
