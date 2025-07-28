<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\DefaultOgImage;
use App\Models\Destination;
use App\Models\DestinationArticle;
use App\Models\DestinationFaq;
use App\Models\DynamicPageSeo;
use App\Models\University;
use App\Models\UniversityProgram;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DestinationFc extends Controller
{
  public function destinationList(Request $request)
  {
    DB::enableQueryLog();

    $destinations = University::select('destination_id')->whereHas('getPrograms')->active()->where('destination_id', '!=', null)->where('state', '!=', null)->where('city', '!=', null)->groupBy('destination_id')->limit(20)->get();

    $statesAndCities = [];

    foreach ($destinations as $destination) {
      $states = University::select('state', 'state_slug')
        ->whereHas('getPrograms')
        ->where(['status' => 1, 'destination_id' => $destination->destination_id])
        ->where('state', '!=', null)
        ->groupBy('state')
        ->get();

      $cities = University::select('city', 'city_slug')
        ->whereHas('getPrograms')
        ->where(['status' => 1, 'destination_id' => $destination->destination_id])
        ->where('city', '!=', null)
        ->groupBy('city')
        ->get();

      $statesAndCities[$destination->destination_id] = [
        'states' => $states,
        'cities' => $cities
      ];
    }

    $data = compact('destinations', 'statesAndCities');
    return view('front.destination-list')->with($data);
  }
  public function index(Request $request)
  {
    $destination_slug = $request->segment(1);
    $destinations = Destination::where(['status' => 1])->where('destination_slug', '!=', $destination_slug)->limit(10)->get();
    $destination = Destination::where(['destination_slug' => $destination_slug])->firstOrFail();

    $destinationArticles = DestinationArticle::orderBy('id', 'desc')->where(['destination_id' => $destination->id])->limit(20)->get();

    $faqs = DestinationFaq::where('destination_id', $destination->id)->get();

    //$states = University::where('destination_id', $destination->id)->where('status', 1)->where('state', '!=', '')->groupBy('state')->get();
    $states = University::where('destination_id', $destination->id)->where('status', 1)->where('state', '!=', '')->whereHas('getPrograms')->groupBy('state')->get();



    $universities = University::inRandomOrder()->where('destination_id', $destination->id)->where('status', 1)->whereHas('getPrograms')->limit(12)->get();

    $query = UniversityProgram::query();
    $query->groupBy('course_category_id');
    $query->whereHas('getUniversity', function ($subQuery) use ($destination) {
      $subQuery->where('destination_id', $destination->id);
    });
    $query->whereHas('getUniversity', function ($subQuery) use ($destination) {
      $subQuery->where('status', 1);
    });
    $categories = $query->get();

    $counsellors = User::where('role', 'counsellor')->get();

    $page_url = url()->current();

    $wrdseo = ['url' => 'destination-single-page'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();
    $dogimg = DefaultOgImage::default()->first();

    $title = $destination->destination_name;
    $site =  DOMAIN;
    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $destination->meta_title == '' ? $dseo->meta_title : $destination->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $destination->meta_keyword == '' ? $dseo->meta_keyword : $destination->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $destination->page_content == '' ? $dseo->page_content : $destination->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $destination->meta_description == '' ? $dseo->meta_description : $destination->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $destination->og_img_path ?? $dogimg->file_path;

    $blogs = Blog::limit(9)->orderBy('id', 'desc')->get();

    $data = compact('destination', 'destinations', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'faqs', 'states', 'universities', 'blogs', 'destinationArticles', 'categories', 'counsellors');
    return view('front.destination')->with($data);
  }
}
