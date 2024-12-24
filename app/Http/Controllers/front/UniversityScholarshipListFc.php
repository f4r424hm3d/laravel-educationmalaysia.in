<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\DefaultOgImage;
use App\Models\DynamicPageSeo;
use App\Models\Level;
use App\Models\University;
use App\Models\UniversityScholarship;
use App\Models\UniversityScholarshipContent;
use Illuminate\Http\Request;

class UniversityScholarshipListFc extends Controller
{
  public function index($university_slug, Request $request)
  {
    $university_slug = $request->segment(1);
    $university = University::where(['slug' => $university_slug])->firstOrFail();
    $rows = UniversityScholarship::where(['university_id' => $university->id]);

    if (session()->has('USF_level')) {
      $rows = $rows->where(['level_id' => session()->get('USF_level')]);
      $filter_level = Level::find(session()->get('USF_level'));
    } else {
      $filter_level = null;
    }

    $rows = $rows->paginate(10)->withQueryString();
    if ($rows->count() == 0) {
      abort(404);
    }
    $total = $rows->total();
    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;

    $levels = UniversityScholarship::select('level_id')->where(['university_id' => $university->id])->distinct()->get();

    $page_url = url()->current();

    $wrdseo = ['url' => 'university-scholarship-list'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();
    $dogimg = DefaultOgImage::default()->first();

    $title = $university->name;
    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $university->meta_title == '' ? $dseo->title : $university->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $university->meta_keyword == '' ? $dseo->keyword : $university->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $university->page_content == '' ? $dseo->page_content : $university->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $university->meta_description == '' ? $dseo->description : $university->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $dogimg->file_path;

    $data = compact('university', 'rows', 'i', 'levels', 'total', 'filter_level', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path');
    return view('front.university-scholarship-list')->with($data);
  }

  public function applyLevelFilter(Request $request)
  {
    $level_id = $request->level_id;
    $level = Level::find($level_id);
    $request->session()->put('USF_level', $level_id);
    return $level->slug . '-scholarship';
  }


  public function applyFilter(Request $request)
  {
    $request->session()->put($request->col, $request->val);
  }

  public function removeFilter(Request $request)
  {
    session()->forget($request->value);
  }
  public function removeAllFilter(Request $request)
  {
    session()->forget('USF_level');
  }
  public function scholarshipDetail($university_slug, $scholarship_slug, Request $request)
  {
    $slug = $request->segment(1);
    $university = University::where(['slug' => $slug])->firstOrFail();
    $trendingUniversity = University::where(['destination_id' => $university->destination_id])->limit(10)->get();

    $scholarship_slug = $scholarship_slug;
    $scholarship = UniversityScholarship::where(['scholarship_slug' => $scholarship_slug])->firstOrFail();
    $rows = UniversityScholarshipContent::where('scholarship_id', $scholarship->id)->get();
    $path = implode('/', $request->segments());

    $page_url = url()->current();

    $wrdseo = ['url' => 'university-scholarship-detail'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();
    $dogimg = DefaultOgImage::default()->first();
    $title = $scholarship->program_name;
    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'university' => $university->name, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $scholarship->meta_title == '' ? $dseo->title : $scholarship->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $scholarship->meta_keyword == '' ? $dseo->keyword : $scholarship->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $scholarship->page_content == '' ? $dseo->page_content : $scholarship->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $scholarship->meta_description == '' ? $dseo->description : $scholarship->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $dogimg->file_path;

    $topRatedScholarships = UniversityScholarship::where('university_id', $university->id)->where('id', '!=', $scholarship->id)->get();

    $data = compact('scholarship', 'rows', 'university', 'trendingUniversity', 'path', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'topRatedScholarships');
    return view('front.scholarship-detail')->with($data);
  }
}
