<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\StaticPageSeo;
use Illuminate\Http\Request;

class FaqApi extends Controller
{
  public function index()
  {
    $categories = FaqCategory::whereHas('faqs')->get();

    // Fetch SEO data for 'faqs'
    $seo = StaticPageSeo::where('page', 'faqs')->first();

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
      'status' => true,
      'message' => 'Categories fetched successfully',
      'data' => [
        'categories' => $categories,
        'seo' => [
          'meta_title' => $meta_title,
          'meta_keyword' => $meta_keyword,
          'meta_description' => $meta_description,
          'og_image_path' => $og_image_path
        ]
      ]
    ]);
  }

  public function details($category_slug)
  {
    $category = FaqCategory::where('category_slug', $category_slug)->firstOrFail();
    $faqs = Faq::where('category_id', $category->id)->get();
    $categories = FaqCategory::whereHas('faqs')->get();

    $seo = StaticPageSeo::where('page', 'faq/' . $category_slug)->first();
    $site = DOMAIN;
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
      'status' => true,
      'message' => 'Service details fetched successfully',
      'data' => [
        'category' => $category,
        'faqs' => $faqs,
        'categories' => $categories,
        'seo' => [
          'meta_title' => $meta_title,
          'meta_keyword' => $meta_keyword,
          'meta_description' => $meta_description,
          'og_image_path' => $og_image_path,
        ],
      ]
    ]);
  }
}
