<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CourseSpecialization;
use App\Models\DynamicPageSeo;
use App\Models\Exam;
use App\Models\StaticPageSeo;
use App\Models\University;
use Illuminate\Http\Request;

class ExamApi extends Controller
{
  public function index(Request $request)
  {
    $exams = Exam::select('id', 'page_name', 'uri', 'headline', 'imgpath')->where(['status' => 1])->website()->get();
    // Fetch SEO data for 'exams'
    $seo = StaticPageSeo::where('page', 'exams')->first();

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
      'data' => [
        'exams' => $exams
      ],
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

  public function examDetail($uri, Request $request)
  {
    $exam = Exam::website()
      ->where(['status' => 1])
      ->where('uri', $uri)
      ->firstOrFail();

    $exams = Exam::select('id', 'page_name', 'uri', 'headline', 'imgpath')->website()
      ->where('status', 1)
      ->where('id', '!=', $exam->id)
      ->get();

    $allExams = Exam::select('page_name')->website()
      ->where('status', 1)
      ->get();

    $specializations = CourseSpecialization::select('id', 'name', 'slug')->inRandomOrder()
      ->limit(10)
      ->whereHas('contents')
      ->get();

    $featuredUniversities = University::select('id', 'name', 'uname', 'logo_path', 'city', 'state')->inRandomOrder()
      ->active()
      ->limit(10)
      ->get();

    // SEO & Meta Data
    $page_url = url()->current();

    $dseo = DynamicPageSeo::website()
      ->where('url', 'exam-single-page')
      ->first();

    $title = $exam->page_name;
    $headline = $exam->headline;
    $site = defined('DOMAIN') ? DOMAIN : url('/');

    $tagArray = [
      'title' => $title,
      'headline' => $headline,
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = $exam->meta_title ?: ($dseo->title ?? '');
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $exam->meta_keyword ?: ($dseo->keyword ?? '');
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $exam->page_content ?: ($dseo->page_content ?? '');
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $exam->meta_description ?: ($dseo->description ?? '');
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $exam->imgpath ?? ($dseo->ogimgpath ?? null);

    return response()->json([
      'status' => true,
      'data' => [
        'exam' => $exam,
        'other_exams' => $exams,
        'all_exams' => $allExams,
        'specializations' => $specializations,
        'featured_universities' => $featuredUniversities,
        'seo' => [
          'meta_title' => $meta_title,
          'meta_keyword' => $meta_keyword,
          'meta_description' => $meta_description,
          'page_content' => $page_content,
          'og_image_path' => $og_image_path,
          'title' => $title,
          'headline' => $headline,
          'page_url' => $page_url
        ]
      ]
    ]);
  }
}
