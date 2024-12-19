<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Destination;
use App\Models\FaqCategory;
use App\Models\PageContent;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeFc extends Controller
{
  public function index(Request $request)
  {
    $blogs = Blog::limit(10)->get();

    $data = compact('blogs');
    return view('front.index')->with($data);
  }
  public function privacyPolicy(Request $request)
  {
    return view('front.privacy-policy');
  }
  public function termsConditions(Request $request)
  {
    return view('front.terms-conditions');
  }
  public function searchUniversity(Request $request)
  {
    $keyword = $request->keyword;
    $field = DB::table('universities')->where('status', 1)->where('name', 'LIKE', '%' . $keyword . '%')->get();
    if ($field->count()) {
      $output = '<ul class="sItemsUl"><li class="active">UNIVERSITIES</li>';
      foreach ($field as $row) {
        $output .= '<li><a href="' . $row->slug . '">' . $row->name . '</a></li>';
      }
      $output .= '</ul>';
    } else {
      $output = '<center>No Data Found</center>';
    }
    echo $output;
  }
  public function newPage(Request $request)
  {
    return view('front.new-page');
  }
  public function SelectUniversities(Request $request)
  {
    return view('front.select-universities');
  }
  public function whoWeAre(Request $request)
  {
    return view('front.about');
  }
  public function whatPeopleSay(Request $request)
  {
    return view('front.what-people-say');
  }
  public function SelectLevel(Request $request)
  {
    return view('front.select-level');
  }
  public function Courses(Request $request)
  {
    $page_name = $request->segment(2);
    $pageContent = PageContent::with('author')->where('website', site_var)->where('page_name', $page_name)->first();
    //printArray($pageContent);
    $data = compact('pageContent');
    return view('front.courses')->with($data);
  }
}
