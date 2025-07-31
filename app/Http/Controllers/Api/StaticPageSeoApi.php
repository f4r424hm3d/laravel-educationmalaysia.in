<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaticPageSeo;

class StaticPageSeoApi extends Controller
{
  public function getSeoData($page = 'home')
  {
    $site = url('/');

    // Try to get SEO for the requested page
    $seo = StaticPageSeo::where('page', $page)->first();

    // Fallback to 'home' if not found
    if (!$seo) {
      $seo = StaticPageSeo::where('page', 'home')->first();
    }

    $tagArray = [
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = isset($seo->meta_title) ? replaceTag($seo->meta_title, $tagArray) : '';
    $meta_keyword = isset($seo->meta_keyword) ? replaceTag($seo->meta_keyword, $tagArray) : '';
    $meta_description = isset($seo->meta_description) ? replaceTag($seo->meta_description, $tagArray) : '';
    $page_content = isset($seo->page_content) ? replaceTag($seo->page_content, $tagArray) : '';
    $seo_rating = $seo->seo_rating ?? '';
    $og_image_path = $seo->ogimgpath ?? null;

    return response()->json([
      'status' => true,
      'data' => [
        'meta_title' => $meta_title,
        'meta_keyword' => $meta_keyword,
        'meta_description' => $meta_description,
        'page_content' => $page_content,
        'seo_rating' => $seo_rating,
        'og_image_path' => $og_image_path,
        'source_page' => $page == $seo->page ? $page : 'home'
      ]
    ]);
  }
}
