<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\DefaultOgImage;
use App\Models\DynamicPageSeo;
use App\Models\Level;
use App\Models\Month;
use App\Models\StudyMode;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;

class CoursesInMalaysiaApi extends Controller
{
  public function index(Request $request)
  {
    $levelSlug = $request->get('level');
    $categorySlug = $request->get('category');
    $specializationSlug = $request->get('specialization');
    $studyMode = $request->get('study_mode');
    $intake = $request->get('intake');

    $curLevel = null;
    $curCat = null;
    $curSpc = null;

    // Detect current filter values
    if (!empty($levelSlug)) {
      $curLevel = Level::where('slug', $levelSlug)->first();
    }
    if (!empty($categorySlug)) {
      $curCat = CourseCategory::where('slug', $categorySlug)->first();
    }
    if (!empty($specializationSlug)) {
      $curSpc = CourseSpecialization::where('slug', $specializationSlug)->first();
    }

    // Build query for university programs
    $query = UniversityProgram::with([
      'university' => function ($q) {
        $q->select('id', 'name', 'uname', 'city', 'state', 'inst_type', 'rank', 'rating', 'logo_path')
          ->withCount('programs') // keep after select
          ->where('status', 1);
      }
    ])
      ->select('id', 'course_name', 'slug', 'level', 'duration', 'study_mode', 'intake', 'university_id', 'course_category_id', 'specialization_id')
      ->where('status', 1);



    $query->whereHas('university', function ($q) use ($request) {
      $q->where('status', 1);

      if ($request->has('search') && $request->search != '') {
        $q->where('name', 'like', '%' . $request->search . '%');
      }
    });

    if ($curLevel) {
      $query->where('level', $curLevel->level);
    }
    if ($curCat) {
      $query->where('course_category_id', $curCat->id);
    }
    if ($curSpc) {
      $query->where('specialization_id', $curSpc->id);
    }
    if (!empty($studyMode)) {
      $query->whereRaw("FIND_IN_SET(?, study_mode)", [$studyMode]);
    }
    if (!empty($intake)) {
      $query->whereRaw("FIND_IN_SET(?, intake)", [$intake]);
    }

    // Paginate results
    $rows = $query->paginate(10);
    $nou = (clone $query)->groupBy('university_id')->get()->count();
    $noc = $rows->total();

    // Filters for sidebar
    $levelListForFilter = Level::select('id', 'level', 'slug')->orderBy('id')->whereHas('allUniversityPrograms', function ($q) {
      $q->where('status', 1)->where('website', site_var);
    })->get();

    $categoryListForFilter = CourseCategory::query()
      ->whereHas('programs', function ($q) use ($levelSlug) {
        $q->where('status', 1)->where('website', site_var)
          ->when($levelSlug, function ($q) use ($levelSlug) {
            $q->where('level', $levelSlug);
          })
          ->whereHas('university', function ($u) {
            $u->where('status', 1);
          });
      })
      ->select('id', 'name', 'slug')
      ->orderBy('name')
      ->get();

    $spcListForFilter = CourseSpecialization::orderBy('name')
      ->whereHas('programs', function ($q) use ($levelSlug, $curCat) {
        $q->where('status', 1)
          ->when($levelSlug, function ($q) use ($levelSlug) {
            $q->where('level', $levelSlug);
          })
          ->when($curCat, function ($q) use ($curCat) {
            $q->where('course_category_id', $curCat->id);
          })
          ->whereHas('university', function ($u) {
            $u->where('status', 1);
          });
      })
      ->select('id', 'name', 'slug')
      ->groupBy('name')
      ->get();

    $studyModes = StudyMode::orderBy('study_mode')->get();
    $intakes = Month::orderBy('id')->get();

    // SEO (optional if needed)
    $pageContentKeyword = $curLevel->level ?? $curCat->name ?? $curSpc->name ?? '';
    $seoUrl = 'courses-in-malaysia';
    if ($curLevel) $seoUrl .= '-by-level';
    elseif ($curCat) $seoUrl .= '-by-category';
    elseif ($curSpc) $seoUrl .= '-by-specialization';

    $dseo = DynamicPageSeo::where('url', $seoUrl)->first();
    $dogimg = DefaultOgImage::default()->first();
    $site = DOMAIN;

    $tagArray = [
      'title' => $pageContentKeyword,
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site,
      'category' => $curCat->name ?? '',
      'specialization' => $curSpc->name ?? '',
      'level' => $curLevel->level ?? '',
      'nou' => $nou,
      'noc' => $noc,
      'studymode' => $studyMode,
    ];

    $meta_title = $dseo ? replaceTag($dseo->meta_title, $tagArray) : '';
    $meta_keyword = $dseo ? replaceTag($dseo->meta_keyword, $tagArray) : '';
    $meta_description = $dseo ? replaceTag($dseo->meta_description, $tagArray) : '';
    $og_image_path = $dogimg->file_path ?? '';

    $page_contents = 'Discover a list of ' . $noc . ' ' . $pageContentKeyword . ' courses offered by the Top ' . $nou . ' universities and colleges in Malaysia. Gather valuable information such as entry requirements, fee structures, intake schedules for ' . date('Y') . ', study modes, and recommendations for the best universities and colleges offering ' . $pageContentKeyword . ' degree programs. Enroll directly in ' . $pageContentKeyword . ' courses through EducationMalaysia.in.';

    // Final API Response
    return response()->json([
      'rows' => $rows,
      'filters' => [
        'levels' => $levelListForFilter,
        'categories' => $categoryListForFilter,
        'specializations' => $spcListForFilter,
        'study_modes' => $studyModes,
        'intakes' => $intakes,
      ],
      'current_filters' => [
        'level' => $curLevel->level ?? '',
        'category' => $curCat ? [
          'id'   => $curCat->id,
          'name' => $curCat->name,
          'slug' => $curCat->slug,
        ] : null,
        'specialization' => $curSpc ? [
          'id'   => $curSpc->id,
          'name' => $curSpc->name,
          'slug' => $curSpc->slug,
        ] : null,
        'study_mode' => $studyMode,
        'intake' => $intake,
      ],
      'seo' => [
        'meta_title' => $meta_title,
        'meta_keyword' => $meta_keyword,
        'meta_description' => $meta_description,
        'page_contents' => $page_contents,
        'og_image' => $og_image_path,
      ]
    ]);
  }
}
