<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DestinationArticle;
use App\Models\DestinationArticleContents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DestinationArticleContentC extends Controller
{
  public function index($article_id, $id = null)
  {
    $users = User::all();
    $article = DestinationArticle::find($article_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = DestinationArticleContents::where('article_id', $article_id)->where('parent_id', null)->orderBy('id', 'desc')->get();
    if ($id != null) {
      $sd = DestinationArticleContents::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/destination-article-contents/' . $article_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/destination-article-contents/' . $article_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/destination-article-contents/' . $article_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Article Contents";
    $page_route = "destination-article-contents";
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'article', 'page_no', 'users');
    return view('admin.destination-article-contents')->with($data);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = DestinationArticleContents::where('id', '!=', '0');
    if ($request->has('article_id') && $request->article_id != '') {
      $rows = $rows->where('article_id', $request->article_id);
    }
    $rows = $rows->paginate(10)->withPath('/admin/destination-article-contents/');
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Heading</th>
        <th>Parent Heading</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $parentHeading = $row->getParentHeading->heading ?? '';
      $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->heading . '</td>
      <td>' . $parentHeading . '</td>
      <td>';

      if ($row->description != null) {
        $output .= '<button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light"
                      data-bs-toggle="modal" data-bs-target="#descModalScrollable' . $row->id . '">View</button>
                    <div class="modal fade" id="descModalScrollable' . $row->id . '" tabindex="-1" role="dialog"
                      aria-labelledby="DescModalScrollableTitle' . $row->id . '" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="DescModalScrollableTitle' . $row->id . '">
                              SEO
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          <p>' . $row->description . '</p>
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
        <a href="' . url('admin/destination-article-contents/' . $request->article_id . '/update/' . $row->id) . '"
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
      'heading' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new DestinationArticleContents();
    $field->article_id = $request['article_id'];
    $field->parent_id = $request['parent_id'];
    $field->heading = $request['heading'];
    $field->description = $request['description'];
    $field->save();
    return response()->json(['success' => 'Record hase been added succesfully.']);
  }
  public function update($article_id, $id, Request $request)
  {
    $request->validate(
      [
        'heading' => 'required',
      ]
    );
    $field = DestinationArticleContents::find($id);
    $field->article_id = $request['article_id'];
    $field->parent_id = $request['parent_id'];
    $field->heading = $request['heading'];
    $field->description = $request['description'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/destination-article-contents/' . $article_id);
  }
  public function delete($id)
  {
    echo $result = DestinationArticleContents::find($id)->delete();
  }
  public function getHeadings(Request $request)
  {
    $rows = DestinationArticleContents::where('article_id', $request->article_id)->where('parent_id', null)->get();
    $output = '<option value="">Select</option>';
    foreach ($rows as $row) {
      $output .= '<option value="' . $row->id . '">' . $row->heading . '</option>';
    }
    return $output;
  }
}
