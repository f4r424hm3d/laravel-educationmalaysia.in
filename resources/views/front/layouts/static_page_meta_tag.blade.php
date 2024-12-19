@php
  use App\Models\StaticPageSeo;
  $page_url = url()->current();
  //$url = Request::segment(1) ?? 'home';
  $url = Request::path() == '/' ? 'home' : Request::path();
  //die();
  $seo = StaticPageSeo::where(['page' => $url])->first();
  $site = url('/');
  $tagArray = ['currentmonth' => date('M'), 'currentyear' => date('Y'), 'site' => $site];

  $meta_title = $seo->meta_title ?? '';
  $meta_title = replaceTag($meta_title, $tagArray);

  $meta_keyword = $seo->meta_keyword ?? '';
  $meta_keyword = replaceTag($meta_keyword, $tagArray);

  $meta_description = $seo->meta_description ?? '';
  $meta_description = replaceTag($meta_description, $tagArray);

  $page_content = $seo->page_content ?? '';
  $page_content = replaceTag($page_content, $tagArray);

  $seo_rating = $seo->seo_rating ?? '';
  $og_image_path = $seo->ogimgpath;
@endphp
@include('front.layouts.dynamic_page_meta_tag')
