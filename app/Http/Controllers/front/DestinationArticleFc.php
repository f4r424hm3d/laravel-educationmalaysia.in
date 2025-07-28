<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\DefaultOgImage;
use App\Models\Destination;
use App\Models\DestinationArticle;
use App\Models\DynamicPageSeo;
use App\Models\University;
use Illuminate\Http\Request;

class DestinationArticleFc extends Controller
{
  public function index(Request $request)
  {
    $articles = DestinationArticle::paginate(9)->withQueryString();
    $data = compact('articles');
    return view('front.articles')->with($data);
  }
  public function detailPage($destination_slug, $page_url, Request $request)
  {
    $destination = Destination::where('destination_slug', $destination_slug)->firstOrFail();
    $countries = Country::orderBy('phonecode', 'asc')->where('phonecode', '!=', '0')->get();
    $article = DestinationArticle::where('page_url', $page_url)->firstOrFail();
    $articles = DestinationArticle::where('id', '!=', $article->id)->limit(10)->get();
    // printArray($articles);
    // die;
    $trendingUniversity = University::active()->where(['destination_id' => $destination->id])->limit(10)->get();
    //$categories = BlogCategory::all();

    $page_url = url()->current();

    $wrdseo = ['url' => 'destination-article-detail-page'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();
    $dogimg = DefaultOgImage::default()->first();

    $sub_slug = $article->title;
    //$category = str_replace('-', ' ', $article->cate_slug);
    $site = DOMAIN;

    $tagArray = ['title' => $sub_slug, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $article->meta_title == '' ? $dseo->meta_title : $article->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $article->meta_keyword == '' ? $dseo->meta_keyword : $article->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $article->page_content == '' ? $dseo->page_content : $article->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $article->meta_description == '' ? $dseo->meta_description : $article->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $article->image_path == '' ? $dogimg->file_path : $article->image_path;

    $data = compact('articles', 'article', 'page_url', 'dseo', 'sub_slug', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path', 'countries', 'trendingUniversity', 'destination');
    return view('front.article-detail')->with($data);
  }
}
