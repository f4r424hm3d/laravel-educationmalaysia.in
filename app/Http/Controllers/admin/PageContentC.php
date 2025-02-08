<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class PageContentC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'page-contents';
  }
  public function index($id = null)
  {
    $authors = Author::all();
    $page_no = $_GET['page'] ?? 1;
    $rows = PageContent::get();
    if ($id != null) {
      $sd = PageContent::find($id);
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
    $page_title = "Page Contents";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'page_no', 'authors');
    return view('admin.page-contents')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = PageContent::where('id', '!=', '0');
    $rows = $rows->paginate(10)->withPath('/admin/' . $this->page_route);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsiv nowra w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Page Name</th>
        <th>Heading</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    if ($rows->count() > 0) {
      foreach ($rows as $row) {
        $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->page_name . '</td>
      <td>
        ' . Blade::render('<x-content-view-modal :row="$row" field="heading" title="Heading" />', ['row' => $row]) . '
        </td>
      <td>
        ' . Blade::render('<x-content-view-modal :row="$row" field="description" title="Description" />', ['row' => $row]) . '
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
      'page_name' => 'required',
      'author_id' => 'required',
      'heading' => 'required',
      'description' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new PageContent;
    $field->website = site_var;
    $field->page_name = $request['page_name'];
    $field->author_id = $request['author_id'];
    $field->heading = $request['heading'];
    $field->description = $request['description'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'page_name' => 'required',
        'author_id' => 'required',
        'heading' => 'required',
        'description' => 'required',
      ]
    );
    $field = PageContent::find($id);
    $field->page_name = $request['page_name'];
    $field->author_id = $request['author_id'];
    $field->heading = $request['heading'];
    $field->description = $request['description'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route);
  }
  public function delete($id)
  {
    if ($id) {
      $row = PageContent::findOrFail($id);
      $result = $row->delete();
      if ($result) {
        return response()->json(['success' => true]);
      }
    }
  }
}
