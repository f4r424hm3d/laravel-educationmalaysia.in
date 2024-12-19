<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\DynamicPageSeo;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class OfferLandingPageFc extends Controller
{
  public function index()
  {
    $scholarships = Scholarship::website()->get();
    $data = compact('scholarships');
    return view('front.scholarships')->with($data);
  }
  public function PageDetail($slug, Request $request)
  {
    $uri = $request->segment(1);
    $countries = Country::orderBy('phonecode', 'asc')->where('phonecode', '!=', '0')->get();

    $scholarship = Scholarship::website()->where(['slug' => $slug])->firstOrFail();
    $scholarships = Scholarship::website()->where('id', '!=', $scholarship->id)->get();

    $page_url = url()->current();

    $wrdseo = ['url' => 'scholarship-detail-page'];
    $dseo = DynamicPageSeo::website()->where($wrdseo)->first();
    $title = $scholarship->title;
    $site =  'educationmalaysia.in';
    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $scholarship->meta_title == '' ? $dseo->meta_title : $scholarship->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $scholarship->meta_keyword == '' ? $dseo->meta_keyword : $scholarship->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $scholarship->page_content == '' ? $dseo->page_content : $scholarship->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $scholarship->meta_description == '' ? $dseo->meta_description : $scholarship->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $scholarship->content_image_path ?? $dseo->ogimgpath;

    $seo_rating = $scholarship->seo_rating == '0' ? '0' : $scholarship->seo_rating;

    $seoRatingSchema = true;

    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    $data = compact('scholarship', 'scholarships', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'seo_rating', 'seoRatingSchema', 'countries', 'captcha');
    return view('front.scholarship-detail')->with($data);
  }
}
