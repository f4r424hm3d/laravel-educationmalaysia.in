<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\DefaultOgImage;
use App\Models\DynamicPageSeo;
use App\Models\FeesAndDeadline;
use App\Models\University;
use App\Models\UniversityGallery;
use App\Models\UniversityOverview;
use App\Models\UniversityProgram;
use App\Models\UniversityVideoGallery;
use Illuminate\Http\Request;

class UniversityProfileFc extends Controller
{
  public function index($university_slug, Request $request)
  {
    $university = University::where(['uname' => $university_slug])->active()->firstOrFail();

    $trendingUniversity = University::inRandomOrder()->active()->where('id', '!=', $university->id)->limit(10)->get();

    $page_url = url()->current();
    $wrdseo = ['url' => 'university'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();

    $title = $university->name;
    $city = $university->city;
    $shortnote = $university->shortnote;
    $inst_type = $university->inst_type;
    $uname = $university->name;

    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'address' => $city, 'shortnote' => $shortnote, 'universitytype' => $inst_type, 'universityname' => $uname, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];
    $meta_title = $university->meta_title == '' ? $dseo->title : $university->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);
    $meta_keyword = $university->meta_keyword == '' ? $dseo->keyword : $university->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);
    $page_content = $university->page_content == '' ? $dseo->page_content : $university->page_content;
    $page_content = replaceTag($page_content, $tagArray);
    $meta_description = $university->meta_description == '' ? $dseo->description : $university->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);
    $og_image_path = $university->ofimgpath ?? $dseo->ogimgpath;
    $schema = false;

    $data = compact('university', 'trendingUniversity', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'schema');
    return view('front.university-overview')->with($data);
  }
  public function gallery($university_slug, Request $request)
  {
    $university = University::where(['uname' => $university_slug])->active()->firstOrFail();

    $trendingUniversity = University::inRandomOrder()->active()->where('id', '!=', $university->id)->limit(10)->get();

    $page_url = url()->current();
    $wrdseo = ['url' => 'gallery'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();

    $title = $university->name;
    $city = $university->city;
    $shortnote = $university->shortnote;
    $inst_type = $university->inst_type;
    $uname = $university->name;

    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'address' => $city, 'shortnote' => $shortnote, 'universitytype' => $inst_type, 'universityname' => $uname, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];
    $meta_title = $university->meta_title == '' ? $dseo->title : $university->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);
    $meta_keyword = $university->meta_keyword == '' ? $dseo->keyword : $university->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);
    $page_content = $university->page_content == '' ? $dseo->page_content : $university->page_content;
    $page_content = replaceTag($page_content, $tagArray);
    $meta_description = $university->meta_description == '' ? $dseo->description : $university->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);
    $og_image_path = $university->ofimgpath ?? $dseo->ogimgpath;
    $schema = false;

    $data = compact('university', 'trendingUniversity', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'schema');
    return view('front.university-gallery')->with($data);
  }
  public function videos($university_slug, Request $request)
  {
    $university = University::where(['uname' => $university_slug])->active()->firstOrFail();

    $trendingUniversity = University::inRandomOrder()->active()->where('id', '!=', $university->id)->limit(10)->get();

    $page_url = url()->current();
    $wrdseo = ['url' => 'video'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();

    $title = $university->name;
    $city = $university->city;
    $shortnote = $university->shortnote;
    $inst_type = $university->inst_type;
    $uname = $university->name;

    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'address' => $city, 'shortnote' => $shortnote, 'universitytype' => $inst_type, 'universityname' => $uname, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];
    $meta_title = $university->meta_title == '' ? $dseo->title : $university->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);
    $meta_keyword = $university->meta_keyword == '' ? $dseo->keyword : $university->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);
    $page_content = $university->page_content == '' ? $dseo->page_content : $university->page_content;
    $page_content = replaceTag($page_content, $tagArray);
    $meta_description = $university->meta_description == '' ? $dseo->description : $university->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);
    $og_image_path = $university->ofimgpath ?? $dseo->ogimgpath;
    $schema = false;

    $data = compact('university', 'trendingUniversity', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'schema');
    return view('front.university-videos')->with($data);
  }
}
