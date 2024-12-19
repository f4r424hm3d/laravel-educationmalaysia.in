<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\UniversityReviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UniversityReviewC extends Controller
{
  public function index($id = null)
  {
    $page_no = $_GET['page'] ?? 1;

    $rows = UniversityReviews::all();
    if ($id != null) {
      $sd = UniversityReviews::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/university-reviews/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/university-reviews/');
      }
    } else {
      $ft = 'add';
      $url = url('admin/university-reviews/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "University Reviews";
    $page_route = "university-reviews";
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url');
    return view('admin.university-reviews')->with($data);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = UniversityReviews::find($id)->delete();
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    if ($request->has('status') && $request->status != '') {
      $status = $request->status;
    } else {
      $status = '0';
    }
    $rows = UniversityReviews::where('status', $status);

    $rows = $rows->paginate(10)->withPath('/admin/university-reviews/');
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>University</th>
        <th>User</th>
        <th>Reviews</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>
      University - ' . $row->getUniversity->name . '<br>
      Program - ' . $row->getProgram->program_name . '<br>
      Passing Year - ' . $row->passing_year . '<br>
      </td>
      <td>
      Name - ' . $row->name . '<br>
      Email - ' . $row->email . '<br>
      Mobile - ' . $row->mobile . '<br>
      </td><td>';
      if ($row->review != null) {
        $output .= '<button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light"
                      data-bs-toggle="modal" data-bs-target="#SeoModalScrollable' . $row->id . '">View</button>
                    <div class="modal fade" id="SeoModalScrollable' . $row->id . '" tabindex="-1" role="dialog"
                      aria-labelledby="SeoModalScrollableTitle' . $row->id . '" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="SeoModalScrollableTitle' . $row->id . '">
                              Review
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <h4>Overall Review</h4>
                            <b>Title : </b><p>' . $row->title . '</p>
                            <b>Review : </b><p>' . $row->review . '</p>
                            <b>rating : </b><p>' . $row->rating . '</p>
                            <hr>
                            <h4>Infrastructure</h4>
                            <b>Review : </b><p>' . $row->infrastructure_review . '</p>
                            <b>rating : </b><p>' . $row->infrastructure_rating . '</p>
                            <hr>
                            <h4>Faculty</h4>
                            <b>Review : </b><p>' . $row->faculty_review . '</p>
                            <b>rating : </b><p>' . $row->faculty_rating . '</p>
                            <hr>
                            <h4>Placement</h4>
                            <b>Review : </b><p>' . $row->placement_review . '</p>
                            <b>rating : </b><p>' . $row->placement_rating . '</p>
                            <hr>
                            <h4>Hostel</h4>
                            <b>Review : </b><p>' . $row->hostel_review . '</p>
                            <b>rating : </b><p>' . $row->hostel_rating . '</p>
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
      $path = url('admin/university-reviews/update/' . $row->id);
      $class1 = $row->status == 1 ? '' : 'hide-this';
      $class2 = $row->status == 0 ? '' : 'hide-this';
      $output .= '</td>
      <td>
      <span id="astatus' . $row->id . '" class="badge bg-success ' . $class1 . '"
      onclick="changeStatus(' . $row->id . ',`status`,0)">Active</span>
    <span id="istatus' . $row->id . '" class="badge bg-danger ' . $class2 . '"
      onclick="changeStatus(' . $row->id . ',`status`,1)">Inactive</span>
      </td>
      <td>
        <a href="javascript:void()" onclick="DeleteAjax(' . $row->id . ')"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . $path . '" class="waves-effect waves-light btn btn-xs btn-outline btn-info hide-this"><i class="fa fa-edit" aria-hidden="true"></i></a>
      </td>
    </tr>';
      $i++;
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }
}
