@php
  use App\Models\Exam;
  use App\Models\SitePage;
  $exams = Exam::where('hview', 1)
      ->where('website', site_var)
      ->inRandomOrder()
      ->limit(4)
      ->get();
  $sitePages = SitePage::where('hview', 1)
      ->inRandomOrder() // Fetch data in RANDOM order
      ->limit(4) // Limit to 4 results
      ->get();
  //printArray($sitePages->toArray());
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <!--Meta Tag Seo-->
  @stack('seo_meta_tag')
  @stack('pagination_tag')
  <!-- CSS -->
  <!-- slick slider  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
  <!-- slick slider end  -->

  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <link href="{{ url('front/') }}/assets/css/styles.css" rel="stylesheet">
  <link rel="preload" href="{{ url('front/') }}/assets/css/colors.css" as="style"
    onload="this.onload=null;this.rel='stylesheet'">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .hide-this {
      display: none;
    }
  </style>

  <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "inLanguage": "en-US",
        "name": "<?php echo $meta_title; ?>",
        "description": "<?php echo $meta_description; ?>",
        "url": "<?php echo $fullurl; ?>",
        "publisher": {
            "@type": "Organization",
            "name": "Education Malaysia",
            "logo": {
                "@type": "ImageObject",
                "url": "https://www.educationmalaysia.in/assets/web/images/education-malaysia-new-logo.png",
                "width": "230",
                "height": "55"
            }
        }
    }
  </script>
  <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "EducationMalaysia",
        "url": "https://www.educationmalaysia.in/",
        "logo": "https://www.educationmalaysia.in/assets/web/images/education-malaysia-new-logo.png",
        "image": "https://www.educationmalaysia.in/assets/web/images/education-malaysia-new-logo.png",
        "sameAs": ["https://www.facebook.com/educationmalaysia.in", "https://www.pinterest.com/educationmalaysiain/",
            "https://twitter.com/educatemalaysia/", "https://www.instagram.com/educationmalaysia.in/", "https://www.quora.com/profile/Education-Malaysia-3", "https://www.linkedin.com/company/educationmalaysia/", "https://www.youtube.com/channel/UCK7S9yvQnx08CgcDMMfYAyg"
        ],
        "contactPoint": [{
            "@type": "ContactPoint",
            "telephone": "+91 9818560331",
            "contactType": "customer support"
        }]
    }
  </script>
  <!-- Favicons-->
  @stack('breadcrumb_schema')
  <style>
    .hide-this {
      display: none;
    }

    .sItems ul li a,
    .sItems ul li.active {
      padding: 8px 15px;
      display: block
    }

    .sItems {
      width: 100%;
      height: 118px;
      overflow: auto;
      top: 0
    }

    .sItems ul li {
      border-bottom: 1px solid #eee
    }

    .sItems ul li.active {
      font-size: 15px;
      text-align: left;
      background: #ff57221c;
      color: #000000;
      text-transform: uppercase;
      font-weight: 600
    }

    .sItems ul li a:hover {
      background: #000000;
      color: #ffffff
    }
  </style>
</head>

<body class="red-skin">
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WP578P4K" height="0" width="0"
      style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <div id="main-wrapper">
    <!-- Top header-->
    <div class="header header-light head-shadow py-2">
      <div class="container">
        <nav id="navigation" class="navigation navigation-landscape new-navigatoins">
          <div class="nav-header">
            <a class="nav-brand" href="{{ url('/') }}"><img src="{{ url('front/') }}/assets/img/logo.png"
                class="logo" alt="Education Malaysia Education Logo" /></a>
            <div class="nav-toggle"></div>
          </div>
          <div class="nav-menus-wrapper" style="transition-property: none;">
            <ul class="nav-menu nav-menu-social align-to-right">
              @if (session()->has('studentLoggedIn'))
                <li class="login_click light"><a href="{{ url('/student/profile/') }}">Profile</a></li>
              @else
                <li class="login_click light"><a href="{{ url('/') }}/sign-in">Login</a></li>
              @endif
            </ul>
            <ul class="nav-menu align-to-right">
              <li><a href="{{ route('home') }}">Home</a></li>
              <li class="mega-dropdown"><a href="#">Resources<span class="submenu-indicator"></span></a>
                <ul class="nav-dropdown nav-submenu mega-dropdown-menu new-width">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="b-font">Exams</div>
                      <ul class="li_dd">
                        <li><a href="{{ url('exams') }}">English Exams</a></li>
                        @foreach ($exams as $exam)
                          <li><a href="{{ url($exam->uri) }}">{{ ucfirst($exam->page_name) }}</a></li>
                        @endforeach
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <div class="b-font">Services</div>
                      <ul class="li_dd">
                        <li><a href="{{ url('services') }}">Our Services</a></li>
                        @foreach ($sitePages as $page)
                          <li><a href="{{ url($page->uri) }}">{{ ucfirst($page->page_name) }}</a></li>
                        @endforeach
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <div class="b-font">About Us</div>
                      <ul class="li_dd">
                        <li><a href="{{ route('wwa') }}">Who we are</a></li>
                        <li><a href="{{ route('wps') }}" target="_blank">What Students Say</a></li>
                        <li><a href="{{ route('select.level') }}" target="_blank">Study Malaysia</a></li>
                        <li><a href="{{ url('why-study-in-malaysia') }}">Why Study In Malaysia?</a></li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <img src="{{ asset('assets/web/images/em-menu2.jpg') }}" class="em-menus" alt="">
                    </div>
                  </div>
                </ul>
              </li>

              <li><a href="{{ url('courses-in-malaysia') }}">Search Courses</a></li>
              <li><a href="{{ url('select-university') }}">All Universities</a></li>
              <li><a href="{{ url('specialization') }}">Specialization</a></li>
              <li><a href="{{ url('scholarships') }}">Scholarship</a></li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <div class="clearfix"></div>
    <!-- Top header-->
