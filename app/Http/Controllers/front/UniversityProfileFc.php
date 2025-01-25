<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\DefaultOgImage;
use App\Models\DynamicPageSeo;
use App\Models\FeesAndDeadline;
use App\Models\Level;
use App\Models\Review;
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

    $countries = Country::orderBy('name', 'ASC')->get();
    $phonecodes = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
    $levels = Level::groupBy('level')->orderBy('level', 'ASC')->get();
    $course_categories = CourseCategory::orderBy('name', 'asc')->get();

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

    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    $universtySpecializationsForCourses = CourseSpecialization::inRandomOrder()->whereHas('programs', function ($query) use ($university) {
      $query->where('university_id', $university->id);
    })->limit(15)->get();

    $randomSpecializations = CourseSpecialization::inRandomOrder()->whereHas('programs', function ($query) use ($university) {
      $query->where('status', 1);
    })->limit(15)->get();

    $specializationsWithContents = CourseSpecialization::inRandomOrder()->whereHas('contents')->limit(15)->get();

    $data = compact('university', 'trendingUniversity', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'schema', 'countries', 'phonecodes', 'captcha', 'levels', 'course_categories', 'universtySpecializationsForCourses', 'randomSpecializations', 'specializationsWithContents');
    return view('front.university-overview')->with($data);
  }
  public function gallery($university_slug, Request $request)
  {
    $university = University::where(['uname' => $university_slug])->active()->firstOrFail();

    $trendingUniversity = University::inRandomOrder()->active()->where('id', '!=', $university->id)->limit(10)->get();

    $countries = Country::orderBy('name', 'ASC')->get();
    $phonecodes = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
    $levels = Level::groupBy('level')->orderBy('level', 'ASC')->get();
    $course_categories = CourseCategory::orderBy('name', 'asc')->get();

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

    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    $data = compact('university', 'trendingUniversity', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'schema', 'countries', 'phonecodes', 'captcha', 'levels', 'course_categories');
    return view('front.university-gallery')->with($data);
  }
  public function videos($university_slug, Request $request)
  {
    $university = University::where(['uname' => $university_slug])->active()->firstOrFail();

    $trendingUniversity = University::inRandomOrder()->active()->where('id', '!=', $university->id)->limit(10)->get();

    $countries = Country::orderBy('name', 'ASC')->get();
    $phonecodes = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
    $levels = Level::groupBy('level')->orderBy('level', 'ASC')->get();
    $course_categories = CourseCategory::orderBy('name', 'asc')->get();

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

    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    $data = compact('university', 'trendingUniversity', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'schema', 'countries', 'phonecodes', 'captcha', 'levels', 'course_categories');
    return view('front.university-videos')->with($data);
  }
  public function reviews($university_slug, Request $request)
  {
    $university = University::where(['uname' => $university_slug])->active()->firstOrFail();

    $trendingUniversity = University::inRandomOrder()->active()->where('id', '!=', $university->id)->limit(10)->get();

    $countries = Country::orderBy('name', 'ASC')->get();
    $phonecodes = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
    $levels = Level::groupBy('level')->orderBy('level', 'ASC')->get();
    $course_categories = CourseCategory::orderBy('name', 'asc')->get();

    $totalrating = Review::where(['university_id' => $university->id, 'status' => 1])->sum('rating');

    $rows = Review::where(['university_id' => $university->id, 'status' => 1]);
    $rows = $rows->paginate(10)->withQueryString();
    if ($rows->count() == 0) {
      abort(404);
    }

    $total = $rows->total();
    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;

    $avrgRating = ($totalrating / $total);
    $avrgRating = sprintf("%.1f", $avrgRating);
    $air = 4;
    $afr = 4;
    $apr = 4;
    $ahr = 4;

    $page_url = url()->current();
    $wrdseo = ['url' => 'review-page'];
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

    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    $data = compact('university', 'rows', 'i', 'total', 'trendingUniversity', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'schema', 'avrgRating', 'air', 'afr', 'apr', 'ahr', 'countries', 'phonecodes', 'captcha', 'levels', 'course_categories');
    return view('front.university-reviews')->with($data);
  }
}
