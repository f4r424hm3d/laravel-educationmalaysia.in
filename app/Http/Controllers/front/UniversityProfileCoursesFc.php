<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\DynamicPageSeo;
use App\Models\Level;
use App\Models\Month;
use App\Models\StudyMode;
use App\Models\University;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;

class UniversityProfileCoursesFc extends Controller
{
  public function index($university_slug, Request $request)
  {
    $filter = $request->segment(3);
    $university = University::where(['uname' => $university_slug])->firstOrFail();
    $checkPrograms = UniversityProgram::where(['university_id' => $university->id, 'status' => 1])->count();
    if ($checkPrograms == 0) {
      abort(404);
    }
    $rows = UniversityProgram::where(['university_id' => $university->id, 'status' => 1]);

    if ($filter != 'courses') {
      $filter_slug = str_replace('-courses', '', $filter);

      // Find in levels table
      $chkLevel = Level::where('slug', strtoupper($filter_slug))->first();
      // Find in course_categories table
      $chkCategory = CourseCategory::where('slug', $filter_slug)->first();
      // Find in course_specializations table
      $chkSpecialization = CourseSpecialization::where('slug', $filter_slug)->first();

      // Check if any match is found
      if ($chkLevel !== null) {
        session()->put('UCF_level', $chkLevel->level);
      } elseif ($chkCategory !== null) {
        session()->put('UCF_course_category', $chkCategory->id);
      } elseif ($chkSpecialization !== null) {
        session()->put('UCF_specialization', $chkSpecialization->id);
      } else {
        abort(404);
      }
    }


    if (session()->has('UCF_level')) {
      $rows = $rows->where(['level' => session()->get('UCF_level')]);
      $filter_level = session()->get('UCF_level');
    } else {
      $filter_level = null;
    }
    if (session()->has('UCF_course_category')) {
      $rows = $rows->where(['course_category_id' => session()->get('UCF_course_category')]);
      $filter_category = CourseCategory::find(session()->get('UCF_course_category'));
    } else {
      $filter_category = null;
    }
    if (session()->has('UCF_specialization')) {
      $rows = $rows->where(['specialization_id' => session()->get('UCF_specialization')]);
      $filter_specialization = CourseSpecialization::find(session()->get('UCF_specialization'));
    } else {
      $filter_specialization = null;
    }
    if (session()->has('UCF_study_mode')) {
      //$rows = $rows->where(['specialization_id' => session()->get('UCF_specialization')]);
      $rows = $rows->whereJsonContains('study_mode', session()->get('UCF_study_mode'));
    }

    $rows = $rows->paginate(10)->withQueryString();

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

    $levels = UniversityProgram::select('level')->where(['university_id' => $university->id, 'status' => 1])->distinct()->get();

    $categories = UniversityProgram::select('course_category_id')->where(['university_id' => $university->id, 'status' => 1])->distinct();
    if (session()->has('UCF_level')) {
      $categories = $categories->where(['level' => session()->get('UCF_level')]);
    }
    $categories = $categories->get();

    $specializations = UniversityProgram::select('specialization_id')->where(['university_id' => $university->id, 'status' => 1])->distinct();
    if (session()->has('UCF_level')) {
      $specializations = $specializations->where(['level' => session()->get('UCF_level')]);
    }
    if (session()->has('UCF_course_category')) {
      $specializations = $specializations->where(['course_category_id' => session()->get('UCF_course_category')]);
    }
    $specializations = $specializations->get();

    $studyModes = StudyMode::all();
    $intakes = Month::all();

    $page_url = url()->current();

    $wrdseo = ['url' => 'university-course-list'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();

    $category = $filter_category == null ? '' : $filter_category->category_name;
    $specialization = $filter_specialization == '' ? '' : $filter_specialization->specialization_name;
    $level = $filter_level;
    $university_name = $university->name;

    $title = $university->name;
    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site, 'category' => $category, 'specialization' => $specialization, 'level' => $level, 'university' => $university_name, 'noc' => $total];

    $meta_title = $university->meta_title == '' ? $dseo->meta_title : $university->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $university->meta_keyword == '' ? $dseo->meta_keyword : $university->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $university->page_content == '' ? $dseo->page_content : $university->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $university->meta_description == '' ? $dseo->meta_description : $university->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $dseo->file_path ?? null;

    $breadcrumbCurrent = '<li class="facts-1">Courses</li>';

    $countries = Country::orderBy('name', 'ASC')->get();
    $phonecodes = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
    //$levels = Level::groupBy('level')->orderBy('level', 'ASC')->get();
    $course_categories = CourseCategory::orderBy('name', 'asc')->get();

    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    $data = compact('university', 'rows', 'i', 'levels', 'categories', 'specializations', 'studyModes', 'total', 'filter_level', 'filter_category', 'filter_specialization', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'breadcrumbCurrent', 'npu', 'ppu', 'countries', 'phonecodes', 'captcha', 'course_categories');
    return view('front.university-course-list')->with($data);
  }
  public function applyLevelFilter(Request $request)
  {
    session()->forget('UCF_course_category');
    session()->forget('UCF_specialization');
    session()->forget('UCF_study_mode');
    $level = $request->level;
    //$level = Level::where('level', $level)->first();
    $request->session()->put('UCF_level', $level);
    return slugify($level) . '-courses';
  }
  public function applyCategoryFilter(Request $request)
  {
    session()->forget('UCF_specialization');
    $course_category_id = $request->course_category_id;
    $category = CourseCategory::find($course_category_id);
    $request->session()->put('UCF_course_category', $course_category_id);
    return $category->category_slug . '-courses';
  }
  public function applySpecializationFilter(Request $request)
  {
    $specialization_id = $request->specialization_id;
    $specialization = CourseSpecialization::find($specialization_id);
    $request->session()->put('UCF_specialization', $specialization_id);
    $request->session()->put('UCF_course_category', $specialization->course_category_id);
    return $specialization->slug . '-courses';
  }
  public function applyFilter(Request $request)
  {
    $request->session()->put($request->col, $request->val);
  }

