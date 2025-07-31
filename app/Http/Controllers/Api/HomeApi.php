<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
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
}
