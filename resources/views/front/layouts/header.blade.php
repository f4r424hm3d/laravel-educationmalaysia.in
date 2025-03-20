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
  <link rel="stylesheet" href= "{{ cdn('front/assets/css/slick.css') }}">
  <link rel="stylesheet" href="{{ cdn('front/assets/css/slick-theme.css') }}">
  <!-- slick slider end  -->

  <!-- Owl Carousel CSS -->
  <link rel="stylesheet"  href="{{ cdn('front/assets/css/owl.carousel.min.css') }}">
  <!-- font-awesome  -->
  <link href="{{ cdn('front/assets/css/font-awesome.min.css') }}" rel="stylesheet">
  <link rel="stylesheet"
  href="{{ cdn('front/assets/css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ cdn('front/assets/css/styles.css') }}">
  

  <link rel="preload" href="{{ cdn('front/assets/css/colors.css') }}" as="style"
    onload="this.onload=null;this.rel='stylesheet'">
  <script src="{{ cdn('front/assets/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ cdn('front/assets/js/sweetalert2@11.js') }}"></script>

  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-WP578P4K');
  </script>
  <!-- End Google Tag Manager -->
  <style>
    .hide-this {
      display: none;
    }
  </style>

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
  <!-- End Google Tag Manager (noscript) -->
  <div id="main-wrapper">
    <!-- Top header-->

    <nav class="navbar navbar-expand-lg navbar-light main-heddd">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }} " alt="Education Malaysia Education Logo">
          <img src="{{ cdn('front/assets/img/logo.png') }}" class="logo-max" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown all-dropdowns">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Resources

              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <div class="row mx-auto ">
                  <div class=" col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-3 ">
                    <div class="b-font"><a href="{{ route('exams') }}">Exams</a></div>
                    <ul class="li_dd">
                      @foreach ($exams as $exam)
                        <li><a
                            href="{{ route('exam.detail', ['uri' => $exam->uri]) }}">{{ ucfirst($exam->page_name) }}</a>
                        </li>
                      @endforeach

                    </ul>
                  </div>
                  <div class=" col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-3 ">
                    <div class="b-font"><a href="{{ route('services') }}">Services</a></div>
                    <ul class="li_dd">
                      @foreach ($sitePages as $page)
                        <li><a
                            href="{{ route('service.detail', ['uri' => $page->uri]) }}">{{ ucfirst($page->page_name) }}</a>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                  <div class=" col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-3 ">
                    <div class="b-font">About Us</div>
                    <ul class="li_dd">
                      <li><a href="{{ route('wwa') }}">Who we are</a></li>
                      <li><a href="{{ route('wps') }}" target="_blank">What Students Say</a></li>
                      <li><a href="{{ route('select.level') }}" target="_blank">Study Malaysia</a></li>
                      <li><a href="{{ url('why-study-in-malaysia') }}">Why Study In Malaysia?</a></li>
                    </ul>
                  </div>
                  <div class=" col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-3 ">
                    <img src="{{ cdn('assets/web/images/em-menu2.jpg') }}" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item"><a href="{{ url('courses-in-malaysia') }}" class="nav-link">Courses</a></li>
            <li class="nav-item"><a href="{{ route('select.university') }}" class="nav-link">Universities</a></li>
            <li class="nav-item"><a href="{{ route('specializations') }}" class="nav-link">Specialization</a></li>
            <li class="nav-item"><a href="{{ url('scholarships') }}" class="nav-link">Scholarship</a></li>
          </ul>
          <form class="d-flex align-items-center set-gap">
            @if (session()->has('studentLoggedIn'))
              <a href="{{ url('/student/profile/') }}" class="btn btn-outline-dark my-2 my-sm-0"
                type="submit">Profile</a>
            @else
              <a class="btn btn-primary" href="{{ url('sign-up') }}">Sign Up</a>
              <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ url('sign-in') }}">Login</a>
            @endif
          </form>
        </div>
      </div>
    </nav>

    <!-- new header added start -->

    <!-- new header added end -->

    <!-- Top header-->