  public function removeFilter(Request $request)
  {
    session()->forget($request->value);
  }
  public function removeAllFilter(Request $request)
  {
    session()->forget('UCF_level');
    session()->forget('UCF_course_category');
    session()->forget('UCF_specialization');
    session()->forget('UCF_study_mode');
  }


  public function courseDetail($university_slug, $program_slug, Request $request)
  {
    $university = University::where(['uname' => $university_slug])->firstOrFail();
    $trendingUniversity = University::limit(10)->get();

    $program = UniversityProgram::where(['university_id' => $university->id, 'slug' => $program_slug])->firstOrFail();
    // printArray($program);
    // die;
    $path = implode('/', $request->segments());

    $page_url = url()->current();

    $wrdseo = ['url' => 'university-course-detail'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();

    $breadcrumbCurrent = '<li class="facts-1">' . $program->course_name . '</li>';
    $title = $program->course_name;
    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'universityname' => $university->name, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $program->meta_title == '' ? $dseo->meta_title : $program->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $program->meta_keyword == '' ? $dseo->meta_keyword : $program->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $program->page_content == '' ? $dseo->page_content : $program->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $program->meta_description == '' ? $dseo->meta_description : $program->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $dseo->ogimgpath ?? null;

    $months = Month::orderBy('id', 'ASC')->get();

    $countries = Country::orderBy('name', 'ASC')->get();
    $phonecodes = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
    $levels = Level::groupBy('level')->orderBy('level', 'ASC')->get();
    $course_categories = CourseCategory::orderBy('name', 'asc')->get();

    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    $universtySpecializationsForCourses = CourseSpecialization::inRandomOrder()->whereHas('programs', function ($query) use ($university) {
      $query->where('university_id', $university->id);
    })->limit(15)->get();

    $randomSpecializations = CourseSpecialization::inRandomOrder()->whereHas('programs', function ($query) use ($university) {
      $query->where('status', 1);
    })->limit(15)->get();

    $specializationsWithContents = CourseSpecialization::inRandomOrder()->whereHas('contents')->limit(15)->get();

    $similarPrograms = UniversityProgram::inRandomOrder()->where('level', $program->level)->where('specialization_id', $program->specialization_id)->where('id', '!=', $program->id)->limit(10)->where('slug', '!=', '')->whereNotNull('slug')->where('status', 1)->get();

    $data = compact('program', 'university', 'trendingUniversity', 'path', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'months', 'breadcrumbCurrent', 'countries', 'phonecodes', 'captcha', 'levels', 'course_categories', 'universtySpecializationsForCourses', 'randomSpecializations', 'specializationsWithContents', 'similarPrograms');
    return view('front.programs-profile')->with($data);
  }
}
