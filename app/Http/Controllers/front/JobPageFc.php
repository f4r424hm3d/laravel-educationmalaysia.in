<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\DefaultOgImage;
use App\Models\DynamicPageSeo;
use App\Models\Exam;
use App\Models\JobPage;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class JobPageFc extends Controller
{
  public function index(Request $request)
  {
    $exams = Exam::where(['status' => 1])->limit(10)->get();
    $jobs = JobPage::where(['status' => 1])->get();
    $data = compact('jobs', 'exams');
    return view('front.jobs')->with($data);
  }
  public function detailPage(Request $request)
  {
    $testimonials = Testimonial::limit(10)->where('page', 'jobs')->get();
    $slug = $request->segment(1);
    $row = JobPage::where('page_slug', $slug)->first();
    $curJob = $row->page_name;
    $exams = Exam::where(['status' => 1])->limit(6)->get();
    $jobs = JobPage::where(['status' => 1])->where('page_slug', '!=', $slug)->get();
    $alljobs = JobPage::all();

    $page_url = url()->current();

    $wrdseo = ['url' => 'job-detail-page'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();
    $dogimg = DefaultOgImage::default()->first();

    $title = $row->title;
    $site =  'educationmalaysia.in';
    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $row->meta_title == '' ? $dseo->meta_title : $row->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $row->meta_keyword == '' ? $dseo->meta_keyword : $row->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $row->page_content == '' ? $dseo->page_content : $row->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $row->meta_description == '' ? $dseo->meta_description : $row->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $row->thumbnail_path ?? $dogimg->file_path;

    $question = generateMathQuestion();
    session(['captcha_answer' => $question['answer']]);

    $data = compact('jobs', 'row', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'exams', 'testimonials', 'alljobs', 'curJob', 'question');
    return view('front.job-detail')->with($data);
  }
}
