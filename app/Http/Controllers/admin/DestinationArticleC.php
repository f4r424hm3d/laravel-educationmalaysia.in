<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationArticle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DestinationArticleC extends Controller
{
  public function index($id = null)
  {
    $users = User::all();
    $destinations = Destination::all();
    $page_no = $_GET['page'] ?? 1;
    if ($id != null) {
      $sd = DestinationArticle::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/destination-articles/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/destination-articles/');
      }
    } else {
      $ft = 'add';
      $url = url('admin/destination-articles/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Destination Articles";
    $page_route = "destination-articles";
    $data = compact('sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'destinations', 'page_no', 'users');
    return view('admin.destination-articles')->with($data);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = DestinationArticle::where('id', '!=', '0');
    $rows = $rows->paginate(10)->withPath('/admin/destination-articles/');
    $i = 1;
    $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Title</th>
        <th>Author</th>
        <th>Image</th>
        <th>Description</th>
        <th>SEO</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $author = $row->getUser->name ?? '';
      $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>
      Title : ' . $row->title . ' <br>
      URL : ' . $row->page_url . ' <br>
      </td>
      <td>' . $author . '</td>
      <td>';
      if ($row->image_path != null) {
        $output .= '<img src="' . asset($row->image_path) . '" alt="" height="80" width="80">';
      } else {
        $output .= 'N/A';
      }
      $output .= '</td><td>';
      if ($row->heading != null) {
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
                          <h4>Title</h4>
                            ' . $row->heading . ' <br>
                            <h4>Description Top</h4>
                            ' . $row->description . ' <br>
                            <h4>Description Bottom</h4>
                            ' . $row->description2 . ' <br>
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
      $output .= '</td><td>';
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
      $output .= '</td><td>
        <a href="' . url('/admin/destination-article-contents/' . $row->id) . '"
        class="waves-effect waves-light btn btn-xs btn-outline-success">Content <span class="badge bg-dark">' . $row->getAllContent->count() . '</span></a>
        <a href="javascript:void()" onclick="DeleteAjax(' . $row->id . ')"
          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <a href="' . url('admin/destination-articles/update/' . $row->id) . '"
          class="waves-effect waves-light btn btn-xs btn-outline btn-info">
          <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
        <a href="' . url('/admin/destination-article-faqs/' . $row->id) . '" class="waves-effect waves-light btn btn-xs btn-outline btn-primary">Faq</a>
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
      'title' => 'required',
      'page_url' => 'required',
      'heading' => 'required',
      'description' => 'required',
      'author_id' => 'required',
      'destination_id' => 'required',
      'thumbnail' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }
    $chk = DestinationArticle::where('destination_id', $request['destination_id'])->where('page_url', slugify($request['page_url']))->count();
    if ($chk == 0) {
      $field = new DestinationArticle();
      $field->destination_id = $request['destination_id'];
      $field->author_id = $request['author_id'];
      $field->title = $request['title'];
      $field->page_url = slugify($request['page_url']);
      $field->heading = $request['heading'];
      $field->description = $request['description'];
      $field->description2 = $request['description2'];
      $field->meta_title = $request['meta_title'];
      $field->meta_keyword = $request['meta_keyword'];
      $field->meta_description = $request['meta_description'];
      $field->page_content = $request['page_content'];
      $field->seo_rating = $request['seo_rating'];
      if ($request->hasFile('thumbnail')) {
        $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
        $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $file_name_slug = slugify($fileNameWithoutExtention);
        $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
        $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
        $move = $request->file('thumbnail')->move('uploads/articles/', $file_name);
        if ($move) {
          $field->image_name = $file_name;
          $field->image_path = 'uploads/articles/' . $file_name;
        } else {
          session()->flash('emsg', 'Some problem occured. File not uploaded.');
        }
      }
      $field->save();
      return response()->json(['success' => 'Record hase been added succesfully.']);
    } else {
      return response()->json(['failed' => 'Tab URL already exist.']);
    }
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'title' => 'required',
        'page_url' => 'required',
        'heading' => 'required',
        'description' => 'required',
        'author_id' => 'required',
        'destination_id' => 'required',
        'thumbnail' => 'nullable|max:5000|mimes:jpg,jpeg,png,gif,webp',
      ]
    );
    $chk = DestinationArticle::where('destination_id', $request['destination_id'])->where('id', '!=', $id)->where('page_url', slugify($request['page_url']))->count();
    if ($chk == 0) {
      $field = DestinationArticle::find($id);
      $field->destination_id = $request['destination_id'];
      $field->author_id = $request['author_id'];
      $field->title = $request['title'];
      $field->page_url = slugify($request['page_url']);
      $field->heading = $request['heading'];
      $field->description = $request['description'];
      $field->description2 = $request['description2'];
      $field->meta_title = $request['meta_title'];
      $field->meta_keyword = $request['meta_keyword'];
      $field->meta_description = $request['meta_description'];
      $field->page_content = $request['page_content'];
      $field->seo_rating = $request['seo_rating'];
      if ($request->hasFile('thumbnail')) {
        $fileOriginalName = $request->file('thumbnail')->getClientOriginalName();
        $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $file_name_slug = slugify($fileNameWithoutExtention);
        $fileExtention = $request->file('thumbnail')->getClientOriginalExtension();
        $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
        $move = $request->file('thumbnail')->move('uploads/articles/', $file_name);
        if ($move) {
          $field->image_name = $file_name;
          $field->image_path = 'uploads/articles/' . $file_name;
        } else {
          session()->flash('emsg', 'Some problem occured. File not uploaded.');
        }
      }
      $field->save();
      session()->flash('smsg', 'Record has been updated successfully.');
    } else {
      session()->flash('emsg', 'Tab URl already exist.');
    }
    return redirect('admin/destination-articles/');
  }
  public function delete($id)
  {
    echo $result = DestinationArticle::find($id)->delete();
  }
}
