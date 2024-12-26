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
  $og_image_path = $seo->og_image_path ?? '';
@endphp

<meta name="robots" content="index, follow" />
<title>{{ ucwords($meta_title) }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta name="description" content="{{ $meta_description }}">
<meta name="keywords" content="{{ $meta_keyword }}">
<link rel="canonical" href="{{ $page_url }}" />
<link rel="shortcut icon" href="{{ asset('/front/') }}/assets/img/favicon.png" type="image/x-icon">
<link rel="apple-touch-icon" href="{{ asset('/front/') }}/assets/img/favicon.png" />
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
<meta property="og:site_name" content="Education Malaysia Education" />
<meta property="og:image" content="{{ url('front/assets/img/banner-2.jpg') }}" />
<meta property="og:url" content="{{ $page_url }}" />
<meta property="og:image:alt" content="{{ $page_content }}" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="Education Malaysia Education" />
<meta name="twitter:creator" content="@BritannicaOEdu" />
<meta name="twitter:url" content="{{ $page_url }}/" />
<meta name="twitter:title" content="{{ $meta_title }}" />
<meta name="twitter:description" content="{{ $meta_description }}" />
<meta name="twitter:image" content="{{ url('front/assets/img/banner-2.jpg') }}" />
<meta property="twitter:image:type" content="image/jpeg" />
<meta name="google-site-verification" content="SokbVdHyUAjOFBjbYT24LZso--Gh5GaYXY2TKUldJIY" />
<!-- CSS -->
<link href="{{ url('front/') }}/assets/css/styles.css" rel="stylesheet">
<link href="{{ url('front/') }}/assets/css/colors.css" rel="stylesheet">
<style>
  .hide-this {
    display: none;
  }
</style>
<style>
  .sItems {
    width: 100%;
    height: 118px;
    overflow: auto;
    top: 0px;
  }

  .sItems ul {}

  .sItems ul li {
    border-bottom: 1px solid #eee;
    text-align: left
  }

  .sItems ul li.active {
    font-size: 15px;
    text-align: left;
    padding: 8px 15px;
    display: block;
    background: #ff57221c;
    color: #da0b4e;
    text-transform: uppercase;
    font-weight: 600;
  }

  .sItems ul li a {
    padding: 8px 15px;
    display: block
  }

  .sItems ul li a:hover {
    background: #da0b4e;
    color: #fff
  }
</style>
