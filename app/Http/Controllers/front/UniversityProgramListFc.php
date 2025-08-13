<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\DynamicPageSeo;
use App\Models\Level;
use App\Models\Month;
use App\Models\StudyMode;
use Illuminate\Http\Request;
use App\Helpers\UniversityListFilters;
use App\Helpers\UniversityList;
use App\Models\DefaultOgImage;
use Illuminate\Support\Str;

class UniversityProgramListFc extends Controller
{
  public function index(Request $request)
  {
    //return $levelSpc = UniversityProgram::with('getSpecialization')->select('specialization_id', 'level')->whereNotNull('specialization_id')->where('specialization_id', '!=', '')->whereNotNull('level')->where('level', '!=', '')->distinct()->get();

    $curLevel = '';
    $curCat = '';
    $curSpc = '';
    $studymode = '';
    $intake = '';

    if (session()->has('CFilterLevel')) {
      $curLevel = Level::where('slug', session()->get('CFilterLevel'))->first();
    }
    if (session()->has('CFilterCategory')) {
      $curCat = CourseCategory::find(session()->get('CFilterCategory'));
    }
    if (session()->has('CFilterSpecialization')) {
      $curSpc = CourseSpecialization::find(session()->get('CFilterSpecialization'));
    }
    if ($request->has('study_mode')) {
      $studymode = $request->study_mode;
    }
    if ($request->has('intake')) {
      $intake = $request->intake;
    }

    //$request = new Request();
    $rows = UniversityList::universityPrograms($request);
    $nou = UniversityList::universityCount($request);
    $noc = $rows->total();

    $npu = $rows->nextPageUrl() ?? null;
    if ($rows->currentPage() == 2) {
      $firstPageUrl = url()->current();
      $ppu = $firstPageUrl ?? null;
    } else {
      $ppu = $rows->previousPageUrl() ?? null;
    }


    $total = $rows->total();
    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;


    // GET LEVEL FOR FILTER SIDEBAR
    $levelListForFilter = UniversityListFilters::level();
    //$levelListForFilter = Level::all();

    // GET CATEGORY FOR FILTER SIDEBAR
    $categoryListForFilter = UniversityListFilters::category();

    // GET SPECIALIZATION FOR FILTER SIDEBAR
    $spcListForFilter = UniversityListFilters::specialization();

    // GET STUDY MODES FOR FILTER SIDEBAR
    $studyModes = StudyMode::orderBy('study_mode')->get();

    // GET INTAKES FOR FILTER SIDEBAR
    $intakes = Month::orderBy('id')->get();

    $page_url = url()->current();
    $dseo = DynamicPageSeo::where('url', 'courses-in-malaysia')->first();

    //printArray($dseo->toArray());
    //die;

    $dogimg = DefaultOgImage::default()->first();
    $title = 'courses in malaysia';
    $site =  DOMAIN;

    $category = $curCat == '' ? '' : $curCat->name;
    $specialization = $curSpc == '' ? '' : $curSpc->name;
    $level = $curLevel == '' ? '' : $curLevel->level;

    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site, 'category' => $category, 'specialization' => $specialization, 'level' => $level, 'nou' => $nou, 'noc' => $noc, 'studymode' => $studymode,];

    $meta_title = replaceTag($dseo->meta_title, $tagArray);
    $meta_keyword = replaceTag($dseo->meta_keyword, $tagArray);
    $page_content = replaceTag($dseo->content, $tagArray);
    $meta_description = replaceTag($dseo->meta_description, $tagArray);
    $og_image_path = $dogimg->file_path;

    $page_contents = 'Find a list of Courses in Malaysia to study at top private & Public universities in Malaysia. Learn about the course duration, intake, tuition fee, and discover information about leading private universities offering diploma, bachelor degree, master programs, and phd courses. Apply directly for your desired courses today.';

    $specializations = CourseSpecialization::whereHas('contents')->limit(20)->get();

