<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'job-application';
  }
  public function index($id = null)
  {
    $page_no = $_GET['page'] ?? 1;
    $rows = JobApplication::get();
    if ($id != null) {
      $sd = JobApplication::find($id);
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
    $page_title = "Job Applications";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'page_no');
    return view('admin.job-application')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = JobApplication::where('id', '!=', '0');
    $rows = $rows->paginate(10)->withPath('/admin/' . $this->page_route);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Contact Info</th>
        <th>Position</th>
        <th>Experience</th>
        <th>Message</th>
        <th>Resume/CV</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    if ($rows->count() > 0) {
      foreach ($rows as $row) {
        $class = $row->status == 1 ? 'success' : 'danger';
        $status = $row->status == 1 ? 'Viewed' : 'Not Viewed';
        $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>
        Name : ' . $row->name . ' <br>
        Email : ' . $row->email . ' <br>
        Mobile : ' . $row->mobile . ' <br>
      </td>
      <td>' . $row->getPosition->designation . '</td>
      <td>' . $row->experience . '</td>
      <td>';
        if ($row->message != null) {
          $output .= '<button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light"
          data-bs-toggle="modal" data-bs-target="#SeoModalScrollable' . $row->id . '">View</button>
        <div class="modal fade" id="SeoModalScrollable' . $row->id . '" tabindex="-1" role="dialog"
          aria-labelledby="SeoModalScrollableTitle' . $row->id . '" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="SeoModalScrollableTitle' . $row->id . '">SEO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
              </div>
              <div class="modal-body">
                ' . $row->message . '
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>';
        } else {
          $output .= 'N/A';
        }

        $output .= '</td>
        <td>' . getFormattedDate($row->created_at, 'd M, Y') . '</td>
        <td><a href="' . asset($row->resume_path) . '" target="_blank">view</a></td>
      <td>
        <span class="badge bg-' . $class . '" onclick="changeStatus(' . $row->id . ')">' . $status . '</span>
      </td>
      <td>
        <a href="javascript:void()" onclick="DeleteAjax(' . $row->id . ')"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
      </td>
    </tr>';
        $i++;
      }
    } else {
      $output .= '<tr><td colspan="8"><center>No data found</center></td></tr>';
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }

  public function delete($id)
  {
    if ($id) {
      $row = JobApplication::findOrFail($id);
      if ($row->resume_path != null) {
        unlink($row->resume_path);
      }
      echo $result = $row->delete();
    }
  }
}
