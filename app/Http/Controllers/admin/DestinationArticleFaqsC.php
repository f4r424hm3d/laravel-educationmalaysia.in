<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationArticle;
use App\Models\DestinationArticleFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DestinationArticleFaqsC extends Controller
{
  public function index($destination_article_id, $id = null)
  {
    $article = DestinationArticle::find($destination_article_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = DestinationArticleFaq::where('destination_article_id', $destination_article_id)->get();
    if ($id != null) {
      $sd = DestinationArticleFaq::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/destination-article-faqs/' . $destination_article_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/destination-article-faqs/' . $destination_article_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/destination-article-faqs/' . $destination_article_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Destination Article Faqs";
    $page_route = "destination-article-faqs";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'article', 'page_no');
    return view('admin.destination-article-faqs')->with($data);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = DestinationArticleFaq::where('id', '!=', '0');
    if ($request->has('destination_article_id') && $request->destination_article_id != '') {
      $rows = $rows->where('destination_article_id', $request->destination_article_id);
    }
    $rows = $rows->paginate(10)->withPath('/admin/destination-article-faqs/' . $request->destination_article_id);
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Question</th>
        <th>Answer</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->question . '</td>
      <td>';

      if ($row->answer != null) {
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
                ' . $row->answer . '
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
      $output .= '</td><td>
        <a href="javascript:void()" onclick="DeleteAjax(' . $row->id . ')"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . url('admin/destination-article-faqs/' . $request->destination_article_id . '/update/' . $row->id) . '"
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
      'question' => 'required',
      'answer' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new DestinationArticleFaq();
    $field->destination_article_id = $request['destination_article_id'];
    $field->question = $request['question'];
    $field->answer = $request['answer'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function delete($id)
  {
    echo $result = DestinationArticleFaq::find($id)->delete();
  }
  public function update($destination_article_id, $id, Request $request)
  {
    $request->validate(
      [
        'question' => 'required',
        'answer' => 'required',
      ]
    );
    $field = DestinationArticleFaq::find($id);
    $field->question = $request['question'];
    $field->answer = $request['answer'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/destination-article-faqs/' . $destination_article_id);
  }
}