    $data = compact('rows', 'i', 'total', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'levelListForFilter', 'categoryListForFilter', 'spcListForFilter', 'studyModes',  'curLevel', 'curCat', 'curSpc', 'intakes', 'npu', 'ppu', 'page_contents', 'specializations');
    return view('front.courses-in-malaysia')->with($data);
  }
  public function filterUniversity(Request $request)
  {
    $filter = $request->segment(1);
    if (!Str::contains($filter, '-courses')) {
      abort(404);
    }

    $curLevel = '';
    $curCat = '';
    $curSpc = '';
    $studymode = '';
    $intake = '';

    $filter_slug = str_replace('-courses', '', $filter);
    if ($filter_slug == '') {
      abort(404);
    }
    // Find in levels table
    $chkLevel = Level::where('slug', $filter_slug)->first();
    // Find in course_categories table
    $chkCategory = CourseCategory::where('slug', $filter_slug)->first();
    // Find in course_specializations table
    $chkSpecialization = CourseSpecialization::where('slug', $filter_slug)->first();

    $pageContentKeyword = null;
    $seoUrl = 'courses-in-malaysia';
    // Check if any match is found
    if ($chkLevel !== null) {
      session()->put('CFilterLevel', $chkLevel->level);
      $pageContentKeyword = $chkLevel->level;
      $seoUrl .= '-by-level';
    } elseif ($chkCategory !== null) {
      session()->put('CFilterCategory', $chkCategory->id);
      $pageContentKeyword = $chkCategory->name;
      $seoUrl .= '-by-category';
    } elseif ($chkSpecialization !== null) {
      session()->put('CFilterSpecialization', $chkSpecialization->id);
      $pageContentKeyword = $chkSpecialization->name;
      $seoUrl .= '-by-specialization';
    } else {
      abort(404);
    }

    if (session()->has('CFilterLevel')) {
      $curLevel = Level::where('slug', session()->get('CFilterLevel'))->first();
    }
    if (session()->has('CFilterCategory')) {
      $curCat = CourseCategory::find(session()->get('CFilterCategory'));
    }
    if (session()->has('CFilterSpecialization')) {
      $curSpc = CourseSpecialization::find(session()->get('CFilterSpecialization'));
    }
    if ($request->has('study_mode')) {
      $studymode = $request->study_mode;
    }
    if ($request->has('intake')) {
      $intake = $request->intake;
    }

    //$request = new Request();
    $rows = UniversityList::universityPrograms($request);
    $nou = UniversityList::universityCount($request);
    //die;
    $noc = $rows->total();

    $npu = $rows->nextPageUrl() ?? null;
    if ($rows->currentPage() == 2) {
      $firstPageUrl = url()->current();
      $ppu = $firstPageUrl ?? null;
    } else {
      $ppu = $rows->previousPageUrl() ?? null;
    }

    $total = $rows->total();
    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;

    // GET LEVEL FOR FILTER SIDEBAR
    $levelListForFilter = UniversityListFilters::level();
    //$levelListForFilter = Level::all();

    // GET CATEGORY FOR FILTER SIDEBAR
    $categoryListForFilter = UniversityListFilters::category();

    // GET SPECIALIZATION FOR FILTER SIDEBAR
    $spcListForFilter = UniversityListFilters::specialization();

    // GET STUDY MODES FOR FILTER SIDEBAR
    $studyModes = StudyMode::orderBy('study_mode')->get();

    // GET INTAKES FOR FILTER SIDEBAR
    $intakes = Month::orderBy('id')->get();

    $page_url = url()->current();
    $dseo = DynamicPageSeo::where('url', $seoUrl)->first();
    $dogimg = DefaultOgImage::default()->first();
    $title = $pageContentKeyword;
    $site =  DOMAIN;

    $category = $curCat == '' ? '' : $curCat->name;
    $specialization = $curSpc == '' ? '' : $curSpc->name;
    $level = $curLevel == '' ? '' : $curLevel->level;
    $state = session()->has('FilterState') ? unslugify(session()->get('FilterState')) : '';
    $city = session()->has('FilterCity') ? unslugify(session()->get('FilterCity')) : '';

    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site, 'category' => $category, 'specialization' => $specialization, 'level' => $level, 'nou' => $nou, 'noc' => $noc, 'studymode' => $studymode,];

    $meta_title = replaceTag($dseo->meta_title, $tagArray);
    $meta_keyword = replaceTag($dseo->meta_keyword, $tagArray);
    $page_content = replaceTag($dseo->content, $tagArray);
    $meta_description = replaceTag($dseo->meta_description, $tagArray);
    $og_image_path = $dogimg->file_path;

    $page_contents = 'Discover a list of ' . $noc . ' ' . $pageContentKeyword . ' courses offered by the Top ' . $nou . ' universities and colleges in Malaysia. Gather valuable information such as entry requirements, fee structures, intake schedules for ' . date('Y') . ', study modes, and recommendations for the best universities and colleges offering ' . $pageContentKeyword . ' degree programs. Enroll directly in ' . $pageContentKeyword . ' courses through EducationMalaysia.in.';

    $specializations = CourseSpecialization::whereHas('contents')->limit(20)->get();

    $data = compact('rows', 'i', 'total', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'levelListForFilter', 'categoryListForFilter', 'spcListForFilter', 'studyModes', 'curLevel', 'curCat', 'curSpc', 'intakes', 'npu', 'ppu', 'page_contents', 'specializations');
    return view('front.courses-in-malaysia')->with($data);
  }
  public function filterUniversityByLevelSpc(Request $request)
  {
    $filter = $request->segment(1);
    if (!Str::contains($filter, '-courses')) {
      abort(404);
    }

    $curLevel = '';
    $curCat = '';
    $curSpc = '';
    $studymode = '';
    $intake = '';

    $filter_slug = str_replace('-courses', '', $filter);

    $xplVar = explode('-in-', $filter_slug, 2);
    $currentLevelFilter = $xplVar[0];
    $currentSpcFilter = $xplVar[1];

    if ($filter_slug == '') {
      abort(404);
    }
    // Find in levels table
    $chkLevel = Level::where('slug', $currentLevelFilter)->first();
    // Find in course_categories table
    //$chkCategory = CourseCategory::where('slug', $filter_slug)->first();
    // Find in course_specializations table
    $chkSpecialization = CourseSpecialization::where('slug', $currentSpcFilter)->first();

    $pageContentKeyword = null;
    $seoUrl = 'courses-in-malaysia';
    // Check if any match is found
    if ($chkLevel !== null) {
      session()->put('CFilterLevel', $chkLevel->level);
      $pageContentKeyword = $chkLevel->level;
      $seoUrl .= '-by-level';
    } elseif ($chkSpecialization !== null) {
      session()->put('CFilterSpecialization', $chkSpecialization->id);
      $pageContentKeyword = $chkSpecialization->name;
      $seoUrl .= '-by-specialization';
    } else {
      abort(404);
    }

    if (session()->has('CFilterLevel')) {
      $curLevel = Level::where('slug', session()->get('CFilterLevel'))->first();
    }
    if (session()->has('CFilterCategory')) {
      $curCat = CourseCategory::find(session()->get('CFilterCategory'));
    }
    if (session()->has('CFilterSpecialization')) {
      $curSpc = CourseSpecialization::find(session()->get('CFilterSpecialization'));
    }
    if ($request->has('study_mode')) {
      $studymode = $request->study_mode;
    }
    if ($request->has('intake')) {
      $intake = $request->intake;
    }

    //$request = new Request();
    $rows = UniversityList::universityPrograms($request);
    $nou = UniversityList::universityCount($request);
    //die;
    $noc = $rows->total();

    $npu = $rows->nextPageUrl() ?? null;
    if ($rows->currentPage() == 2) {
      $firstPageUrl = url()->current();
      $ppu = $firstPageUrl ?? null;
    } else {
      $ppu = $rows->previousPageUrl() ?? null;
    }

    $total = $rows->total();
    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;

    // GET LEVEL FOR FILTER SIDEBAR
    $levelListForFilter = UniversityListFilters::level();
    //$levelListForFilter = Level::all();

    // GET CATEGORY FOR FILTER SIDEBAR
    $categoryListForFilter = UniversityListFilters::category();

    // GET SPECIALIZATION FOR FILTER SIDEBAR
    $spcListForFilter = UniversityListFilters::specialization();

    // GET STUDY MODES FOR FILTER SIDEBAR
    $studyModes = StudyMode::orderBy('study_mode')->get();

    // GET INTAKES FOR FILTER SIDEBAR
    $intakes = Month::orderBy('id')->get();

    $page_url = url()->current();
    $dseo = DynamicPageSeo::where('url', $seoUrl)->first();
    $dogimg = DefaultOgImage::default()->first();
    $title = $pageContentKeyword;
    $site =  DOMAIN;

    $category = $curCat == '' ? '' : $curCat->name;
    $specialization = $curSpc == '' ? '' : $curSpc->name;
    $level = $curLevel == '' ? '' : $curLevel->level;
    $state = session()->has('FilterState') ? unslugify(session()->get('FilterState')) : '';
    $city = session()->has('FilterCity') ? unslugify(session()->get('FilterCity')) : '';

    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site, 'category' => $category, 'specialization' => $specialization, 'level' => $level, 'nou' => $nou, 'noc' => $noc, 'studymode' => $studymode,];

    $meta_title = replaceTag($dseo->meta_title, $tagArray);
    $meta_keyword = replaceTag($dseo->meta_keyword, $tagArray);
    $page_content = replaceTag($dseo->content, $tagArray);
    $meta_description = replaceTag($dseo->meta_description, $tagArray);
    $og_image_path = $dogimg->file_path;

    $page_contents = 'Discover a list of ' . $noc . ' ' . $pageContentKeyword . ' courses offered by the Top ' . $nou . ' universities and colleges in Malaysia. Gather valuable information such as entry requirements, fee structures, intake schedules for ' . date('Y') . ', study modes, and recommendations for the best universities and colleges offering ' . $pageContentKeyword . ' degree programs. Enroll directly in ' . $pageContentKeyword . ' courses through EducationMalaysia.in.';

    $specializations = CourseSpecialization::whereHas('contents')->limit(20)->get();

    $data = compact('rows', 'i', 'total', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'levelListForFilter', 'categoryListForFilter', 'spcListForFilter', 'studyModes', 'curLevel', 'curCat', 'curSpc', 'intakes', 'npu', 'ppu', 'page_contents', 'specializations');
    return view('front.courses-in-malaysia')->with($data);
  }
  public function removeFilter(Request $request)
  {
    if ($request->value == 'CFilterCategory') {
      session()->forget('CFilterSpecialization');
    }

    session()->forget($request->value);

    if (session()->has('CFilterSpecialization')) {
      $curSpc = CourseSpecialization::find(session()->get('CFilterSpecialization'));
      $main = $curSpc->slug . '-courses';
    } else if (session()->has('CFilterCategory')) {
      $curCat = CourseCategory::find(session()->get('CFilterCategory'));
      $main = $curCat->slug . '-courses';
    } else if (session()->has('CFilterLevel')) {
      $curLevel = Level::where('slug', session()->get('CFilterLevel'))->first();
      $main = slugify($curLevel->level) . '-courses';
    } else {
      $main = 'courses-in-malaysia';
    }
    $url = $main;
    return url($url);
  }
  public function removeAllFilter(Request $request)
  {
    session()->forget('CFilterLevel');
    session()->forget('CFilterCategory');
    session()->forget('CFilterSpecialization');
  }
  public function applyFilter(Request $request)
  {
    session()->put('CFilterLevel', $request->CFilterLevel);
    session()->put('CFilterCategory', $request->CFilterCategory);
  }
}
