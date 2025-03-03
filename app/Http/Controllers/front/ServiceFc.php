<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CourseSpecialization;
use App\Models\DefaultOgImage;
use App\Models\Destination;
use App\Models\DynamicPageSeo;
use App\Models\Service;
use App\Models\ServiceContent;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade
use Illuminate\Support\Carbon;

class ServiceFc extends Controller
{
  public function index(Request $request)
  {
    $services = Service::orderBy('page_name')->get();
    //printArray($services->toArray());
    $data = compact('services');
    return view('front.services')->with($data);
  }
  public function transferSitePageData()
  {
    // Fetch all rows from the `site_pages` table
    $sitePages = DB::table('site_pages')->get();

    // Prepare an array to store the data to be inserted into `site_page_tabs`
    $insertData = [];

    // Loop through each row of `site_pages`
    foreach ($sitePages as $page) {
      // Map h1, h2, ..., h5 and p1, p2, ..., p5 to tab_title and tab_content
      for ($i = 1; $i <= 5; $i++) {
        $heading = $page->{'h' . $i};  // h1, h2, h3, etc.
        $paragraph = $page->{'p' . $i}; // p1, p2, p3, etc.

        // Only insert if both heading and paragraph are not empty
        if (!empty($heading) && !empty($paragraph)) {
          $insertData[] = [
            'page_id'      => $page->id, // ID from the `site_pages` table
            'tab_title'    => $heading, // Heading as tab title
            'tab_content'  => $paragraph, // Paragraph as tab content
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now()
          ];
        }
      }
    }

    // Insert data into `site_page_tabs`
    if (!empty($insertData)) {
      DB::table('site_page_tabs')->insert($insertData);
    }

    // Return success message
    return response()->json(['message' => 'Data transferred successfully!']);
  }
  public function serviceDetail($slug, Request $request)
  {
    $service = Service::website()->where('uri', $slug)->firstOrFail();
    $services = Service::website()->where('id', '!=', $service->id)->get();
    $allServices = Service::website()->get();
    $countries = Country::orderBy('name', 'ASC')->get();
    $phonecodes = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();

    $page_url = url()->current();

    $wrdseo = ['url' => 'servicesinglepage'];
    $dseo = DynamicPageSeo::website()->where($wrdseo)->first();
    $title = $service->page;
    $headline = $service->headline;
    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'headline' => $headline, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $service->meta_title == '' ? $dseo->title : $service->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $service->meta_keyword == '' ? $dseo->keyword : $service->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $service->page_content == '' ? $dseo->page_content : $service->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $service->meta_description == '' ? $dseo->description : $service->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $service->ogimgpath ?? $dseo->ogimgpath;

    $seo_rating = $service->seo_rating == '0' ? '0' : $service->seo_rating;

    $seoRatingSchema = true;

    $captcha = generateMathQuestion();
    session(['captcha_answer' => $captcha['answer']]);

    $source = 'Service Page';

    $specializations = CourseSpecialization::inRandomOrder()->limit(10)->whereHas('contents')->get();

    $featuredUniversities = University::inRandomOrder()->active()->limit(10)->get();

    $data = compact('services', 'service', 'allServices', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'seo_rating', 'seoRatingSchema', 'countries', 'phonecodes', 'captcha', 'source', 'specializations', 'featuredUniversities');
    return view('front.service-detail')->with($data);
  }
}
