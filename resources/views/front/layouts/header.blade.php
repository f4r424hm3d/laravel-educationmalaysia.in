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
<!-- slick slider  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
<!-- slick slider end  -->
 
 <!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">


 <!-- Owl Carousel  end  -->

<!-- owl-carousel end  -->
  <!--Meta Tag Seo-->
  @stack('seo_meta_tag')
  @stack('pagination_tag')
  <!-- CSS -->
  <link href="{{ url('front/') }}/assets/css/styles.css" rel="stylesheet">
  <link rel="preload" href="{{ url('front/') }}/assets/css/colors.css" as="style"
    onload="this.onload=null;this.rel='stylesheet'">



  <style>
    .hide-this {
      display: none;
    }
  </style>

  <!-- organization schema code -->
  <script type="application/ld+json"> {"@context":"https://schema.org","@type":"Organization","@id":"https://www.educationmalaysia.in/#organization","name":"Education Malaysia Education","url":"https://www.educationmalaysia.in/","logo":"https://www.educationmalaysia.in/front/assets/img/logo.png","address":{"@type":"PostalAddress","streetAddress":"B-16 Ground Floor, Mayfield Garden, Sector 50","addressLocality":"Gurugram","addressRegion":"Haryana","postalCode":"122002","addressCountry":"India"},"contactPoint":{"@type":"ContactPoint","contactType":"contact","telephone":"+919818560331","email":"info.educationmalaysia.in"},"sameAs":["https://www.facebook.com/britannicaoverseasedu","https://twitter.com/BritannicaOEdu","https://www.youtube.com/channel/UCK2eeC1CkS3YkYrGnnzBUEQ","https://in.pinterest.com/Britannicaoverseas/","https://www.linkedin.com/company/britannicaoverseas/","https://www.instagram.com/britannicaoverseas/","https://www.tumblr.com/britannicaoverseas/"]}
</script>
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
    })(window, document, 'script', 'dataLayer', 'GTM-PXNZKF7');
  </script>
  <!-- End Google Tag Manager -->
  <!-- Favicons-->
  @stack('breadcrumb_schema')
  <style>
    .hide-this {
      display: none;
    }
  </style>
  <style>
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
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PXNZKF7" height="0" width="0"
      style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
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
                <!--<li class="login_click theme-bg"><a href="{{ url('/') }}/sign-up">Sign up</a></li>-->
              @endif
            </ul>
            <ul class="nav-menu align-to-right">
              <li><a href="{{ url('/') }}/cities">Home</a></li>
              <li class="mega-dropdown"><a href="#">Resources<span class="submenu-indicator"></span></a>
                <ul class="nav-dropdown nav-submenu mega-dropdown-menu">
                  <div class="row">
                    <div class="col-md-2">
                      <ul>
                        <li><a href="{{ url('exams') }}">English Exams</a></li>
                        @foreach ($exams as $exam)
                          <li><a href="{{ url($exam->uri) }}">{{ ucfirst($exam->page_name) }}</a></li>
                        @endforeach
                      </ul>
                    </div>
                    <div class="col-md-2">
                      <ul>
                        <li><a href="{{ url('services') }}">Services</a></li>
                        @foreach ($sitePages as $page)
                          <li><a href="{{ url($page->uri) }}">{{ ucfirst($page->page_name) }}</a></li>
                        @endforeach
                      </ul>
                    </div>
                    <div class="col-md-2">
                      <ul>
                        <li><a href="{{ route('wwa') }}">Who we are</a></li>
                        <li><a href="{{ route('wps') }}" target="_blank">What Students Say</a></li>
                        <li><a href="{{ route('select.level') }}" target="_blank">Study Malaysia</a></li>
                        <li><a href="{{ url('why-study-in-malaysia') }}">Why Study In Malaysia?</a></li>
                      </ul>
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
