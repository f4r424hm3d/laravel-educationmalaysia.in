<?php

namespace App\Http\Controllers\sitemap;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\CourseCategory;
use App\Models\CourseSpecialization;
use App\Models\Destination;
use App\Models\Exam;
use App\Models\ExamTab;
use App\Models\JobPage;
use App\Models\Service;
use App\Models\SitePage;
use App\Models\University;
use App\Models\UniversityProgram;
use App\Models\UniversityScholarship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
  public function sitemap(Request $request)
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $data = compact('utf');
    return response()->view('sm.sitemap', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }
  public function home(Request $request)
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $data = compact('utf');
    return response()->view('sm.home', $data)->header('Content-Type', 'text/xml');
  }
  public function exam(Request $request)
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $rows = Exam::all();
    $data = compact('utf', 'rows');
    return response()->view('sm.exam', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }
  public function services()
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $services = SitePage::all();
    $data = compact('utf', 'services');
    return response()->view('sm.service', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }
  public function selectuni(Request $request)
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $rows = Exam::all();
    $data = compact('utf', 'rows');
    return response()->view('sm.select-university', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }
  public function university(Request $request)
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $universities = University::where('status', 1)->get();
    $data = compact('utf', 'universities');
    return response()->view('sm.university', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }
  public function universityProgram(Request $request)
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $rows = UniversityProgram::where('status', 1)->get();
    $data = compact('utf', 'rows');
    return response()->view('sm.university-program', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }
  public function specialization(Request $request)
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $specializations = CourseSpecialization::select('id', 'name', 'slug', 'updated_at')->whereHas('contents')->groupBy('id')->orderBy('name', 'ASC')->get();
    $data = compact('utf', 'specializations');
    return response()->view('sm.specializations', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }
  public function courses(Request $request)
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $categories = CourseCategory::select('id', 'name', 'slug', 'updated_at')->whereHas('contents')->get();
    $data = compact('utf', 'categories');
    return response()->view('sm.course-categories', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }

  public function article(Request $request)
  {
    $categories = BlogCategory::all();
    $blogs = Blog::all();
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $data = compact('categories', 'blogs', 'utf');
    return response()->view('sm.blog', $data)->header('Content-Type', 'text/xml');
  }
  public function sitemapCourseLevel(Request $request)
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $rows = ['certificate', 'pre-university', 'diploma', 'under-graduate', 'post-graduate', 'phd'];
    $data = compact('utf', 'rows');
    return response()->view('sm.sitemap-course-level', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }
  public function sitemapCoursesInMalaysia()
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $levels = UniversityProgram::select('level', 'updated_at')->groupBy('level')->whereNotNull('level')->where('level', '!=', '')->get();
    $categories = CourseCategory::whereHas('programs')->select('slug', 'updated_at')->orderBy('name')->get();
    $specializations = CourseSpecialization::whereHas('programs')->select('slug', 'updated_at')->orderBy('name')->get();
    $data = compact('utf', 'levels', 'categories', 'specializations');
    return response()->view('sm.courses-in-malaysia', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }
}
