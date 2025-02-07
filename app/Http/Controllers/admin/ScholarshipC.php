<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ScholarshipC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'scholarships';
  }
  public function index($id = null)
  {
    $page_no = $_GET['page'] ?? 1;
    $rows = Scholarship::get();
    if ($id != null) {
      $sd = Scholarship::find($id);
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
    $page_title = "Scholarships";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'page_no');
    return view('admin.scholarships')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = Scholarship::where('id', '!=', '0');
    $rows = $rows->paginate(10)->withPath('/admin/' . $this->page_route);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsiv nowra w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Title</th>
        <th>Type</th>
        <th>Active Status</th>
        <th>Images</th>
        <th>Shortnote</th>
        <th>Seo</th>
        <th>Contents</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    if ($rows->count() > 0) {
      foreach ($rows as $row) {
        $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->title . '</td>
      <td>' . $row->type . '</td>
      <td>' . $row->active_status . '</td>
      <td>
        Thumbnail : ';
        if ($row->thumbnail_path && file_exists($row->thumbnail_path)) {
          $output .= '<a href="' . asset($row->thumbnail_path) . '" target="_blank"><img src="' . asset($row->thumbnail_path) . '" height="20" width="20" /></a>';
        } else {
          $output .= 'N/A';
        }
        $output .= '<br>
        Og image : ';
        if ($row->og_image_path && file_exists($row->og_image_path)) {
          $output .= '<a href="' . asset($row->og_image_path) . '" target="_blank"><img src="' . asset($row->og_image_path) . '" height="20" width="20" /></a>';
        } else {
          $output .= 'N/A';
        }
        $output .= '</td>
      <td>
        ' . Blade::render('<x-content-view-modal :row="$row" field="shortnote" title="Shortnote" />', ['row' => $row]) . '
        </td>
      <td>
        ' . Blade::render('<x-seo-view-model :row="$row" />', ['row' => $row]) . '
        </td>
        <td>
        ' . Blade::render('<x-custom-button :url="$url" label="Contents" :count="$count" />', ['url' => url('admin/scholarship-contents/' . $row->id), 'count' => $row->contents->count()]) . '<br>' . Blade::render('<x-custom-button :url="$url" label="Faqs" :count="$count" />', ['url' => url('admin/scholarship-faqs/' . $row->id), 'count' => $row->faqs->count()]) . '
      </td>
      <td>
      ' . Blade::render('<x-edit-button :url="$url" />', ['url' => url("admin/" . $this->page_route . "/update/" . $row->id)]) . '
      ' . Blade::render('<x-delete-button :id="$id" />', ['id' => $row->id]) . '
      </td>
    </tr>';
        $i++;
      }
    } else {
      $output .= '<tr><td colspan="9"><center>No data found</center></td></tr>';
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required',
      'thumbnail' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
      'og_image' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new Scholarship;
    $field->website = site_var;
    $field->title = $request['title'];
    $field->slug = slugify($request['slug']);
    $field->active_status = $request['active_status'];
    $field->type = $request['type'];
    $field->shortnote = $request['shortnote'];
    $field->page_type = $request['page_type'];
    $field->landing_page_link = $request['landing_page_link'];

    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/scholarship/', $file_name);
      if ($move) {
        $field->thumbnail_name = $file_name;
        $field->thumbnail_path = 'uploads/scholarship/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('og_image')) {
      $fileOriginalName = $request->file('og_image')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('og_image')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('og_image')->move('uploads/scholarship/', $file_name);
      if ($move) {
        $field->og_image_name = $file_name;
        $field->og_image_path = 'uploads/scholarship/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }

    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->best_rating = $request['best_rating'];
    $field->review_number = $request['review_number'];

    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'title' => 'required',
        'thumbnail' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
        'og_image' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
      ]
    );
    $field = Scholarship::find($id);

    $field->title = $request['title'];
    $field->slug = slugify($request['slug']);
    $field->active_status = $request['active_status'];
    $field->type = $request['type'];
    $field->shortnote = $request['shortnote'];
    $field->page_type = $request['page_type'];
    $field->landing_page_link = $request['landing_page_link'];

    if ($request->hasFile('thumbnail')) {
      $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('thumbnail')->move('uploads/scholarship/', $file_name);
      if ($move) {
        $field->thumbnail_name = $file_name;
        $field->thumbnail_path = 'uploads/scholarship/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('og_image')) {
      $fileOriginalName = $request->file('og_image')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('og_image')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('og_image')->move('uploads/scholarship/', $file_name);
      if ($move) {
        $field->og_image_name = $file_name;
        $field->og_image_path = 'uploads/scholarship/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }

    $field->meta_title = $request['meta_title'];
    $field->meta_keyword = $request['meta_keyword'];
    $field->meta_description = $request['meta_description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->best_rating = $request['best_rating'];
    $field->review_number = $request['review_number'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route);
  }
  public function delete($id)
  {
    if ($id) {
      $row = Scholarship::findOrFail($id);
      if ($row->thumbnail_path != null && file_exists($row->thumbnail_path)) {
        unlink($row->thumbnail_path);
      }
      if ($row->og_image_path != null && file_exists($row->og_image_path)) {
        unlink($row->og_image_path);
      }
      $result = $row->delete();
      if ($result) {
        return response()->json(['success' => true]);
      }
    }
  }
}
