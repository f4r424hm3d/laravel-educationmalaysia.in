<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialC extends Controller
{
  public function index($id = null)
  {
    $pages = ['website', 'jobs'];
    $page_no = $_GET['page'] ?? 1;
    $rows = Testimonial::all();
    if ($id != null) {
      $sd = Testimonial::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/testimonials/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/testimonials/');
      }
    } else {
      $ft = 'add';
      $url = url('admin/testimonials/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Testimonials";
    $page_route = "testimonials";
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url', 'pages');
    return view('admin.testimonials')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = Testimonial::paginate(10)->withPath('/admin/testimonials/');
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
      <th>S.No.</th>
      <th>Name</th>
      <th>Country</th>
      <th>Page</th>
      <th>Review</th>
      <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    if ($rows->count() > 0) {
      foreach ($rows as $row) {
        $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->name . '</td>
      <td>' . $row->country . '</td>
      <td>' . $row->page . '</td>
      <td>';
        if ($row->review != '') {
          $output .= '<button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#SModalScrollable' . $row->id . '">View</button>
        <div class="modal fade" id="SModalScrollable' . $row->id . '" tabindex="-1" role="dialog"
          aria-labelledby="SModalScrollableTitle' . $row->id . '" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                ' . $row->review . '
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
      <td>
        <a href="javascript:void()" onclick="DeleteAjax(`' . $row->id . '`)"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . url('admin/testimonials/update/' . $row->id) . '"
          class="waves-effect waves-light btn btn-xs btn-outline btn-info">
          <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
      </td>
    </tr>';
        $i++;
      }
    } else {
      $output .= '<tr><td colspan="6"><center>No Data Found</center></td></tr>';
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }
  public function storeAjax(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'country' => 'required',
      'review' => 'required',
      'page' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new Testimonial();
    $field->name = $request['name'];
    $field->country = $request['country'];
    $field->email = $request['email'];
    $field->mobile = $request['mobile'];
    $field->page = $request['page'];
    $field->review = $request['review'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'name' => 'required',
        'country' => 'required',
        'review' => 'required',
        'page' => 'required',
      ]
    );

    $field = Testimonial::find($id);
    $field->name = $request['name'];
    $field->country = $request['country'];
    $field->email = $request['email'];
    $field->mobile = $request['mobile'];
    $field->page = $request['page'];
    $field->review = $request['review'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/testimonials');
  }
  public function delete($id)
  {
    echo $result = Testimonial::find($id)->delete();
  }
}
