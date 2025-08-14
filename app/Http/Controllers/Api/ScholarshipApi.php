<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DynamicPageSeo;
use App\Models\Scholarship;
use App\Models\StaticPageSeo;
use Illuminate\Http\Request;

class ScholarshipApi extends Controller
{

  public function index()
  {
    $scholarships = Scholarship::website()->get();

    $seo = StaticPageSeo::where('page', 'scholarships')->first();

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
      'scholarships' => $scholarships,
      'seo' => [
        'meta_title'       => $meta_title,
        'meta_keyword'     => $meta_keyword,
        'meta_description' => $meta_description,
        'og_image'         => $og_image_path,
      ]
    ]);
  }

  public function details($slug, Request $request)
  {

    $scholarship = Scholarship::with(['contents', 'faqs'])->website()
      ->where(['slug' => $slug])
      ->firstOrFail();

    $scholarships = Scholarship::select('id', 'title', 'slug')->website()
      ->where('id', '!=', $scholarship->id)
      ->get();

    $wrdseo = ['url' => 'scholarship-detail-page'];
    $dseo = DynamicPageSeo::website()->where($wrdseo)->first();

    $title = $scholarship->title;
    $site = DOMAIN;
    $tagArray = [
      'title'        => $title,
      'currentmonth' => date('M'),
      'currentyear'  => date('Y'),
      'site'         => $site
    ];

    $meta_title = $scholarship->meta_title ?: $dseo->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $scholarship->meta_keyword ?: $dseo->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $meta_description = $scholarship->meta_description ?: $dseo->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $scholarship->content_image_path ?? $dseo->og_image_path;

    return response()->json([
      'scholarship'    => $scholarship,
      'other_scholarships'        => $scholarships,
      'seo' => [
        'meta_title'       => $meta_title,
        'meta_keyword'     => $meta_keyword,
        'meta_description' => $meta_description,
        'og_image'         => $og_image_path,
        'seo_rating_schema' => true
      ]
    ]);
  }
}
