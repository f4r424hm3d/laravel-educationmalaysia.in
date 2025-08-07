<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseSpecialization;
use App\Models\DefaultOgImage;
use App\Models\DynamicPageSeo;
use App\Models\InstituteType;
use App\Models\PageBanner;
use App\Models\StaticPageContent;
use App\Models\StaticPageSeo;
use App\Models\University;
use App\Models\UniversityGallery;
use App\Models\UniversityOverview;
use App\Models\UniversityPhoto;
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
  public function universityDetail($uname)
  {
    $university = University::where('uname', $uname)->firstOrFail();

    return response()->json([
      'university' => $university,
    ]);
  }
  public function overview($uname, Request $request)
  {
    $university = University::where(['uname' => $uname])->active()->firstOrFail();
    $overviews = UniversityOverview::where('university_id', $university->id)
      ->orderBy('position')
      ->get();

    //$trendingUniversities = University::inRandomOrder()->active()->where('id', '!=', $university->id)->limit(10)->get();

    $wrdseo = ['url' => 'university'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();

    $title = $university->name;
    $city = $university->city;
    $shortnote = $university->shortnote;
    $inst_type = $university->inst_type;
    $uname = $university->name;

    $site = DOMAIN;

    $tagArray = [
      'title' => $title,
      'address' => $city,
      'shortnote' => $shortnote,
      'universitytype' => $inst_type,
      'universityname' => $uname,
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site,
    ];

    $meta_title = $university->meta_title ?: $dseo->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $university->meta_keyword ?: $dseo->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $university->page_content ?: $dseo->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $university->meta_description ?: $dseo->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $university->og_image_path ?? $dseo->og_image_path;

    $universityPopularCoursesSpecialization = CourseSpecialization::inRandomOrder()
      ->whereHas('programs', function ($query) use ($university) {
        $query->where('university_id', $university->id);
      })->limit(15)->select('id', 'name', 'slug')->get();

    $randomSpecializations = CourseSpecialization::inRandomOrder()
      ->whereHas('programs', function ($query) {
        $query->where('status', 1);
      })->limit(15)->select('id', 'name', 'slug')->get();

    $specializationsWithContents = CourseSpecialization::inRandomOrder()->whereHas('contents')->limit(15)->select('id', 'name', 'slug')->get();

    return response()->json([
      'status' => true,
      'message' => 'University overview fetched successfully',
      'data' => [
        'overviews' => $overviews,
        'university_specializations_for_courses' => $universityPopularCoursesSpecialization,
        'all_specializations_for_courses' => $randomSpecializations,
        'specializations_with_contents' => $specializationsWithContents,
        'seo' => [
          'meta_title' => $meta_title,
          'meta_keyword' => $meta_keyword,
          'meta_description' => $meta_description,
          'page_content' => $page_content,
          'og_image_path' => $og_image_path,
        ],
      ]
    ]);
  }
  public function gallery($uname, Request $request)
  {
    $university = University::where(['uname' => $uname])->active()->firstOrFail();
    $universityPhotos = $university->photos;

    $wrdseo = ['url' => 'gallery'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();

    $title = $university->name;
    $city = $university->city;
    $shortnote = $university->shortnote;
    $inst_type = $university->inst_type;
    $uname = $university->name;

    $site = DOMAIN;

    $tagArray = [
      'title' => $title,
      'address' => $city,
      'shortnote' => $shortnote,
      'universitytype' => $inst_type,
      'universityname' => $uname,
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site,
    ];

    $meta_title = $university->meta_title ?: $dseo->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $university->meta_keyword ?: $dseo->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $meta_description = $university->meta_description ?: $dseo->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $university->og_image_path ?? $dseo->og_image_path;

    return response()->json([
      'status' => true,
      'message' => 'University overview fetched successfully',
      'data' => [
        'universityPhotos' => $universityPhotos,
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
