<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\front\SpecializationFc;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\DefaultOgImage;
use App\Models\DynamicPageSeo;
use App\Models\InstituteType;
use App\Models\Month;
use App\Models\PageBanner;
use App\Models\StaticPageContent;
use App\Models\StaticPageSeo;
use App\Models\StudyMode;
use App\Models\University;
use App\Models\UniversityGallery;
use App\Models\UniversityOverview;
use App\Models\UniversityPhoto;
use App\Models\UniversityProgram;
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
    $universityFaculties = CourseCategory::whereHas('programs', function ($query) use ($university) {
      $query->where('university_id', $university->id);
    })->select('id', 'name', 'slug')->get();


    return response()->json([
      'university' => $university,
      'faculties' => $universityFaculties,
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
  public function videos($uname, Request $request)
  {
    $university = University::where(['uname' => $uname])->active()->firstOrFail();
    $universityVideos = $university->videos;

    $wrdseo = ['url' => 'video'];
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
        'universityVideos' => $universityVideos,
        'seo' => [
          'meta_title' => $meta_title,
          'meta_keyword' => $meta_keyword,
          'meta_description' => $meta_description,
          'og_image_path' => $og_image_path,
        ],
      ]
    ]);
  }
  public function courses($university_slug, Request $request)
  {
    $university = University::where('uname', $university_slug)->firstOrFail();

    $query = UniversityProgram::select('id', 'course_name', 'slug', 'study_mode', 'intake', 'application_deadline', 'level', 'course_category_id', 'specialization_id')->where(['university_id' => $university->id, 'status' => 1]);

    // Apply filters
    if ($request->has('level') && $request->input('level') != '') {
      $query->where('level', $request->input('level'));
      $appliedLevel = $request->input('level');
    } else {
      $appliedLevel = null;
    }

    if ($request->has('course_category_id') && $request->input('course_category_id') != '') {
      $query->where('course_category_id', $request->input('course_category_id'));
      $appliedCategory = CourseCategory::find($request->input('course_category_id'));
    } else {
      $appliedCategory = null;
    }

    if ($request->has('specialization_id') && $request->input('specialization_id') != '') {
      $query->where('specialization_id', $request->input('specialization_id'));
      $appliedSpecialization = CourseSpecialization::find($request->input('specialization_id'));
    } else {
      $appliedSpecialization = null;
    }

    if ($request->has('study_mode') && $request->input('study_mode') != '') {
      $query->whereJsonContains('study_mode', $request->input('study_mode'));
      $appliedStudyMode = $request->input('study_mode');
    } else {
      $appliedStudyMode = null;
    }

    $programs = $query->paginate(10)->withQueryString();
    $noc = $programs->total();

    // Extra data
    $levels = UniversityProgram::select('level')
      ->where(['university_id' => $university->id, 'status' => 1])
      ->distinct()->get();

    $categories = CourseCategory::select('id', 'name', 'slug')
      ->whereIn('id', function ($query) use ($university, $request) {
        $query->select('course_category_id')
          ->from('university_programs')
          ->where('university_id', $university->id)
          ->where('status', 1);

        if ($request->filled('level')) {
          $query->where('level', $request->input('level'));
        }
      })->get();

    $specializations = CourseSpecialization::select('id', 'name', 'slug')
      ->whereIn('id', function ($query) use ($university, $request) {
        $query->select('specialization_id')
          ->from('university_programs')
          ->where('university_id', $university->id)
          ->where('status', 1);

        if ($request->filled('level')) {
          $query->where('level', $request->input('level'));
        }
        if ($request->filled('course_category_id')) {
          $query->where('course_category_id', $request->input('course_category_id'));
        }
      })->get();

    $studyModes = StudyMode::select('id', 'study_mode')->get();

    $wrdseo = ['url' => 'university-course-list'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();

    $getCategory = $appliedCategory ? $appliedCategory->name : '';
    $getSpecialization = $appliedSpecialization ? $appliedSpecialization->specialization_name : '';
    $level = $appliedLevel ?? null;
    $university_name = $university->name;

    $title = $university->name;
    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site, 'category' => $getCategory, 'specialization' => $getSpecialization, 'level' => $level, 'university' => $university_name, 'noc' => $noc];

    $meta_title = $university->meta_title == '' ? $dseo->meta_title : $university->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $university->meta_keyword == '' ? $dseo->meta_keyword : $university->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $meta_description = $university->meta_description == '' ? $dseo->meta_description : $university->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $university->og_image_path ?? $dseo->og_image_path;

    return response()->json([
      'programs' => $programs,
      'filters' => [
        'level' => $request->input('level') ?? null,
        'category' => $request->input('course_category_id') ?? null,
        'specialization' => $request->input('specialization_id') ?? null,
        'study_mode' => $request->input('study_mode') ?? null,
      ],
      'levels' => $levels,
      'categories' => $categories,
      'specializations' => $specializations,
      'study_modes' => $studyModes,
      'pagination' => [
        'current_page' => $programs->currentPage(),
        'per_page' => $programs->perPage(),
        'total' => $programs->total(),
        'next_page_url' => $programs->nextPageUrl(),
        'prev_page_url' => $programs->previousPageUrl(),
      ],
      'seos' => [
        'meta_title' => $meta_title,
        'meta_keyword' => $meta_keyword,
        'meta_description' => $meta_description,
        'og_image_path' => $og_image_path,
      ],
    ]);
  }
  public function courseDetail($university_slug, $program_slug, Request $request)
  {
    // 1. Fetch university and program
    $university = University::where('uname', $university_slug)->firstOrFail();
    $program = UniversityProgram::with('contents')->where([
      'university_id' => $university->id,
      'slug' => $program_slug
    ])->firstOrFail();

    // 2. Additional info
    $trendingUniversity = University::select('id', 'name', 'uname', 'logo_path', 'city', 'state')->limit(10)->get();

    // 3. SEO setup
    $wrdseo = ['url' => 'university-course-detail'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();

    $title = $program->course_name;
    $site = DOMAIN;
    $tagArray = [
      'title' => $title,
      'universityname' => $university->name,
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = $program->meta_title ?: $dseo->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $program->meta_keyword ?: $dseo->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $meta_description = $program->meta_description ?: $dseo->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $program->og_image_path ?? $dseo->ogimgpath;

    // 4. Static info
    $months = Month::orderBy('id')->get();

    // 6. Specializations
    $universtySpecializationsForCourses = CourseSpecialization::select('id', 'name', 'slug')->inRandomOrder()
      ->whereHas('programs', function ($query) use ($university) {
        $query->where('university_id', $university->id);
      })->limit(15)->get();

    $randomSpecializations = CourseSpecialization::select('id', 'name', 'slug')->inRandomOrder()
      ->whereHas('programs', function ($query) use ($university) {
        $query->where('status', 1);
      })->limit(15)->get();

    $specializationsWithContents = CourseSpecialization::select('id', 'name', 'slug')->inRandomOrder()
      ->whereHas('contents')
      ->limit(15)->get();

    // 7. Similar programs
    $similarPrograms = UniversityProgram::with(['university:id,name,uname,logo_path,city,state,inst_type'])->inRandomOrder()
      ->where('level', $program->level)
      ->where('specialization_id', $program->specialization_id)
      ->where('id', '!=', $program->id)
      ->where('slug', '!=', '')
      ->whereNotNull('slug')
      ->where('status', 1)
      ->limit(10)
      ->select('id', 'course_name', 'slug', 'level', 'specialization_id', 'university_id', 'study_mode', 'duration', 'intake')->get();

    // 8. Return as JSON
    return response()->json([
      'program' => $program,
      'featured_universities' => $trendingUniversity,
      'similar_programs' => $similarPrograms,
      'months' => $months,
      'specializations' => [
        'university_specializations' => $universtySpecializationsForCourses,
        'random_specializations' => $randomSpecializations,
        'specializations_with_contents' => $specializationsWithContents,
      ],
      'seo' => [
        'meta_title' => $meta_title,
        'meta_keyword' => $meta_keyword,
        'meta_description' => $meta_description,
        'og_image_path' => $og_image_path,
      ],
    ]);
  }
}
