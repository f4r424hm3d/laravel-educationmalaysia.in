<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class FaqC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'faqs';
  }
  public function index($id = null)
  {
    $page_no = $_GET['page'] ?? 1;
    $rows = Faq::get();
    if ($id != null) {
      $sd = Faq::find($id);
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

    $categories = FaqCategory::all();
    $page_title = "Faqs";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'page_no', 'categories');
    return view('admin.faqs')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = Faq::where('id', '!=', '0');
    $rows = $rows->paginate(10)->withPath('/admin/' . $this->page_route);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Category</th>
        <th>Question</th>
        <th>Answer</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    if ($rows->count() > 0) {
      foreach ($rows as $row) {
        $url = url("admin/" . $this->page_route . "/update/" . $row->id);
        $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->category->category_name . '</td>
      <td>' . $row->question . '</td>
      <td>' . Blade::render('<x-content-view-modal :row="$row" field="answer" title="Answer" />', ['row' => $row]) . '</td>
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
      'category_id' => 'required',
      'question' => 'required',
      'answer' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new Faq;
    $field->category_id = $request['category_id'];
    $field->question = $request['question'];
    $field->answer = $request['answer'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function delete($id)
  {
    if ($id) {
      $row = Faq::findOrFail($id);
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
        'category_id' => 'required',
        'question' => 'required',
        'answer' => 'required',
      ]
    );
    $field = Faq::find($id);
    $field->question = $request['question'];
    $field->answer = $request['answer'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route);
  }
}
