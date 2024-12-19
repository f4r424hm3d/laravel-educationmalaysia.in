<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CourseSpecialization;
use App\Models\DefaultImage;
use App\Models\DynamicPageSeo;
use App\Models\University;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;

class SpecializationFc extends Controller
{
  public function index(Request $request)
  {
    $specializations = CourseSpecialization::select('id', 'name', 'slug', 'updated_at')->website()->whereHas('contents')->groupBy('id')->orderBy('name', 'ASC')->get();
    $data = compact('specializations');
    return view('front.specialization')->with($data);
  }
  public function detail($slug, Request $request)
  {
    $countries = Country::orderBy('phonecode', 'asc')->where('phonecode', '!=', '0')->get();
    $defaultImage = DefaultImage::where('page', 'specialization-detail')->get();

    // Fetch course specialization by slug and website filter
    $specialization = CourseSpecialization::where('slug', $slug)->website()->firstOrFail();
    $specializations = CourseSpecialization::inRandomOrder()->where('id', '!=', $specialization->id)->website()->limit(10)->get();

    $page = request()->get('page', 1) - 1;
    $start_from = 10 * $page;

    // Fetch related universities
    $relatedUniversities = University::getRelatedUniversities($specialization->id, $start_from);

    $programs = UniversityProgram::website()->where('specialization_id', $specialization->id)->orderBy('course_name', 'ASC')->get();

    $page_url = url()->current();

    $wrdseo = ['url' => 'specialization'];
    $dseo = DynamicPageSeo::website()->where($wrdseo)->first();
    $title = $specialization->name;
    $site =  'educationmalaysia.in';
    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $specialization->meta_title == '' ? $dseo->meta_title : $specialization->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $specialization->meta_keyword == '' ? $dseo->meta_keyword : $specialization->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $specialization->page_content == '' ? $dseo->page_content : $specialization->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $specialization->meta_description == '' ? $dseo->meta_description : $specialization->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $specialization->content_image_path ?? $defaultImage->image_path;

    $seo_rating = $specialization->seo_rating == '0' ? '0' : $specialization->seo_rating;

    $seoRatingSchema = true;

    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    $data = compact('specialization', 'relatedUniversities', 'specializations', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path',  'captcha', 'countries', 'programs');
    return view('front.specialization-details')->with($data);
  }
}