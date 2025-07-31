<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CourseSpecialization;
use App\Models\DefaultOgImage;
use App\Models\Destination;
use App\Models\DynamicPageSeo;
use App\Models\Exam;
use App\Models\ExamContent;
use App\Models\ExamFaq;
use App\Models\ExamTab;
use App\Models\ExamTabFaq;
use App\Models\StaticPageSeo;
use App\Models\University;
use Illuminate\Http\Request;

class ExamFc extends Controller
{
  public function index(Request $request)
  {
    $exams = Exam::where(['status' => 1])->website()->get();
    // Fetch SEO data for 'exams'
    $seo = StaticPageSeo::where('page', 'exams')->first();

    $site = url('/');
    $tagArray = [
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = isset($seo->meta_title) ? replaceTag($seo->meta_title, $tagArray) : '';
    $meta_keyword = isset($seo->meta_keyword) ? replaceTag($seo->meta_keyword, $tagArray) : '';
    $meta_description = isset($seo->meta_description) ? replaceTag($seo->meta_description, $tagArray) : '';
    $page_content = isset($seo->page_content) ? replaceTag($seo->page_content, $tagArray) : '';
    $seo_rating = $seo->seo_rating ?? '';
    $og_image_path = $seo->ogimgpath ?? null;
    $data = compact('exams', 'meta_title', 'meta_keyword', 'meta_description', 'page_content', 'seo_rating', 'og_image_path');
    return view('front.exams')->with($data);
  }
  public function examDetail($uri, Request $request)
  {
    $countries = Country::orderBy('name', 'ASC')->get();
    $phonecodes = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();

    $exam = Exam::website()->where(['status' => 1])->where('uri', $uri)->firstOrFail();

    $exams = Exam::website()->where(['status' => 1])->where('id', '!=', $exam->id)->get();

    $allExams = Exam::website()->where(['status' => 1])->get();

    $specializations = CourseSpecialization::inRandomOrder()->limit(10)->whereHas('contents')->get();
    $featuredUniversities = University::inRandomOrder()->active()->limit(10)->get();

    $page_url = url()->current();

    $wrdseo = ['url' => 'exam-single-page'];
    $dseo = DynamicPageSeo::website()->where($wrdseo)->first();
    $title = $exam->page_name;
    $headline = $exam->headline;
    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'headline' => $headline, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $exam->meta_title == '' ? $dseo->meta_title : $exam->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $exam->meta_keyword == '' ? $dseo->meta_keyword : $exam->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $exam->page_content == '' ? $dseo->page_content : $exam->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $exam->meta_description == '' ? $dseo->meta_description : $exam->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $exam->imgpath ?? $dseo->ogimgpath;

    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    $data = compact('exam', 'exams', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'countries', 'phonecodes', 'captcha', 'allExams', 'specializations', 'featuredUniversities');
    return view('front.exam-detail')->with($data);
  }
}
