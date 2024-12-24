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
    $specialization = CourseSpecialization::where('slug', $slug)->firstOrFail();
    $specializations = CourseSpecialization::inRandomOrder()->where('id', '!=', $specialization->id)->limit(10)->get();

    // Fetch related universities
    $relatedUniversities = UniversityProgram::select('university_id')->distinct()->where('specialization_id', $specialization->id)->get();

    // printArray($relatedUniversities->toArray());
    // die;

    $programs = UniversityProgram::where('specialization_id', $specialization->id)->orderBy('course_name', 'ASC')->get();

    $page_url = url()->current();

    $wrdseo = ['url' => 'specialization'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();
    $title = $specialization->name;
    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $specialization->meta_title == '' ? $dseo->title : $specialization->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $specialization->meta_keyword == '' ? $dseo->keyword : $specialization->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $specialization->page_content == '' ? $dseo->page_content : $specialization->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $specialization->meta_description == '' ? $dseo->description : $specialization->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $specialization->content_image_path ?? $defaultImage->image_path;

    $seo_rating = $specialization->seo_rating == '0' ? '0' : $specialization->seo_rating;

    $seoRatingSchema = true;

    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);
    //die;
    $data = compact('specialization', 'relatedUniversities', 'specializations', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path',  'captcha', 'countries', 'programs');
    return view('front.specialization-details')->with($data);
  }
}
