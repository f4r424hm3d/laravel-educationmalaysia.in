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
use Illuminate\Support\Facades\File;

class ServiceFc extends Controller
{
  public function index(Request $request)
  {
    $services = Service::orderBy('page_name')->get();
    //printArray($services->toArray());
    $data = compact('services');
    return view('front.services')->with($data);
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

    $meta_title = $service->meta_title == '' ? $dseo->meta_title : $service->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $service->meta_keyword == '' ? $dseo->meta_keyword : $service->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $service->page_content == '' ? $dseo->page_content : $service->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $service->meta_description == '' ? $dseo->meta_description : $service->meta_description;
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
  public function transferSitePageDatam()
  {
    $sourceFolder = 'assets/uploadFiles/study/';
    $destinationFolder = 'uploads/services/';

    // Create destination folder if not exists
    if (!File::exists($destinationFolder)) {
      File::makeDirectory($destinationFolder, 0755, true);
    }

    $sitePages = Service::all();
    $updatedCount = 0;
    $movedCount = 0;

    foreach ($sitePages as $row) {
      if ($row->bannerpath) {
        $sourcePath = $sourceFolder . $row->bannerpath;
        $destinationPath = $destinationFolder . $row->bannerpath;

        // Move the file if it exists
        if (File::exists($sourcePath)) {
          if (!File::exists($destinationPath)) {
            File::move($sourcePath, $destinationPath);
            $movedCount++;
          }

          // Update banner_path in DB
          $row->banner_path = 'uploads/services/' . $row->bannerpath;
          $row->save();
          $updatedCount++;
        }
      }
    }

    return response()->json([
      'status' => true,
      'message' => 'Data transferred successfully!',
      'files_moved' => $movedCount,
      'records_updated' => $updatedCount,
    ]);
  }
  public function transferSitePageData()
  {
    $sourceFolder = 'assets/uploadFiles/study/';
    $destinationFolder = 'uploads/services/';

    // Create destination folder if not exists
    if (!File::exists($destinationFolder)) {
      File::makeDirectory($destinationFolder, 0755, true);
    }

    $sitePages = Service::all();
    $updatedCount = 0;
    $movedCount = 0;

    foreach ($sitePages as $row) {
      if ($row->bannerpath) {
        $sourcePath = $sourceFolder . $row->bannerpath;
        $destinationPath = $destinationFolder . $row->bannerpath;

        // Move the file if it exists
        if (File::exists($sourcePath)) {
          if (!File::exists($destinationPath)) {
            File::move($sourcePath, $destinationPath);
            $movedCount++;
          }

          // Update banner_path in DB
          $row->banner_path = 'uploads/services/' . $row->bannerpath;
          $row->save();
          $updatedCount++;
        }
      }
    }

    return response()->json([
      'status' => true,
      'message' => 'Data transferred successfully!',
      'files_moved' => $movedCount,
      'records_updated' => $updatedCount,
    ]);
  }
}
