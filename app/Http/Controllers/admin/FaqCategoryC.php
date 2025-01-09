<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class FaqCategoryC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'faq-categories';
  }
  public function index($id = null)
  {
    $page_no = $_GET['page'] ?? 1;
    $rows = FaqCategory::get();
    if ($id != null) {
      $sd = FaqCategory::find($id);
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
    $page_title = "Faq Category";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'page_no');
    return view('admin.faq-categories')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = FaqCategory::where('id', '!=', '0');
    $rows = $rows->paginate(10)->withPath('/admin/' . $this->page_route);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    if ($rows->count() > 0) {
      foreach ($rows as $row) {
        $url = url("admin/" . $this->page_route . "/update/" . $row->id);
        $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->category_name . '</td>
      <td>';
        $output .= Blade::render('<x-delete-button :id="$id" />', ['id' => $row->id]);
        $output .= Blade::render('<x-edit-button :url="$url" />', ['url' => $url]);
        $output .= '</td>
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
      'category_name' => 'required|unique:faq_categories,category_name',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new FaqCategory;
    $field->category_name = $request['category_name'];
    $field->category_slug = slugify($request['category_name']);
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function delete($id)
  {
    if ($id) {
      $row = FaqCategory::findOrFail($id);
      $result = $row->delete();
      if ($result) {
        return response()->json(['success' => true]);
      } else {
        return response()->json(['success' => false]);
      }
    }
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'category_name' => 'required|unique:faq_categories,category_name,' . $id,
      ]
    );
    $field = FaqCategory::find($id);
    $field->category_name = $request['category_name'];
    $field->category_slug = slugify($request['category_name']);
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route);
  }
}
