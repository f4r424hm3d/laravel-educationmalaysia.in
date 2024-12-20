<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\DefaultOgImage;
use App\Models\DynamicPageSeo;
use App\Models\FeesAndDeadline;
use App\Models\University;
use App\Models\UniversityGallery;
use App\Models\UniversityOtherContent;
use App\Models\UniversityOverview;
use App\Models\UniversityVideoGallery;
use Illuminate\Http\Request;

class UniversityOtherTabFc extends Controller
{
  public function index($university_slug, Request $request)
  {
    $slug = $request->segment(1);
    $university = University::where(['slug' => $slug])->firstOrFail();
    $tab_slug = $request->segment(2);
    $universityTabContent = UniversityOtherContent::where(['university_id' => $university->id, 'tab_slug' => $tab_slug])->firstOrFail();
    $overview = UniversityOverview::where(['university_id' => $university->id])->get();
    $gallery = UniversityGallery::where(['university_id' => $university->id])->get();
    $video = UniversityVideoGallery::where(['university_id' => $university->id])->get();
    $feesandapp = FeesAndDeadline::where(['university_id' => $university->id])->get();
    $trendingUniversity = University::where(['destination_id' => $university->destination_id])->limit(10)->get();

    $page_url = url()->current();
    $wrdseo = ['url' => 'university-overview'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();
    $dogimg = DefaultOgImage::default()->first();

    $title = $universityTabContent->tab_name;
    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];
    $meta_title = $universityTabContent->meta_title == '' ? $dseo->meta_title : $universityTabContent->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);
    $meta_keyword = $universityTabContent->meta_keyword == '' ? $dseo->meta_keyword : $universityTabContent->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);
    $page_content = $universityTabContent->page_content == '' ? $dseo->page_content : $universityTabContent->page_content;
    $page_content = replaceTag($page_content, $tagArray);
    $meta_description = $universityTabContent->meta_description == '' ? $dseo->meta_description : $universityTabContent->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);
    $og_image_path = $dogimg->file_path;

    $data = compact('university', 'overview', 'gallery', 'video', 'trendingUniversity', 'feesandapp', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'universityTabContent');
    return view('front.university-other-content')->with($data);
  }
}
