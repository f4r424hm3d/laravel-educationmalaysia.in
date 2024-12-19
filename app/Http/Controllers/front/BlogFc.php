<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\DefaultOgImage;
use App\Models\DynamicPageSeo;
use Illuminate\Http\Request;

class BlogFc extends Controller
{
  public function index(Request $request)
  {
    $blogs = Blog::website()->orderBy('id', 'desc')->paginate(12)->withQueryString();
    $data = compact('blogs');
    return view('front.blogs')->with($data);
  }
  public function blogByCategory($slug, Request $request)
  {
    $category = BlogCategory::website()->where('slug', $slug)->firstOrFail();
    $blogs = Blog::orderBy('id', 'desc')->where('cate_id', $category->id)->paginate(12)->withQueryString();

    $page_url = url()->current();

    $wrdseo = ['url' => 'blog-by-category'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();

    $title = $category->category_name;
    $site =  'educationmalaysia.in';
    $tagArray = ['title' => $title, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $category->meta_title == '' ? $dseo->meta_title : $category->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $category->meta_keyword == '' ? $dseo->meta_keyword : $category->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $category->page_content == '' ? $dseo->page_content : $category->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $category->meta_description == '' ? $dseo->meta_description : $category->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $category->imgpath ?? $dseo->ogimgpath;

    $data = compact('category', 'blogs', 'page_url', 'dseo', 'title', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path');
    return view('front.blog-by-category')->with($data);
  }
  public function detail($category_slug, $slug, Request $request)
  {
    $category = BlogCategory::website()->where('slug', $category_slug)->firstOrFail();

    preg_match('/\d+$/', $slug, $matches);
    $blog_id = $matches[0] ?? null;

    $blog = Blog::where('id', $blog_id)->firstOrFail();
    $blogs = Blog::website()->orderBy('id', 'desc')->where('id', '!=', $blog->id)->limit(12)->get();
    $categories = BlogCategory::website()->get();

    $page_url = url()->current();

    $wrdseo = ['url' => 'get-info'];
    $dseo = DynamicPageSeo::where($wrdseo)->first();

    $sub_slug = $blog->title;
    $category = str_replace('-', ' ', $blog->cate_slug);
    $site = 'educationmalaysia.in';

    $tagArray = ['title' => $sub_slug, 'category' => $category, 'currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

    $meta_title = $blog->meta_title == '' ? $dseo->meta_title : $blog->meta_title;
    $meta_title = replaceTag($meta_title, $tagArray);

    $meta_keyword = $blog->meta_keyword == '' ? $dseo->meta_keyword : $blog->meta_keyword;
    $meta_keyword = replaceTag($meta_keyword, $tagArray);

    $page_content = $blog->page_content == '' ? $dseo->page_content : $blog->page_content;
    $page_content = replaceTag($page_content, $tagArray);

    $meta_description = $blog->meta_description == '' ? $dseo->meta_description : $blog->meta_description;
    $meta_description = replaceTag($meta_description, $tagArray);

    $og_image_path = $blog->imgpath == '' ? $dseo->ogimgpath : $blog->imgpath;

    $data = compact('categories', 'blogs', 'blog', 'page_url', 'dseo', 'sub_slug', 'site', 'meta_title', 'meta_keyword', 'page_content', 'meta_description', 'og_image_path');
    return view('front.blog-detail')->with($data);
  }
}
