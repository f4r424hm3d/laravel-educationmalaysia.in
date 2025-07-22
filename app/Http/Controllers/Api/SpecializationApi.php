<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CourseSpecialization;
use App\Models\DefaultImage;
use App\Models\DynamicPageSeo;
use App\Models\StaticPageSeo;
use App\Models\University;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;

class SpecializationApi extends Controller
{
  public function index(Request $request)
  {
    $search = $request->query('search');
    $orderBy = $request->query('orderBy', 'name');
    $orderIn = $request->query('orderIn', 'asc');
    $limit = $request->query('limit');

    $query = CourseSpecialization::query()->website()->whereHas('contents');

    if ($search) {
      $query->where('name', 'like', '%' . $search . '%');
    }

    $query->orderBy($orderBy, $orderIn);

    if ($limit) {
      $query->limit((int) $limit);
    }

    $categories = $query->get();

    // Fetch SEO data for 'specializations'
    $seo = StaticPageSeo::where('page', 'specialization')->first();

    $site = url('/');
    $tagArray = [
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = isset($seo->title) ? replaceTag($seo->title, $tagArray) : '';
    $meta_keyword = isset($seo->keyword) ? replaceTag($seo->keyword, $tagArray) : '';
    $meta_description = isset($seo->description) ? replaceTag($seo->description, $tagArray) : '';
    $page_content = isset($seo->page_content) ? replaceTag($seo->page_content, $tagArray) : '';
    $seo_rating = $seo->seo_rating ?? '';
    $og_image_path = $seo->ogimgpath ?? null;

    return response()->json([
      'status' => true,
      'data' => $categories,
      'seo' => [
        'meta_title' => $meta_title,
        'meta_keyword' => $meta_keyword,
        'meta_description' => $meta_description,
        'page_content' => $page_content,
        'seo_rating' => $seo_rating,
        'og_image_path' => $og_image_path
      ]
    ]);
  }


  public function search(Request $request)
  {
    $search = $request->query('search');
    $query = CourseSpecialization::query();
    if ($search) {
      $query->where('category_name', 'like', '%' . $search . '%');
    }
    $categories = $query->get();
    return response()->json([
      'status' => true,
      'data' => $categories
    ]);
  }
  public function detailById($id)
  {
    // 2. Default Image
    $defaultImage = DefaultImage::where('page', 'specialization-detail')->first();

    // 3. Specialization by slug
    $specialization = CourseSpecialization::with('faqs', 'contents') // if faqs are defined as relation
      ->whereHas('contents')
      ->where('id', $id)
      ->firstOrFail();

    // 4. Related Specializations
    $specializations = CourseSpecialization::inRandomOrder()
      ->where('id', '!=', $specialization->id)
      ->whereHas('contents')
      ->limit(10)
      ->get();

    // 5. Related Universities
    $relatedUniversities = University::whereHas('programs', function ($query) use ($specialization) {
      $query->where('specialization_id', $specialization->id);
    })->get();

    // 🔁 Add program count for each related university
    foreach ($relatedUniversities as $university) {
      $university->allspcprograms = UniversityProgram::where([
        'specialization_id' => $specialization->id,
        'university_id' => $university->id,
      ])->count();
    }

    // 6. Featured Universities
    $featuredUniversities = University::inRandomOrder()
      ->active()
      ->limit(10)
      ->get();

    // 7. Programs
    $programs = UniversityProgram::where('specialization_id', $specialization->id)
      ->orderBy('course_name', 'ASC')
      ->get();

    // 8. SEO Handling
    $page_url = url()->current();
    $dseo = DynamicPageSeo::where('url', 'specialization')->first();
    $title = $specialization->name;
    $site = defined('DOMAIN') ? DOMAIN : url('/');

    $tagArray = [
      'title' => $title,
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = $specialization->meta_title ?: ($dseo->title ?? '');
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $specialization->meta_keyword ?: ($dseo->keyword ?? '');
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $specialization->page_content ?: ($dseo->page_content ?? '');
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $specialization->meta_description ?: ($dseo->description ?? '');
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $specialization->content_image_path ?? ($defaultImage->image_path ?? null);
    $seo_rating = $specialization->seo_rating == '0' ? '0' : $specialization->seo_rating;
    $seoRatingSchema = true;

    // 9. Captcha
    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    // 10. Response
    return response()->json([
      'status' => true,
      'data' => [
        'specialization' => $specialization,
        'related_universities' => $relatedUniversities,
        'other_specializations' => $specializations,
        'programs' => $programs,
        'featured_universities' => $featuredUniversities,
        'seo' => [
          'meta_title' => $meta_title,
          'meta_keyword' => $meta_keyword,
          'meta_description' => $meta_description,
          'page_content' => $page_content,
          'og_image_path' => $og_image_path,
          'seo_rating' => $seo_rating,
          'title' => $title,
          'page_url' => $page_url,
          'seo_rating_schema' => $seoRatingSchema,
        ]
      ]
    ]);
  }
  public function detailBySlug($slug)
  {
    // 2. Default Image
    $defaultImage = DefaultImage::where('page', 'specialization-detail')->first();

    // 3. Specialization by slug
    $specialization = CourseSpecialization::with('faqs', 'contents') // if faqs are defined as relation
      ->whereHas('contents')
      ->where('slug', $slug)
      ->firstOrFail();

    // 4. Related Specializations
    $specializations = CourseSpecialization::inRandomOrder()
      ->where('id', '!=', $specialization->id)
      ->whereHas('contents')
      ->limit(10)
      ->get();

    // 5. Related Universities
    $relatedUniversities = University::whereHas('programs', function ($query) use ($specialization) {
      $query->where('specialization_id', $specialization->id);
    })->get();

    // 🔁 Add program count for each related university
    foreach ($relatedUniversities as $university) {
      $university->allspcprograms = UniversityProgram::where([
        'specialization_id' => $specialization->id,
        'university_id' => $university->id,
      ])->count();
    }

    // 6. Featured Universities
    $featuredUniversities = University::inRandomOrder()
      ->active()
      ->limit(10)
      ->get();

    // 7. Programs
    $programs = UniversityProgram::where('specialization_id', $specialization->id)
      ->orderBy('course_name', 'ASC')
      ->get();

    // 8. SEO Handling
    $page_url = url()->current();
    $dseo = DynamicPageSeo::where('url', 'specialization')->first();
    $title = $specialization->name;
    $site = defined('DOMAIN') ? DOMAIN : url('/');

    $tagArray = [
      'title' => $title,
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = $specialization->meta_title ?: ($dseo->title ?? '');
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $specialization->meta_keyword ?: ($dseo->keyword ?? '');
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $specialization->page_content ?: ($dseo->page_content ?? '');
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $specialization->meta_description ?: ($dseo->description ?? '');
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $specialization->content_image_path ?? ($defaultImage->image_path ?? null);
    $seo_rating = $specialization->seo_rating == '0' ? '0' : $specialization->seo_rating;
    $seoRatingSchema = true;

    // 9. Captcha
    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    // 10. Response
    return response()->json([
      'status' => true,
      'data' => [
        'specialization' => $specialization,
        'related_universities' => $relatedUniversities,
        'other_specializations' => $specializations,
        'programs' => $programs,
        'featured_universities' => $featuredUniversities,
        'seo' => [
          'meta_title' => $meta_title,
          'meta_keyword' => $meta_keyword,
          'meta_description' => $meta_description,
          'page_content' => $page_content,
          'og_image_path' => $og_image_path,
          'seo_rating' => $seo_rating,
          'title' => $title,
          'page_url' => $page_url,
          'seo_rating_schema' => $seoRatingSchema,
        ]
      ]
    ]);
  }
}
