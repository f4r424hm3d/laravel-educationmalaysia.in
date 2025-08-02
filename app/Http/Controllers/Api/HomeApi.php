<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\PageContent;
use App\Models\StaticPageSeo;
use App\Models\Testimonial;
use App\Models\University;
use Illuminate\Http\Request;

class HomeApi extends Controller
{
  public function index(Request $request)
  {
    // $blogs = Blog::limit(10)->get();

    $universities = University::select('id', 'name', 'uname', 'logo_path')->withCount('programs')->inRandomOrder()->active()->homeview()->limit(12)->get();

    $universityRanks = University::select('id', 'name', 'uname', 'logo_path', 'qs_rank', 'times_rank', 'rank')->withCount('programs')->inRandomOrder()->active()->homeview()->where(function ($query) {
      $query->whereNotNull('qs_rank')->where('qs_rank', '!=', '')
        ->orWhereNotNull('times_rank')->where('times_rank', '!=', '')
        ->orWhereNotNull('rank')->where('rank', '!=', '');
    })->limit(10)->get();

    $specializations = CourseSpecialization::select('id', 'name', 'slug')->whereHas('universityPrograms')->inRandomOrder()->limit(20)->get();

    $specializationsWithContent = CourseSpecialization::select('id', 'name', 'slug')->whereHas('contents')->inRandomOrder()->limit(20)->get();

    $pageContent = PageContent::with([
      'author' => function ($query) {
        $query->select('id', 'name'); // fields from parentContents
      }
    ])->where('page_name', 'home')->first();

    $testimonials = Testimonial::select('id', 'user_type', 'name', 'country', 'review')->limit(20)->active()->inRandomOrder()->get();

    $seo = StaticPageSeo::where('page', 'blog')->first();

    $site = url('/');
    $tagArray = [
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = isset($seo->meta_title) ? replaceTag($seo->meta_title, $tagArray) : '';
    $meta_keyword = isset($seo->meta_keyword) ? replaceTag($seo->meta_keyword, $tagArray) : '';
    $meta_description = isset($seo->meta_description) ? replaceTag($seo->meta_description, $tagArray) : '';
    $og_image_path = $seo->ogimgpath ?? null;

    return response()->json([
      'status' => true,
      'message' => 'Homepage data fetched successfully',
      'data' => [
        'universities' => $universities,
        'universityRanks' => $universityRanks,
        'specializations' => $specializations,
        'specializationsWithContent' => $specializationsWithContent,
        'pageContent' => $pageContent,
        'testimonials' => $testimonials,
        'seo' => [
          'meta_title' => $meta_title,
          'meta_keyword' => $meta_keyword,
          'meta_description' => $meta_description,
          'og_image_path' => $og_image_path
        ]
      ],
    ]);
  }
  public function coursesByLevel($level_slug, Request $request)
  {
    $page_name = $level_slug; // assuming API route is like /api/courses/{page_name}

    $pageContent = PageContent::with([
      'author' => function ($query) {
        $query->select('id', 'name', 'slug');
      }
    ])->where('website', site_var)->where('page_name', $page_name)->first();

    if (!$pageContent) {
      return response()->json([
        'message' => 'Page not found',
      ], 404);
    }

    $level = strtoupper($page_name);

    $categories = CourseCategory::whereHas('programs', function ($query) use ($level) {
      $query->where('status', 1)
        ->where('level', $level)
        ->whereHas('university', function ($query) {
          $query->where('status', 1);
        });
    })->with(['specializations' => function ($query) use ($level) {
      $query->select('id', 'name', 'slug', 'course_category_id')->whereHas('universityPrograms', function ($query) use ($level) {
        $query->where('status', 1)->where('level', $level)->whereHas('university', function ($query) {
          $query->where('status', 1);
        });
      })->orderBy('name');
    }])->select('id', 'name', 'slug', 'thumbnail_path', 'shortnote')->orderBy('name')->get();


    $seo = StaticPageSeo::where('page', 'courses/' . $page_name)->first();

    $site = url('/');
    $tagArray = [
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = isset($seo->meta_title) ? replaceTag($seo->meta_title, $tagArray) : '';
    $meta_keyword = isset($seo->meta_keyword) ? replaceTag($seo->meta_keyword, $tagArray) : '';
    $meta_description = isset($seo->meta_description) ? replaceTag($seo->meta_description, $tagArray) : '';
    $og_image_path = $seo->og_image_path ?? null;

    return response()->json([
      'pageContent' => $pageContent,
      'categories' => $categories,
      'level' => $level,
      'seo' => [
        'meta_title' => $meta_title,
        'meta_keyword' => $meta_keyword,
        'meta_description' => $meta_description,
        'og_image_path' => $og_image_path
      ]
    ]);
  }
}
