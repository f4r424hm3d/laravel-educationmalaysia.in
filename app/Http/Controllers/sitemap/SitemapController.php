<?php

namespace App\Http\Controllers\sitemap;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Destination;
use App\Models\Exam;
use App\Models\ExamTab;
use App\Models\JobPage;
use App\Models\Service;
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
  public function article(Request $request)
  {
    $categories = BlogCategory::all();
    $blogs = Blog::all();
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $data = compact('categories', 'blogs', 'utf');
    return response()->view('sm.blog', $data)->header('Content-Type', 'text/xml');
  }

  public function destination(Request $request)
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $destinations = Destination::where('status', 1)->get();
    $data = compact('utf', 'destinations');
    return response()->view('sm.destination', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }

  public function university(Request $request)
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $universities = University::where('status', 1)->get();
    $data = compact('utf', 'universities');
    return response()->view('sm.university', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }

  public function exam(Request $request)
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $rows = ExamTab::all();
    $data = compact('utf', 'rows');
    return response()->view('sm.exam', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }


  public function services()
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $services = Service::where('status', 1)->get();
    $data = compact('utf', 'services');
    return response()->view('sm.service', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }

  public function jobs()
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $jobs = JobPage::where('status', 1)->get();
    $data = compact('utf', 'jobs');
    return response()->view('sm.jobs', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }

  public function teams()
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $teams = User::orderBy('priority')->employees()->get();
    $data = compact('utf', 'teams');
    return response()->view('sm.team', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }

  public function articles()
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $blogs = Blog::where('status', 1)->get();
    $categories = BlogCategory::where('status', 1)->get();
    $data = compact('utf', 'blogs', 'categories');
    return response()->view('sm.blog', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }

  public function universityCourses()
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $universities = University::where('status', 1)->get();
    $programs = UniversityProgram::where('status', 1)->get();
    $data = compact('utf', 'programs', 'universities');
    return response()->view('sm.universityCourses', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }
  public function universityList()
  {
    $utf = '<?xml version="1.0" encoding="UTF-8"?>';
    $destinationsUniversities = University::whereHas('getPrograms', function ($query) {
      $query->whereExists(function ($subQuery) {
        $subQuery->select('id')->from('university_programs')->whereColumn('university_id', 'universities.id');
      });
    })->where('status', 1)->select('destination_id')->groupBy('destination_id')->get();
    $data = compact('utf', 'destinationsUniversities');
    return response()->view('sm.university-list', $data)->header('Content-Type', 'application/xml; charset=utf-8');
  }

  // public function universityScholarships()
  // {
  //   $scholarships = UniversityScholarship::get();
  //   $data = compact('utf', 'scholarships');
  //   return response()->view('sm.universityScholarships', $data);
  // }
}
