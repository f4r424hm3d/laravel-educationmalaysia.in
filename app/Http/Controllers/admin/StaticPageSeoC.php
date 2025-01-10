<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\StaticPageSeo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StaticPageSeoC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'static-page-seos';
  }
  public function index($id = null)
  {
    $rows = StaticPageSeo::all();
    if ($id != null) {
      $sd = StaticPageSeo::find($id);
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
    $page_title = "Static Page Seo";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route');
    return view('admin.static-page-seos')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'page' => [
          'required',
          Rule::unique('static_page_seos', 'page')->where('website', site_var),
        ],
      ]
    );
    $field = new StaticPageSeo;
    $field->website = site_var;
    $field->page = $request['page'];
    $field->title = $request['title'];
    $field->keyword = $request['keyword'];
    $field->description = $request['description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->best_rating = $request['best_rating'];
    $field->review_number = $request['review_number'];
    if ($request->hasFile('og_image')) {
      $fileOriginalName = $request->file('og_image')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('og_image')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('og_image')->move('uploads/seo/', $file_name);
      if ($move) {
        $field->ogimgname = $file_name;
        $field->ogimgpath = 'uploads/seo/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/' . $this->page_route);
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'page' => [
          'required',
          Rule::unique('static_page_seos', 'page')
            ->ignore($id)
            ->where('website', site_var),
        ],
      ]
    );
    $field = StaticPageSeo::find($id);
    $field->website = site_var;
    $field->page = $request['page'];
    $field->title = $request['title'];
    $field->keyword = $request['keyword'];
    $field->description = $request['description'];
    $field->page_content = $request['page_content'];
    $field->seo_rating = $request['seo_rating'];
    $field->best_rating = $request['best_rating'];
    $field->review_number = $request['review_number'];
    if ($request->hasFile('og_image')) {
      $fileOriginalName = $request->file('og_image')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('og_image')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('og_image')->move('uploads/seo/', $file_name);
      if ($move) {
        $field->ogimgname = $file_name;
        $field->ogimgpath = 'uploads/seo/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route);
  }
  public function delete($id)
  {
    //echo $id;
    $result = StaticPageSeo::find($id)->delete();
    if ($result) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
}
