<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\UniversityOtherContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UniversityOtherContentC extends Controller
{
  public function index($university_id, $id = null)
  {
    $university = University::find($university_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = UniversityOtherContent::where('university_id', $university_id)->get();
    if ($id != null) {
      $sd = UniversityOtherContent::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/other-content/' . $university_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/other-content/' . $university_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/other-content/' . $university_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "University Other Contents";
    $page_route = "other-content";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'university', 'page_no');
    return view('admin.other-content')->with($data);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = UniversityOtherContent::where('id', '!=', '0');
    if ($request->has('university_id') && $request->university_id != '') {
      $rows = $rows->where('university_id', $request->university_id);
    }
    $rows = $rows->paginate(10)->withPath('/admin/doctor/hospitals/');
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Title</th>
        <th>Description</th>
        <th>Thumbnail</th>
        <th>SEO</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->tab_name . '</td>
      <td>';

      if ($row->description != null) {
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
                ' . $row->description . '
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
      $output .= '</td>
      <td>';
      if ($row->thumbnail_path != null) {
        $output .= '<img src="' . asset($row->thumbnail_path) . '" alt="" height="80" width="80">';
      } else {
        $output .= 'N/A';
      }
      $output .= '</td>
      <td>';
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
      $output .= '</td>
      <td>
        <a href="javascript:void()" onclick="DeleteAjax(' . $row->id . ')"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . url('admin/other-content/' . $request->university_id . '/update/' . $row->id) . '"
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
      'description' => 'required',
    ]);

    if ($validator->fails()) {

      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new UniversityOtherContent();
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/university/', $file_name);
      if ($move) {
        $field->thumbnail_name = $file_name;
        $field->thumbnail_path = 'uploads/university/' . $file_name;
      }
    }
    $field->university_id = $request['university_id'];
    $field->tab_name = $request['tab_name'];
    $field->tab_slug = slugify($request['tab_name']);
    $field->description = $request['description'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function delete($id)
  {
    echo $result = UniversityOtherContent::find($id)->delete();
  }
  public function update($university_id, $id, Request $request)
  {
    $request->validate(
      [
        'tab_name' => 'required',
        'description' => 'required',
      ]
    );
    $field = UniversityOtherContent::find($id);
    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/university/', $file_name);
      if ($move) {
        $field->thumbnail_name = $file_name;
        $field->thumbnail_path = 'uploads/university/' . $file_name;
      }
    }
    $field->tab_name = $request['tab_name'];
    $field->tab_slug = slugify($request['tab_name']);
    $field->description = $request['description'];
    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/other-content/' . $university_id);
  }
}
