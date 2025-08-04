<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Country;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\Destination;
use App\Models\FaqCategory;
use App\Models\PageBanner;
use App\Models\PageContent;
use App\Models\StaticPageContent;
use App\Models\Testimonial;
use App\Models\University;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeFc extends Controller
{
  public function index(Request $request)
  {
    $blogs = Blog::limit(10)->get();
    $universities = University::inRandomOrder()->active()->homeview()->limit(12)->get();
    $universityRanks = University::inRandomOrder()->active()->homeview()->where(function ($query) {
      $query->whereNotNull('qs_rank')->where('qs_rank', '!=', '')
        ->orWhereNotNull('times_rank')->where('times_rank', '!=', '')
        ->orWhereNotNull('rank')->where('rank', '!=', '');
    })->limit(10)->get();

    $specializations = CourseSpecialization::inRandomOrder()->limit(20)->get();
    $specializationsWithContent = CourseSpecialization::inRandomOrder()->whereHas('contents')->limit(20)->get();
    $pageContent = PageContent::where('page_name', 'home')->first();
    $testimonials = Testimonial::limit(20)->active()->inRandomOrder()->get();
    $data = compact('blogs', 'universities', 'pageContent', 'specializations', 'specializationsWithContent', 'universityRanks', 'testimonials');
    return view('front.index')->with($data);
  }
  public function privacyPolicy(Request $request)
  {
    return view('front.privacy-policy');
  }
  public function termsConditions(Request $request)
  {
    return view('front.terms-conditions');
  }
  public function searchUniversity(Request $request)
  {
    $keyword = $request->keyword;
    $field = DB::table('universities')->where('status', 1)->where('name', 'LIKE', '%' . $keyword . '%')->get();
    if ($field->count()) {
      $output = '<ul class="sItemsUl"><li class="active">UNIVERSITIES</li>';
      foreach ($field as $row) {
        $output .= '<li><a href="' . $row->slug . '">' . $row->name . '</a></li>';
      }
      $output .= '</ul>';
    } else {
      $output = '<center>No Data Found</center>';
    }
    echo $output;
  }
  public function newPage(Request $request)
  {
    return view('front.new-page');
  }
  public function SelectUniversities(Request $request)
  {
    $banner = PageBanner::where('uri', 'select-university')->first();
    $pageContentTop = StaticPageContent::where(['page_name' => 'select-university', 'position' => 'top'])->first();
    $pageContentBottom = StaticPageContent::where(['page_name' => 'select-university', 'position' => 'bottom'])->first();
    $pageContentPrivate = StaticPageContent::where(['page_name' => 'select-university', 'position' => 'private-university'])->first();
    $pageContentPublic = StaticPageContent::where(['page_name' => 'select-university', 'position' => 'public-university'])->first();
    $pageContentForeign = StaticPageContent::where(['page_name' => 'select-university', 'position' => 'foreign-university'])->first();

    $data = compact('banner', 'pageContentTop', 'pageContentForeign', 'pageContentPublic', 'pageContentPrivate', 'pageContentBottom');
    return view('front.select-universities')->with($data);
  }
  public function whoWeAre(Request $request)
  {
    return view('front.about');
  }
  public function whatPeopleSay(Request $request)
  {
    $students = Testimonial::where('status', true)->where('user_type', 'student')->get();
    $guardians = Testimonial::where('status', true)->where('user_type', 'guardian')->get();
    $universities = Testimonial::where('status', true)->where('user_type', 'university')->get();
    $countries = Country::all();
    $data = compact('countries', 'students', 'guardians', 'universities');
    return view('front.what-people-say')->with($data);
  }
  public function SelectLevel(Request $request)
  {
    return view('front.select-level');
  }
  public function Courses(Request $request)
  {
    $page_name = $request->segment(2);
    $pageContent = PageContent::with('author')->where('website', site_var)->where('page_name', $page_name)->first();
    $level = strtoupper($page_name);
    $categories = CourseCategory::whereHas('programs', function ($query) use ($level) {
      $query->where('status', 1)
        ->where('level', $level)
        ->whereHas('university', function ($query) {
          $query->where('status', 1);
        });
    })->with('specializations', function ($query) use ($level) {
      $query->whereHas('universityPrograms', function ($query) use ($level) {
        $query->where('status', 1)->where('level', $level)->whereHas('university', function ($query) {
          $query->where('status', 1);
        });;
      })->orderBy('name');
    })->orderBy('name')->get();
    //printArray($pageContent);
    $data = compact('pageContent', 'categories', 'level');
    return view('front.courses')->with($data);
  }
  public function addTestimonial(Request $request)
  {
    // Validate input data
    $validatedData = $request->validate([
      'name' => 'required|string|regex:/^[a-zA-Z\s]+$/u|max:255',
      'email' => 'required|email|max:255|unique:testimonials,email',
      'user_type' => 'required|in:Student,Guardian,University',
      'country' => 'required|string|max:255',
      'review' => 'required|string|regex:/^[a-zA-Z0-9\s]+$/u|min:10',
    ]);

    // Prevent XSS by stripping HTML tags
    $validatedData['name'] = strip_tags($validatedData['name']);
    $validatedData['review'] = strip_tags($validatedData['review']);

    // Create and store the testimonial
    Testimonial::create($validatedData);

    return redirect()->back()->with('success', 'Testimonial submitted successfully!');
  }
}
