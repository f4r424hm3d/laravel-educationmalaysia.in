<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\Destination;
use App\Models\DynamicPageSeo;
use App\Models\InstituteType;
use App\Models\Level;
use App\Models\Month;
use App\Models\StudyMode;
use App\Models\University;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;
use App\Helpers\UniversityListFilters;
use App\Helpers\UniversityList;
use App\Models\DefaultOgImage;
use Illuminate\Support\Str;

class UniversityProgramListFc extends Controller
{
  public function index(Request $request)
  {
    //return $request->study_mode;
    $destination_slug = $request->segment(1);
    $destination = Destination::where(['destination_slug' => $destination_slug])->firstOrFail();
    $destinationId = $destination->id;

    $curLevel = '';
    $curCat = '';
    $curSpc = '';
    $curInstType = '';
    $curState = '';
    $curCity = '';

    $headTitle = null;
    $headTail = null;

    $seg2 = $request->segment(2);

    if (session()->has('FilterState')) {
      $headTail = unslugify(session()->get('FilterState'));
    }
    if (session()->has('FilterCity')) {
      $headTail = unslugify(session()->get('FilterCity'));
    }
    if (session()->has('FilterInstituteType')) {
      $curInstType = InstituteType::find(session()->get('FilterInstituteType'));
    }

    if (session()->has('FilterLevel')) {
      $curLevel = Level::find(session()->get('FilterLevel'));
    }
    if (session()->has('FilterCategory')) {
      $curCat = CourseCategory::find(session()->get('FilterCategory'));
    }
    if (session()->has('FilterSpecialization')) {
      $curSpc = CourseSpecialization::find(session()->get('FilterSpecialization'));
    }

    $request = new Request();
    $rows = UniversityList::universities($request, $destination);
    $npu = $rows->nextPageUrl() ?? null;
    if ($rows->currentPage() == 2) {
      $firstPageUrl = url()->current();
      $ppu = $firstPageUrl ?? null;
    } else {
      $ppu = $rows->previousPageUrl() ?? null;
    }

    // printArray($rows->toArray());
    // die;
    $total = $rows->total();
    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;

    // GET DESTINATION FOR FILTER SIDEBAR
    $destinations = UniversityListFilters::destinations();

    // GET LEVEL FOR FILTER SIDEBAR
    $levelListForFilter = UniversityListFilters::level($destinationId);

    // GET CATEGORY FOR FILTER SIDEBAR
    $categoryListForFilter = UniversityListFilters::category($destinationId);

    // GET SPECIALIZATION FOR FILTER SIDEBAR
    $spcListForFilter = UniversityListFilters::specialization($destinationId);

    // GET INSTITUTE TYPE FOR FILTER SIDEBAR
    $instTYpe = UniversityListFilters::instituteType($destinationId);

    // GET STATES FOR FILTER SIDEBAR
    $states = UniversityListFilters::states($destinationId);

    // GET CITIES FOR FILTER SIDEBAR
    $cities = UniversityListFilters::cities($destinationId);

    // GET STUDY MODES FOR FILTER SIDEBAR
    $studyModes = StudyMode::orderBy('study_mode')->get();

    // GET INTAKES FOR FILTER SIDEBAR
    $intakes = Month::orderBy('month_number')->get();

    $page_url = url()->current();
    $wrdseo = ['url' => 'university-list'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();
    $dogimg = DefaultOgImage::default()->first();
    $title = 'universities';
    $d_name = $destination->destination_name;
    $site =  'educationmalaysia.in';

    $category = $curCat == '' ? '' : $curCat->category_name;
    $specialization = $curSpc == '' ? '' : $curSpc->specialization_name;
    $level = $curLevel == '' ? '' : $curLevel->level;
    $institute_type = $curInstType == '' ? '' : $curInstType->type;
    $state = session()->has('FilterState') ? unslugify(session()->get('FilterState')) : '';
    $city = session()->has('FilterCity') ? unslugify(session()->get('FilterCity')) : '';

    $tagArray = ['title' => $title, 'destination' => $d_name, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site, 'category' => $category, 'specialization' => $specialization, 'level' => $level, 'institute_type' => $institute_type, 'state' => $state, 'city' => $city, 'nou' => $total];

    $meta_title = replaceTag($dseo->meta_title, $tagArray);
    $meta_keyword = replaceTag($dseo->meta_keyword, $tagArray);
    $page_content = replaceTag($dseo->page_content, $tagArray);
    $meta_description = replaceTag($dseo->meta_description, $tagArray);
    $og_image_path = $dogimg->file_path;

    $headTail = $headTail == null ? $destination->destination_name : $headTail;
    $pageHeading = "Top Universities/Colleges in " . $headTail;

    $data = compact('destination', 'rows', 'i', 'instTYpe', 'seg2', 'states', 'total', 'cities', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'destinations', 'levelListForFilter', 'categoryListForFilter', 'spcListForFilter', 'studyModes', 'curInstType', 'curLevel', 'curCat', 'curSpc', 'intakes', 'pageHeading', 'headTitle', 'headTail', 'npu', 'ppu');
    return view('front.universities')->with($data);
  }
  public function filterUniversity(Request $request, $filter)
  {
    if (!Str::contains($filter, '-universities')) {
      abort(404);
    }
    //return $filter;
    $destination_slug = $request->segment(1);
    $destination = Destination::where(['destination_slug' => $destination_slug])->firstOrFail();
    $destinationId = $destination->id;

    $curLevel = '';
    $curCat = '';
    $curSpc = '';
    $curInstType = '';
    $curState = '';
    $curCity = '';

    $filter_slug = str_replace('-universities', '', $filter);
    if ($filter_slug == '') {
      abort(404);
    }
    // Find in levels table
    $chkLevel = Level::where('slug', $filter_slug)->first();
    // Find in course_categories table
    $chkCategory = CourseCategory::where('category_slug', $filter_slug)->first();
    // Find in course_specializations table
    $chkSpecialization = CourseSpecialization::where('specialization_slug', $filter_slug)->first();

    $chkInstType = InstituteType::where('seo_title_slug', $filter_slug)->first();

    $chkState = University::where('destination_id', $destinationId)->where('state_slug', $filter_slug)->first();
    // $chkCity = University::where('destination_id', $destinationId)->where('city_slug', $filter_slug)->first();

    $headTitle = null;
    $headTail = null;
    // Check if any match is found
    if ($chkLevel !== null) {
      session()->put('FilterLevel', $chkLevel->id);
      $headTitle = $chkLevel->level;
    } elseif ($chkCategory !== null) {
      session()->put('FilterCategory', $chkCategory->id);
      $headTitle = $chkCategory->category_name;
    } elseif ($chkSpecialization !== null) {
      session()->put('FilterSpecialization', $chkSpecialization->id);
      $headTitle = $chkSpecialization->specialization_name;
    } elseif ($chkState !== null) {
      session()->put('FilterState', $filter_slug);
    }
    // elseif ($chkCity !== null) {
    //   session()->put('FilterCity', $filter_slug);
    // }
    elseif ($chkInstType !== null) {
      session()->put('FilterInstituteType', $chkInstType->id);
      $headTitle = $chkInstType->seo_title;
    } else {
      abort(404);
    }

    if (session()->has('FilterState')) {
      $headTail = unslugify(session()->get('FilterState'));
    }
    // if (session()->has('FilterCity')) {
    //   $headTail = unslugify(session()->get('FilterCity'));
    // }
    if (session()->has('FilterInstituteType')) {
      $curInstType = InstituteType::find(session()->get('FilterInstituteType'));
    }

    if (session()->has('FilterLevel')) {
      $curLevel = Level::find(session()->get('FilterLevel'));
    }
    if (session()->has('FilterCategory')) {
      $curCat = CourseCategory::find(session()->get('FilterCategory'));
    }
    if (session()->has('FilterSpecialization')) {
      $curSpc = CourseSpecialization::find(session()->get('FilterSpecialization'));
    }

    $request = new Request();
    $rows = UniversityList::universities($request, $destination);

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

    // GET DESTINATION FOR FILTER SIDEBAR
    $destinations = UniversityListFilters::destinations();

    // GET LEVEL FOR FILTER SIDEBAR
    $levelListForFilter = UniversityListFilters::level($destinationId);

    // GET CATEGORY FOR FILTER SIDEBAR
    $categoryListForFilter = UniversityListFilters::category($destinationId);

    // GET SPECIALIZATION FOR FILTER SIDEBAR
    $spcListForFilter = UniversityListFilters::specialization($destinationId);

    // GET INSTITUTE TYPE FOR FILTER SIDEBAR
    $instTYpe = UniversityListFilters::instituteType($destinationId);

    // GET STATES FOR FILTER SIDEBAR
    $states = UniversityListFilters::states($destinationId);

    // GET CITIES FOR FILTER SIDEBAR
    $cities = UniversityListFilters::cities($destinationId);

    // GET STUDY MODES FOR FILTER SIDEBAR
    $studyModes = StudyMode::orderBy('study_mode')->get();

    // GET INTAKES FOR FILTER SIDEBAR
    $intakes = Month::orderBy('month_number')->get();

    $page_url = url()->current();
    $wrdseo = ['url' => 'university-list'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();
    $dogimg = DefaultOgImage::default()->first();
    $title = 'universities';
    $d_name = $destination->destination_name;
    $site =  'educationmalaysia.in';

    $category = $curCat == '' ? '' : $curCat->category_name;
    $specialization = $curSpc == '' ? '' : $curSpc->specialization_name;
    $level = $curLevel == '' ? '' : $curLevel->level;
    $institute_type = $curInstType == '' ? '' : $curInstType->type;
    $state = session()->has('FilterState') ? unslugify(session()->get('FilterState')) : '';
    $city = session()->has('FilterCity') ? unslugify(session()->get('FilterCity')) : '';

    $tagArray = ['title' => $title, 'destination' => $d_name, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site, 'category' => $category, 'specialization' => $specialization, 'level' => $level, 'institute_type' => $institute_type, 'state' => $state, 'city' => $city, 'nou' => $total];

    $meta_title = replaceTag($dseo->meta_title, $tagArray);
    $meta_keyword = replaceTag($dseo->meta_keyword, $tagArray);
    $page_content = replaceTag($dseo->page_content, $tagArray);
    $meta_description = replaceTag($dseo->meta_description, $tagArray);
    $og_image_path = $dogimg->file_path;

    $finalTail = $headTail ?? $destination->destination_name;
    $pageHeading = "Top $headTitle Universities/Colleges in " . $finalTail;

    $data = compact('destination', 'rows', 'i', 'instTYpe', 'states', 'total', 'cities', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'destinations', 'levelListForFilter', 'categoryListForFilter', 'spcListForFilter', 'studyModes', 'curInstType', 'curLevel', 'curCat', 'curSpc', 'intakes', 'pageHeading', 'headTitle', 'npu', 'ppu');
    return view('front.universities')->with($data);
  }

  public function removeFilter(Request $request)
  {
    if ($request->value == 'FilterCategory') {
      session()->forget('FilterSpecialization');
    }

    session()->forget($request->value);

    if (session()->has('FilterSpecialization')) {
      $curSpc = CourseSpecialization::find(session()->get('FilterSpecialization'));
      $main = $curSpc->specialization_slug . '-universities';
    } else if (session()->has('FilterCategory')) {
      $curCat = CourseCategory::find(session()->get('FilterCategory'));
      $main = $curCat->category_slug . '-universities';
    } else if (session()->has('FilterLevel')) {
      $curLevel = Level::find(session()->get('FilterLevel'));
      $main = $curLevel->slug . '-universities';
    } else if (session()->has('FilterInstituteType')) {
      $curInstType = InstituteType::find(session()->get('FilterInstituteType'));
      $main = $curInstType->seo_title_slug . '-universities';
    } else if (session()->has('FilterCity')) {
      $city = slugify(session()->get('FilterCity'));
      $main = $city . '-universities';
    } else if (session()->has('FilterState')) {
      $city = slugify(session()->get('FilterState'));
      $main = $city . '-universities';
    } else {
      $main = $request->destination_slug . '-universities';
    }
    $url = $request->destination_slug . '/' . $main;
    return url($url);
  }
  public function removeAllFilter(Request $request)
  {
    session()->forget('FilterInstituteType');
    session()->forget('FilterState');
    session()->forget('FilterCity');
    session()->forget('FilterLevel');
    session()->forget('FilterCategory');
    session()->forget('FilterSpecialization');
  }
}
