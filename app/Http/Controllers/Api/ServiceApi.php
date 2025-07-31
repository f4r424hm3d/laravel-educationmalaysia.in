<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseSpecialization;
use App\Models\DynamicPageSeo;
use App\Models\Service;
use App\Models\StaticPageSeo;
use App\Models\University;
use Illuminate\Http\Request;

class ServiceApi extends Controller
{
  public function index(Request $request)
  {
    $services = Service::select('id', 'page_name', 'uri')->orderBy('page_name')->get();

    // Fetch SEO data for 'blog'
    $seo = StaticPageSeo::where('page', 'resources/services')->first();

    $site = url('/');
    $tagArray = [
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = isset($seo->title) ? replaceTag($seo->title, $tagArray) : '';
    $meta_keyword = isset($seo->keyword) ? replaceTag($seo->keyword, $tagArray) : '';
    $meta_description = isset($seo->description) ? replaceTag($seo->description, $tagArray) : '';
    $og_image_path = $seo->ogimgpath ?? null;

    return response()->json([
      'status' => true,
      'message' => 'Services fetched successfully',
      'data' => [
        'services' => $services,
        'seo' => [
          'meta_title' => $meta_title,
          'meta_keyword' => $meta_keyword,
          'meta_description' => $meta_description,
          'og_image_path' => $og_image_path
        ]
      ]
    ]);
  }
  public function serviceDetail($slug, Request $request)
  {
    $service = Service::with('contents')->website()->where('uri', $slug)->firstOrFail();
    $otherServices = Service::select('id', 'page_name', 'uri')->website()->where('id', '!=', $service->id)->get();
    $allServices = Service::select('id', 'page_name', 'uri')->website()->get();

    $wrdseo = ['url' => 'servicesinglepage'];
    $dseo = DynamicPageSeo::website()->where($wrdseo)->first();
    $title = $service->page;
    $headline = $service->headline;
    $site = DOMAIN;
    $tagArray = [
      'title' => $title,
      'headline' => $headline,
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = replaceTag($service->meta_title ?: $dseo->meta_title, $tagArray);
    $meta_keyword = replaceTag($service->meta_keyword ?: $dseo->meta_keyword, $tagArray);
    $page_content = replaceTag($service->page_content ?: $dseo->page_content, $tagArray);
    $meta_description = replaceTag($service->meta_description ?: $dseo->meta_description, $tagArray);
    $og_image_path = $service->ogimgpath ?? $dseo->ogimgpath;
    $seo_rating = $service->seo_rating == '0' ? '0' : $service->seo_rating;
    $seoRatingSchema = true;

    $specializations = CourseSpecialization::select('id', 'name', 'slug')->inRandomOrder()
      ->limit(10)
      ->whereHas('contents')
      ->get();

    $featuredUniversities = University::select('id', 'name', 'uname', 'logo_path')->inRandomOrder()
      ->active()
      ->limit(10)
      ->get();

    return response()->json([
      'status' => true,
      'message' => 'Service details fetched successfully',
      'data' => [
        'service' => $service,
        'other_services' => $otherServices,
        'all_services' => $allServices,
        'seo' => [
          'title' => $title,
          'meta_title' => $meta_title,
          'meta_keyword' => $meta_keyword,
          'meta_description' => $meta_description,
          'page_content' => $page_content,
          'og_image_path' => $og_image_path,
          'seo_rating' => $seo_rating,
          'seo_rating_schema' => $seoRatingSchema,
        ],
        'specializations' => $specializations,
        'featured_universities' => $featuredUniversities
      ]
    ]);
  }
}
