<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DynamicPageSeo;
use App\Models\PageBanner;
use App\Models\StaticPageContent;
use App\Models\StaticPageSeo;
use Illuminate\Http\Request;

class UniversityApi extends Controller
{
  public function selectUniversity(Request $request)
  {
    $banner = PageBanner::where('uri', 'select-university')->first();
    $pageContentTop = StaticPageContent::where(['page_name' => 'select-university', 'position' => 'top'])->first();
    $pageContentBottom = StaticPageContent::where(['page_name' => 'select-university', 'position' => 'bottom'])->first();
    $pageContentPrivate = StaticPageContent::where(['page_name' => 'select-university', 'position' => 'private-university'])->first();
    $pageContentPublic = StaticPageContent::where(['page_name' => 'select-university', 'position' => 'public-university'])->first();
    $pageContentForeign = StaticPageContent::where(['page_name' => 'select-university', 'position' => 'foreign-university'])->first();

    $seo = StaticPageSeo::where('page', 'universities')->first();

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
      'banner' => $banner,
      'pageContentTop' => $pageContentTop,
      'pageContentBottom' => $pageContentBottom,
      'pageContentPrivate' => $pageContentPrivate,
      'pageContentPublic' => $pageContentPublic,
      'pageContentForeign' => $pageContentForeign,
      'seo' => [
        'meta_title' => $meta_title,
        'meta_keyword' => $meta_keyword,
        'meta_description' => $meta_description,
        'og_image_path' => $og_image_path
      ]
    ]);
  }
}
