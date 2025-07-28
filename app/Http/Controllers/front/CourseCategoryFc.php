<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CourseCategory;
use App\Models\DefaultImage;
use App\Models\DynamicPageSeo;
use App\Models\University;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;

class CourseCategoryFc extends Controller
{
  public function detail($slug, Request $request)
  {
    $countries = Country::orderBy('name', 'ASC')->get();
    $phonecodes = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
    $defaultImage = DefaultImage::where('page', 'course-category-detail')->first();

    // Fetch course specialization by slug and website filter
    $category = CourseCategory::where('slug', $slug)->whereHas('contents')->website()->firstOrFail();
    $categories = CourseCategory::inRandomOrder()->whereHas('contents')->where('id', '!=', $category->id)->website()->limit(10)->get();

    // Fetch related universities
    $relatedUniversities = University::whereHas('programs', function ($query) use ($category) {
      $query->where('course_category_id', $category->id);
    })->get();

    $featuredUniversities = University::inRandomOrder()->active()->limit(10)->get();

    $page = request()->get('page', 1) - 1;
    $start_from = 10 * $page;

    $programs = UniversityProgram::website()->where('course_category_id', $category->id)->orderBy('course_name', 'ASC')->get();

    $page_url = url()->current();

    $wrdseo = ['url' => 'subjectdetailpage'];
    $dseo = DynamicPageSeo::website()->where($wrdseo)->first();
    $title = $category->name;
    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $category->meta_title == '' ? $dseo->meta_title : $category->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $category->meta_keyword == '' ? $dseo->meta_keyword : $category->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $category->page_content == '' ? $dseo->page_content : $category->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $category->meta_description == '' ? $dseo->meta_description : $category->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $category->content_image_path ?? $defaultImage->image_path;

    $seo_rating = $category->seo_rating == '0' ? '0' : $category->seo_rating;

    $seoRatingSchema = true;

    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    $data = compact('category', 'categories', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path',  'captcha', 'countries', 'phonecodes', 'programs', 'relatedUniversities', 'featuredUniversities');
    return view('front.category-details')->with($data);
  }
}
