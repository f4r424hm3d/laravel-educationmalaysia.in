<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\DefaultOgImage;
use App\Models\Destination;
use App\Models\DynamicPageSeo;
use App\Models\InstituteType;
use App\Models\Level;
use App\Models\Month;
use App\Models\StudyMode;
use App\Models\University;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;

class UniversityListFc extends Controller
{
  public function index(Request $request)
  {
    $currentInstituteType = '';
    $currentState = '';

    $query = University::query()->active();
    if (session()->has('FilterInstituteType')) {
      $instituteType = InstituteType::where('seo_title_slug', session()->get('FilterInstituteType'))->firstOrFail();
      $currentInstituteType = $instituteType->type;
      $query->where('institute_type', $instituteType->id);
    }
    if (session()->has('FilterState')) {
      $query->where('state', session()->get('FilterState'));
      $currentState = session()->get('FilterState');
    }

    $rows = $query->paginate(20);

    //die;

    $total = $rows->total();
    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;

    $instituteTypes = University::select('institute_type')->where(['status' => 1])->where('institute_type', '!=', null)->groupBy('institute_type')->get();

    $states = University::select('state')->where(['status' => 1])->where('state', '!=', '')->distinct();
    if (session()->has('FilterInstituteType')) {
      $states = $states->where('institute_type', $instituteType->id);
    }
    $states = $states->get();

    // printArray($states->toArray());
    // die;

    $studyModes = StudyMode::orderBy('study_mode')->get();
    $intakes = Month::orderBy('id')->get();

    $page_url = url()->current();
    $wrdseo = ['url' => 'universities-in-malaysia'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();
    $dogimg = DefaultOgImage::default()->first();

    $title = 'universities';
    $site =  DOMAIN;

    $institute_type = $currentInstituteType;

    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site, 'institute_type' => $institute_type];
    $meta_title = replaceTag($dseo->meta_title, $tagArray);
    $meta_keyword = replaceTag($dseo->meta_keyword, $tagArray);
    $page_content = replaceTag($dseo->page_content, $tagArray);
    $meta_description = replaceTag($dseo->meta_description, $tagArray);
    $og_image_path = $dogimg->file_path ?? null;

    $pageHeading = "Top Universities/Colleges in Malaysia";

    $data = compact('rows', 'i', 'instituteTypes', 'states', 'total', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path',  'studyModes', 'intakes', 'currentInstituteType', 'currentState');
    return view('front.universities')->with($data);
  }
  public function filterUniversity(Request $request, $filter)
  {
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

    // Find in levels table
    $chkLevel = Level::where('slug', $filter_slug)->first();
    // Find in course_categories table
    $chkCategory = CourseCategory::where('category_slug', $filter_slug)->first();
    // Find in course_specializations table
    $chkSpecialization = CourseSpecialization::where('specialization_slug', $filter_slug)->first();

    $chkInstType = InstituteType::where('seo_title_slug', $filter_slug)->first();

    $chkState = University::where('state_slug', $filter_slug)->first();
    $chkCity = University::where('city_slug', $filter_slug)->first();

    // Check if any match is found
    if ($chkLevel !== null) {
      // Match found in levels table
      session()->put('FilterLevel', $chkLevel->id);
    } elseif ($chkCategory !== null) {
      // Match found in course_categories table
      session()->put('FilterCategory', $chkCategory->id);
    } elseif ($chkSpecialization !== null) {
      // Match found in course_specializations table
      session()->put('FilterSpecialization', $chkSpecialization->id);
    } elseif ($chkState !== null) {
      // Match found in course_specializations table
      session()->put('FilterState', $filter_slug);
    } elseif ($chkCity !== null) {
      // Match found in course_specializations table
      session()->put('FilterCity', $filter_slug);
    } elseif ($chkInstType !== null) {
      // Match found in course_specializations table
      session()->put('FilterInstituteType', $chkInstType->id);
    } else {
      abort(404);
    }


    $query = University::query();

    $query->where('destination_id', $destination->id);

    if (session()->has('FilterState')) {
      $query->where('state_slug', session()->get('FilterState'));
    }
    if (session()->has('FilterCity')) {
      $query->where('city_slug', session()->get('FilterCity'));
    }
    if (session()->has('FilterInstituteType')) {
      $query->where('institute_type_id', session()->get('FilterInstituteType'));
      $curInstType = InstituteType::find(session()->get('FilterInstituteType'));
    }

    if (session()->has('FilterLevel')) {
      $query->whereHas('getPrograms', function ($subQuery) {
        $subQuery->where('level_id', session()->get('FilterLevel'));
      });
      $curLevel = Level::find(session()->get('FilterLevel'));
    }
    if (session()->has('FilterCategory')) {
      $query->whereHas('getPrograms', function ($subQuery) {
        $subQuery->where('course_category_id', session()->get('FilterCategory'));
      });
      $curCat = CourseCategory::find(session()->get('FilterCategory'));
    }
    if (session()->has('FilterSpecialization')) {
      $query->whereHas('getPrograms', function ($subQuery) {
        $subQuery->where('specialization_id', session()->get('FilterSpecialization'));
      });
      $curSpc = CourseSpecialization::find(session()->get('FilterSpecialization'));
    }
    if ($request->has('study_mode')) {
      $query->whereHas('getPrograms', function ($subQuery) use ($request) {
        $subQuery->whereJsonContains('study_mode', $request->study_mode);
      });
    }
    if ($request->has('intake')) {
      $query->whereHas('getPrograms', function ($subQuery) use ($request) {
        $subQuery->whereJsonContains('intake', $request->intake);
      });
    }

    $rows = $query->paginate(20);

    $total = $rows->total();
    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;

    $destinations = University::whereHas('getPrograms', function ($query) {
      $query->whereExists(function ($subQuery) {
        $subQuery->select('id')->from('university_programs')->whereColumn('university_id', 'universities.id');
      });
    })->where('status', 1)->select('destination_id')->groupBy('destination_id')->get();

    $levelListForFilter = UniversityProgram::whereHas('getUniversity', function ($query) use ($destinationId) {
      $query->where('destination_id', $destinationId);
    })->select('level_id')->groupBy('level_id')->get();

    $categoryListForFilter = UniversityProgram::whereHas('getUniversity', function ($query) use ($destinationId) {
      $query->where('destination_id', $destinationId);
    })->select('course_category_id')->groupBy('course_category_id');
    if (session()->has('FilterLevel')) {
      $categoryListForFilter = $categoryListForFilter->where(['level_id' => session()->get('FilterLevel')]);
    }
    $categoryListForFilter = $categoryListForFilter->get();

    $spcListForFilter = UniversityProgram::whereHas('getUniversity', function ($query) use ($destinationId) {
      $query->where('destination_id', $destinationId);
    })->select('specialization_id')->groupBy('specialization_id');
    if (session()->has('FilterLevel')) {
      $spcListForFilter = $spcListForFilter->where(['level_id' => session()->get('FilterLevel')]);
    }
    if (session()->has('FilterCategory')) {
      $spcListForFilter = $spcListForFilter->where(['course_category_id' => session()->get('FilterCategory')]);
    }
    $spcListForFilter = $spcListForFilter->get();

    // printArray($levelListForFilter->toArray());
    // die;

    $instTYpe = University::select('institute_type_id')->where(['destination_id' => $destination->id, 'status' => 1])->where('institute_type_id', '!=', null)->groupBy('institute_type_id')->get();

    $states = University::select('state', 'state_slug')->where(['destination_id' => $destination->id, 'status' => 1])->where('state', '!=', null)->distinct()->get();

    $cities = University::select('city', 'city_slug')->where(['destination_id' => $destination->id, 'status' => 1])->where('city', '!=', null)->distinct();
    if (session()->has('FilterState')) {
      $cities = $cities->where(['state_slug' => session()->get('FilterState')]);
    }
    $cities = $cities->get();

    $studyModes = StudyMode::orderBy('study_mode')->get();
    $intakes = Month::orderBy('month_number')->get();

    $page_url = url()->current();
    $wrdseo = ['url' => 'university-list'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();
    $dogimg = DefaultOgImage::default()->first();

    $title = 'universities';
    $d_name = $destination->destination_name;
    $site =  DOMAIN;

    $category = $curCat == '' ? '' : $curCat->category_name;
    $specialization = $curSpc == '' ? '' : $curSpc->specialization_name;
    $level = $curLevel == '' ? '' : $curLevel->level;
    $institute_type = $curInstType == '' ? '' : $curInstType->type;

    $tagArray = ['title' => $title, 'destination' => $d_name, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site, 'category' => $category, 'specialization' => $specialization, 'level' => $level, 'institute_type' => $institute_type];

    $meta_title = replaceTag($dseo->meta_title, $tagArray);
    $meta_keyword = replaceTag($dseo->meta_keyword, $tagArray);
    $page_content = replaceTag($dseo->page_content, $tagArray);
    $meta_description = replaceTag($dseo->meta_description, $tagArray);
    $og_image_path = $dogimg->file_path;

    $data = compact('destination', 'rows', 'i', 'instTYpe', 'states', 'total', 'cities', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'destinations', 'levelListForFilter', 'categoryListForFilter', 'spcListForFilter', 'studyModes', 'curInstType', 'curLevel', 'curCat', 'curSpc', 'intakes');
    return view('front.universities')->with($data);
  }
  public function applyFilter(Request $request)
  {
    $col = $request->col;
    $val = $request->val;
    if ($val != '') {
      $request->session()->put($col, $val);
    }
    if (session()->has('FilterState') && session()->has('FilterInstituteType')) {
      $path = url(session()->get('FilterInstituteType') . '-in-' . slugify(session()->get('FilterState')));
    } else if (session()->has('FilterInstituteType')) {
      $path = url(session()->get('FilterInstituteType') . '-in-malaysia');
    } else if (session()->has('FilterState')) {
      $path = url('universities-in-' . slugify(session()->get('FilterState')));
    } else {
      $path = url('universities-in-malaysia');
    }
    echo $path;
  }

  public function removeFilter(Request $request)
  {
    session()->forget($request->value);
    if (session()->has('FilterState') && session()->has('FilterInstituteType')) {
      $path = url(session()->get('FilterInstituteType') . '-in-' . slugify(session()->get('FilterState')));
    } else if (session()->has('FilterInstituteType')) {
      $path = url(session()->get('FilterInstituteType') . '-in-malaysia');
    } else if (session()->has('FilterState')) {
      $path = url('universities-in-' . slugify(session()->get('FilterState')));
    } else {
      $path = url('universities-in-malaysia');
    }
    echo $path;
  }
  public function removeAllFilter(Request $request)
  {
    session()->forget('FilterInstituteType');
    session()->forget('FilterState');
  }
}
