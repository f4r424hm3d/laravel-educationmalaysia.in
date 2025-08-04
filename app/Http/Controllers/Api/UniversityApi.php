<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DefaultOgImage;
use App\Models\DynamicPageSeo;
use App\Models\InstituteType;
use App\Models\PageBanner;
use App\Models\StaticPageContent;
use App\Models\StaticPageSeo;
use App\Models\University;
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
  public function universitiesInMalaysia(Request $request)
  {
    $currentInstituteType = null;
    $currentState = null;

    $query = University::select('id', 'name', 'uname', 'city', 'state', 'logo_path', 'rating')
      ->orderBy('name')
      ->where('status', 1);

    // Search filter
    if ($request->filled('search')) {
      $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Institute Type Filter by ID
    if ($request->filled('institute_type')) {
      $instituteType = InstituteType::find($request->institute_type);
      if ($instituteType) {
        $query->where('institute_type', $instituteType->id);
        $currentInstituteType = [
          'id' => $instituteType->id,
          'name' => $instituteType->type,
          'slug' => $instituteType->seo_title_slug,
        ];
      }
    }

    // State Filter
    if ($request->filled('state')) {
      $stateName = unslugify($request->state); // convert "kuala-lumpur" → "Kuala Lumpur"
      $query->where('state', $stateName);
      $currentState = [
        'name' => $stateName,
        'slug' => $request->state,
      ];
    }

    // Pagination
    $universities = $query->paginate(20);
    $total = $universities->total();

    // Institute Types List
    $instituteTypes = InstituteType::all()->map(function ($item) {
      return [
        'id' => $item->id,
        'name' => $item->type,
        'slug' => $item->seo_title_slug
      ];
    });

    // State List
    $statesQuery = University::select('state')
      ->where('status', 1)
      ->whereNotNull('state')
      ->where('state', '!=', '')
      ->distinct();

    if (isset($instituteType)) {
      $statesQuery->where('institute_type', $instituteType->id);
    }

    $states = $statesQuery->get()->map(function ($item) {
      return [
        'name' => $item->state,
        'slug' => slugify($item->state)
      ];
    });

    // SEO Meta
    $dseo = DynamicPageSeo::where('url', 'universities-in-malaysia')->first();
    $dogimg = DefaultOgImage::default()->first();
    $title = 'universities';

    $tagArray = [
      'title' => $title,
      'nou' => $total,
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'institute_type' => $currentInstituteType['name'] ?? '',
    ];

    $meta_title = replaceTag(optional($dseo)->meta_title, $tagArray);
    $meta_keyword = replaceTag(optional($dseo)->meta_keyword, $tagArray);
    $meta_description = replaceTag(optional($dseo)->meta_description, $tagArray);
    $page_content = replaceTag(optional($dseo)->page_content, $tagArray);
    $og_image_path = optional($dogimg)->file_path;

    // Response
    return response()->json([
      'status' => true,
      'message' => 'University list fetched successfully',
      'data' => [
        'universities' => $universities,
        'filters' => [
          'institute_types' => $instituteTypes,
          'states' => $states,
        ],
        'applied_filters' => [
          'current_institute_type' => $currentInstituteType,
          'current_state' => $currentState,
        ],
        'seo' => [
          'meta_title' => $meta_title,
          'meta_keyword' => $meta_keyword,
          'meta_description' => $meta_description,
          'page_content' => $page_content,
          'og_image_path' => $og_image_path,
        ]
      ]
    ]);
  }
}
