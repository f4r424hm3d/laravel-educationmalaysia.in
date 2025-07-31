<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\CourseSpecialization;
use App\Models\DynamicPageSeo;
use App\Models\StaticPageSeo;
use Illuminate\Http\Request;

class BlogApi extends Controller
{
  public function index(Request $request)
  {
    $blogs = Blog::with('getCategory')->select('id', 'category_id', 'headline', 'slug', 'thumbnail_path', 'created_at')->website()->orderBy('id', 'desc')->paginate(12);
    // Fetch SEO data for 'blog'
    $seo = StaticPageSeo::where('page', 'blog')->first();

    $site = url('/');
    $tagArray = [
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = isset($seo->meta_title) ? replaceTag($seo->meta_title, $tagArray) : '';
    $meta_keyword = isset($seo->meta_keyword) ? replaceTag($seo->meta_keyword, $tagArray) : '';
    $meta_description = isset($seo->meta_description) ? replaceTag($seo->meta_description, $tagArray) : '';
    $seo_rating = $seo->seo_rating ?? '';
    $og_image_path = $seo->ogimgpath ?? null;

    return response()->json([
      'status' => true,
      'blogs' => $blogs,
      'seo' => [
        'meta_title' => $meta_title,
        'meta_keyword' => $meta_keyword,
        'meta_description' => $meta_description,
        'seo_rating' => $seo_rating,
        'og_image_path' => $og_image_path
      ]
    ]);
  }
  public function blogByCategory($category_slug, Request $request)
  {
    $category = BlogCategory::select('id', 'category_name', 'category_slug')->website()->where('category_slug', $category_slug)->firstOrFail();
    $blogs = Blog::with('getCategory')->select('id', 'category_id', 'headline', 'slug', 'thumbnail_path', 'created_at')->where('category_id', $category->id)->website()->orderBy('id', 'desc')->paginate(12);

    $dseo = DynamicPageSeo::where('url', 'blog-by-category')->first();
    $title = $category->category_name;
    $site = DOMAIN;

    $tagArray = [
      'title' => $title,
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = replaceTag($category->meta_title ?: ($dseo->meta_title ?? ''), $tagArray);
    $meta_keyword = replaceTag($category->meta_keyword ?: ($dseo->meta_keyword ?? ''), $tagArray);
    $meta_description = replaceTag($category->meta_description ?: ($dseo->meta_description ?? ''), $tagArray);
    $og_image_path = $category->og_image_path ?? ($dseo->ogimgpath ?? '');

    return response()->json([
      'status' => true,
      'category' => $category,
      'blogs' => $blogs,
      'seo' => [
        'meta_title' => $meta_title,
        'meta_keyword' => $meta_keyword,
        'meta_description' => $meta_description,
        'og_image_path' => $og_image_path,
      ]
    ]);
  }
  public function detail($category_slug, $slug, Request $request)
  {
    $category = BlogCategory::website()->where('category_slug', $category_slug)->firstOrFail();

    preg_match('/\d+$/', $slug, $matches);
    $blog_id = $matches[0] ?? null;
    $updatedSlug = preg_replace('/-\d+$/', '', $slug);

    $blog = Blog::with([
      'author',
      'parentContents' => function ($query) {
        $query->select('id', 'title', 'slug', 'description', 'blog_id'); // fields from parentContents
      },
      'parentContents.childContents' => function ($query) {
        $query->select('id', 'parent_id', 'title', 'slug', 'description'); // only these fields from childContents
      }
    ])->select('id', 'headline', 'slug', 'thumbnail_path', 'created_at', 'updated_at', 'author_id', 'meta_title', 'meta_keyword', 'meta_description')->where('category_id', $category->id)->where('slug', $updatedSlug)->where('id', $blog_id)->firstOrFail();

    $relatedBlogs = Blog::select('id', 'headline', 'thumbnail_path', 'created_at')->website()->where('id', '!=', $blog->id)->orderBy('id', 'desc')->limit(12)->get();
    $categories = BlogCategory::select('id', 'category_name', 'slug')->website()->get();


    $dseo = DynamicPageSeo::where('url', 'blog-details')->first();

    $site = DOMAIN;

    $tagArray = [
      'title' => $blog->title,
      'category' => $category->category_name,
      'currentmonth' => date('M'),
      'currentyear' => date('Y'),
      'site' => $site
    ];

    $meta_title = replaceTag($blog->meta_title ?: ($dseo->meta_title ?? ''), $tagArray);
    $meta_keyword = replaceTag($blog->meta_keyword ?: ($dseo->meta_keyword ?? ''), $tagArray);
    $meta_description = replaceTag($blog->meta_description ?: ($dseo->meta_description ?? ''), $tagArray);
    $og_image_path = $blog->og_image_path ?: ($dseo->ogimgpath ?? '');

    $specializations = CourseSpecialization::whereHas('contents')->select('id', 'name', 'slug')->inRandomOrder()->limit(10)->get();

    return response()->json([
      'status' => true,
      'blog' => $blog,
      'related_blogs' => $relatedBlogs,
      'categories' => $categories,
      'specializations' => $specializations,
      'seo' => [
        'meta_title' => $meta_title,
        'meta_keyword' => $meta_keyword,
        'meta_description' => $meta_description,
        'og_image_path' => $og_image_path,
      ]
    ]);
  }
}
