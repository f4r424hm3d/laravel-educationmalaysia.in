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

    <nav class="navbar navbar-expand-lg navbar-light main-heddd"    data-toggle="modal" data-target="#exampleModal">
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

      <!-- Modal -->
      <div class="modal all-malaysia fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center" role="document">
          <div class="modal-content">
            
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <div class="row">
                    <div class="col-12 col-sm-5 col-md-5">
                        <div class="all-blues">
                           <!-- <div class="d-flex white-hats ">
                            <img src="img/white-hat.png" alt="">
                            <h2>Study in Malaysia <span>with 100% Scholarship!</span></h2>
                           </div>  -->
                           <img src=" {{ cdn('/assets/images/scholorship-malysia.png') }}" alt=""  >
                        </div>
                    </div>
                    <div class="col-12 col-sm-7 col-md-7">
                        <div class="all-fieldss">
                            <form class="row">
                                <!-- Input Fields -->
                                <div class="col-12">
                                  <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control" id="fullName" placeholder="Full Name">
                                  </div>
                                </div>
                            
                                <div class="col-12">
                                  <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email Address">
                                  </div>
                                </div>
                            
                                <div class="col-12">
                                  <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <div class="d-flex set-phones">
                                        <select class="form-control">
                                            <option value="">Select</option>
                                                                        <option value="1">
                                                +1 (UNITED STATES MINOR OUTLYING ISLANDS)
                                              </option>
                                                                        <option value="1">
                                                +1 (UNITED STATES)
                                              </option>
                                                                        <option value="1">
                                                +1 (CANADA)
                                              </option>
                                                                        <option value="7">
                                                +7 (KAZAKHSTAN)
                                              </option>
                                                                        <option value="20">
                                                +20 (EGYPT)
                                              </option>
                                                                        <option value="27">
                                                +27 (SOUTH AFRICA)
                                              </option>
                                                                        <option value="30">
                                                +30 (GREECE)
                                              </option>
                                                                        <option value="31">
                                                +31 (NETHERLANDS)
                                              </option>
                                                                        <option value="32">
                                                +32 (BELGIUM)
                                              </option>
                                                                        <option value="33">
                                                +33 (FRANCE)
                                              </option>
                                                                        <option value="34">
                                                +34 (SPAIN)
                                              </option>
                                                                        <option value="36">
                                                +36 (HUNGARY)
                                              </option>
                                                                        <option value="39">
                                                +39 (ITALY)
                                              </option>
                                                                        <option value="39">
                                                +39 (HOLY SEE (VATICAN CITY STATE))
                                              </option>
                                                                        <option value="40">
                                                +40 (ROMANIA)
                                              </option>
                                                                        <option value="41">
                                                +41 (SWITZERLAND)
                                              </option>
                                                                        <option value="43">
                                                +43 (AUSTRIA)
                                              </option>
                                                                        <option value="44">
                                                +44 (UNITED KINGDOM)
                                              </option>
                                                                        <option value="45">
                                                +45 (DENMARK)
                                              </option>
                                                                        <option value="46">
                                                +46 (SWEDEN)
                                              </option>
                                                                        <option value="47">
                                                +47 (SVALBARD AND JAN MAYEN)
                                              </option>
                                                                        <option value="47">
                                                +47 (NORWAY)
                                              </option>
                                                                        <option value="48">
                                                +48 (POLAND)
                                              </option>
                                                                        <option value="49">
                                                +49 (GERMANY)
                                              </option>
                                                                        <option value="51">
                                                +51 (PERU)
                                              </option>
                                                                        <option value="52">
                                                +52 (MEXICO)
                                              </option>
                                                                        <option value="53">
                                                +53 (CUBA)
                                              </option>
                                                                        <option value="54">
                                                +54 (ARGENTINA)
                                              </option>
                                                                        <option value="55">
                                                +55 (BRAZIL)
                                              </option>
                                                                        <option value="56">
                                                +56 (CHILE)
                                              </option>
                                                                        <option value="57">
                                                +57 (COLOMBIA)
                                              </option>
                                                                        <option value="58">
                                                +58 (VENEZUELA)
                                              </option>
                                                                        <option value="60">
                                                +60 (MALAYSIA)
                                              </option>
                                                                        <option value="61">
                                                +61 (AUSTRALIA)
                                              </option>
                                                                        <option value="61">
                                                +61 (CHRISTMAS ISLAND)
                                              </option>
                                                                        <option value="62">
                                                +62 (INDONESIA)
                                              </option>
                                                                        <option value="63">
                                                +63 (PHILIPPINES)
                                              </option>
                                                                        <option value="64">
                                                +64 (NEW ZEALAND)
                                              </option>
                                                                        <option value="65">
                                                +65 (SINGAPORE)
                                              </option>
                                                                        <option value="66">
                                                +66 (THAILAND)
                                              </option>
                                                                        <option value="70">
                                                +70 (RUSSIAN FEDERATION)
                                              </option>
                                                                        <option value="81">
                                                +81 (JAPAN)
                                              </option>
                                                                        <option value="82">
                                                +82 (KOREA, REPUBLIC OF)
                                              </option>
                                                                        <option value="84">
                                                +84 (VIET NAM)
                                              </option>
                                                                        <option value="86">
                                                +86 (CHINA)
                                              </option>
                                                                        <option value="90">
                                                +90 (TURKEY)
                                              </option>
                                                                        <option value="91" selected="">
                                                +91 (INDIA)
                                              </option>
                                                                        <option value="92">
                                                +92 (PAKISTAN)
                                              </option>
                                                                        <option value="93">
                                                +93 (AFGHANISTAN)
                                              </option>
                                                                        <option value="94">
                                                +94 (SRI LANKA)
                                              </option>
                                                                        <option value="95">
                                                +95 (MYANMAR)
                                              </option>
                                                                        <option value="98">
                                                +98 (IRAN, ISLAMIC REPUBLIC OF)
                                              </option>
                                                                        <option value="211">
                                                +211 (SOUTH SUDAN)
                                              </option>
                                                                        <option value="212">
                                                +212 (MOROCCO)
                                              </option>
                                                                        <option value="212">
                                                +212 (WESTERN SAHARA)
                                              </option>
                                                                        <option value="213">
                                                +213 (ALGERIA)
                                              </option>
                                                                        <option value="216">
                                                +216 (TUNISIA)
                                              </option>
                                                                        <option value="218">
                                                +218 (LIBYAN ARAB JAMAHIRIYA)
                                              </option>
                                                                        <option value="220">
                                                +220 (GAMBIA)
                                              </option>
                                                                        <option value="221">
                                                +221 (SENEGAL)
                                              </option>
                                                                        <option value="222">
                                                +222 (MAURITANIA)
                                              </option>
                                                                        <option value="223">
                                                +223 (MALI)
                                              </option>
                                                                        <option value="224">
                                                +224 (GUINEA)
                                              </option>
                                                                        <option value="225">
                                                +225 (COTE D'IVOIRE)
                                              </option>
                                                                        <option value="226">
                                                +226 (BURKINA FASO)
                                              </option>
                                                                        <option value="227">
                                                +227 (NIGER)
                                              </option>
                                                                        <option value="228">
                                                +228 (TOGO)
                                              </option>
                                                                        <option value="229">
                                                +229 (BENIN)
                                              </option>
                                                                        <option value="230">
                                                +230 (MAURITIUS)
                                              </option>
                                                                        <option value="231">
                                                +231 (LIBERIA)
                                              </option>
                                                                        <option value="232">
                                                +232 (SIERRA LEONE)
                                              </option>
                                                                        <option value="233">
                                                +233 (GHANA)
                                              </option>
                                                                        <option value="234">
                                                +234 (NIGERIA)
                                              </option>
                                                                        <option value="235">
                                                +235 (CHAD)
                                              </option>
                                                                        <option value="236">
                                                +236 (CENTRAL AFRICAN REPUBLIC)
                                              </option>
                                                                        <option value="237">
                                                +237 (CAMEROON)
                                              </option>
                                                                        <option value="238">
                                                +238 (CAPE VERDE)
                                              </option>
                                                                        <option value="239">
                                                +239 (SAO TOME AND PRINCIPE)
                                              </option>
                                                                        <option value="240">
                                                +240 (EQUATORIAL GUINEA)
                                              </option>
                                                                        <option value="241">
                                                +241 (GABON)
                                              </option>
                                                                        <option value="242">
                                                +242 (CONGO, THE DEMOCRATIC REPUBLIC OF THE)
                                              </option>
                                                                        <option value="242">
                                                +242 (CONGO)
                                              </option>
                                                                        <option value="244">
                                                +244 (ANGOLA)
                                              </option>
                                                                        <option value="245">
                                                +245 (GUINEA-BISSAU)
                                              </option>
                                                                        <option value="246">
                                                +246 (BRITISH INDIAN OCEAN TERRITORY)
                                              </option>
                                                                        <option value="248">
                                                +248 (SEYCHELLES)
                                              </option>
                                                                        <option value="249">
                                                +249 (SUDAN)
                                              </option>
                                                                        <option value="250">
                                                +250 (RWANDA)
                                              </option>
                                                                        <option value="251">
                                                +251 (ETHIOPIA)
                                              </option>
                                                                        <option value="252">
                                                +252 (SOMALIA)
                                              </option>
                                                                        <option value="253">
                                                +253 (DJIBOUTI)
                                              </option>
                                                                        <option value="254">
                                                +254 (KENYA)
                                              </option>
                                                                        <option value="255">
                                                +255 (TANZANIA, UNITED REPUBLIC OF)
                                              </option>
                                                                        <option value="256">
                                                +256 (UGANDA)
                                              </option>
                                                                        <option value="257">
                                                +257 (BURUNDI)
                                              </option>
                                                                        <option value="258">
                                                +258 (MOZAMBIQUE)
                                              </option>
                                                                        <option value="260">
                                                +260 (ZAMBIA)
                                              </option>
                                                                        <option value="261">
                                                +261 (MADAGASCAR)
                                              </option>
                                                                        <option value="262">
                                                +262 (REUNION)
                                              </option>
                                                                        <option value="263">
                                                +263 (ZIMBABWE)
                                              </option>
                                                                        <option value="264">
                                                +264 (NAMIBIA)
                                              </option>
                                                                        <option value="265">
                                                +265 (MALAWI)
                                              </option>
                                                                        <option value="266">
                                                +266 (LESOTHO)
                                              </option>
                                                                        <option value="267">
                                                +267 (BOTSWANA)
                                              </option>
                                                                        <option value="268">
                                                +268 (SWAZILAND)
                                              </option>
                                                                        <option value="269">
                                                +269 (COMOROS)
                                              </option>
                                                                        <option value="269">
                                                +269 (MAYOTTE)
                                              </option>
                                                                        <option value="290">
                                                +290 (SAINT HELENA)
                                              </option>
                                                                        <option value="291">
                                                +291 (ERITREA)
                                              </option>
                                                                        <option value="297">
                                                +297 (ARUBA)
                                              </option>
                                                                        <option value="298">
                                                +298 (FAROE ISLANDS)
                                              </option>
                                                                        <option value="299">
                                                +299 (GREENLAND)
                                              </option>
                                                                        <option value="350">
                                                +350 (GIBRALTAR)
                                              </option>
                                                                        <option value="351">
                                                +351 (PORTUGAL)
                                              </option>
                                                                        <option value="352">
                                                +352 (LUXEMBOURG)
                                              </option>
                                                                        <option value="353">
                                                +353 (IRELAND)
                                              </option>
                                                                        <option value="354">
                                                +354 (ICELAND)
                                              </option>
                                                                        <option value="355">
                                                +355 (ALBANIA)
                                              </option>
                                                                        <option value="356">
                                                +356 (MALTA)
                                              </option>
                                                                        <option value="357">
                                                +357 (CYPRUS)
                                              </option>
                                                                        <option value="358">
                                                +358 (FINLAND)
                                              </option>
                                                                        <option value="359">
                                                +359 (BULGARIA)
                                              </option>
                                                                        <option value="370">
                                                +370 (LITHUANIA)
                                              </option>
                                                                        <option value="371">
                                                +371 (LATVIA)
                                              </option>
                                                                        <option value="372">
                                                +372 (ESTONIA)
                                              </option>
                                                                        <option value="373">
                                                +373 (MOLDOVA, REPUBLIC OF)
                                              </option>
                                                                        <option value="374">
                                                +374 (ARMENIA)
                                              </option>
                                                                        <option value="375">
                                                +375 (BELARUS)
                                              </option>
                                                                        <option value="376">
                                                +376 (ANDORRA)
                                              </option>
                                                                        <option value="377">
                                                +377 (MONACO)
                                              </option>
                                                                        <option value="378">
                                                +378 (SAN MARINO)
                                              </option>
                                                                        <option value="380">
                                                +380 (UKRAINE)
                                              </option>
                                                                        <option value="381">
                                                +381 (SERBIA AND MONTENEGRO)
                                              </option>
                                                                        <option value="385">
                                                +385 (CROATIA)
                                              </option>
                                                                        <option value="386">
                                                +386 (SLOVENIA)
                                              </option>
                                                                        <option value="387">
                                                +387 (BOSNIA AND HERZEGOVINA)
                                              </option>
                                                                        <option value="389">
                                                +389 (MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF)
                                              </option>
                                                                        <option value="420">
                                                +420 (CZECH REPUBLIC)
                                              </option>
                                                                        <option value="421">
                                                +421 (SLOVAKIA)
                                              </option>
                                                                        <option value="423">
                                                +423 (LIECHTENSTEIN)
                                              </option>
                                                                        <option value="500">
                                                +500 (FALKLAND ISLANDS (MALVINAS))
                                              </option>
                                                                        <option value="501">
                                                +501 (BELIZE)
                                              </option>
                                                                        <option value="502">
                                                +502 (GUATEMALA)
                                              </option>
                                                                        <option value="503">
                                                +503 (EL SALVADOR)
                                              </option>
                                                                        <option value="504">
                                                +504 (HONDURAS)
                                              </option>
                                                                        <option value="505">
                                                +505 (NICARAGUA)
                                              </option>
                                                                        <option value="506">
                                                +506 (COSTA RICA)
                                              </option>
                                                                        <option value="507">
                                                +507 (PANAMA)
                                              </option>
                                                                        <option value="508">
                                                +508 (SAINT PIERRE AND MIQUELON)
                                              </option>
                                                                        <option value="509">
                                                +509 (HAITI)
                                              </option>
                                                                        <option value="590">
                                                +590 (GUADELOUPE)
                                              </option>
                                                                        <option value="591">
                                                +591 (BOLIVIA)
                                              </option>
                                                                        <option value="592">
                                                +592 (GUYANA)
                                              </option>
                                                                        <option value="593">
                                                +593 (ECUADOR)
                                              </option>
                                                                        <option value="594">
                                                +594 (FRENCH GUIANA)
                                              </option>
                                                                        <option value="595">
                                                +595 (PARAGUAY)
                                              </option>
                                                                        <option value="596">
                                                +596 (MARTINIQUE)
                                              </option>
                                                                        <option value="597">
                                                +597 (SURINAME)
                                              </option>
                                                                        <option value="598">
                                                +598 (URUGUAY)
                                              </option>
                                                                        <option value="599">
                                                +599 (NETHERLANDS ANTILLES)
                                              </option>
                                                                        <option value="670">
                                                +670 (TIMOR-LESTE)
                                              </option>
                                                                        <option value="672">
                                                +672 (NORFOLK ISLAND)
                                              </option>
                                                                        <option value="672">
                                                +672 (COCOS (KEELING) ISLANDS)
                                              </option>
                                                                        <option value="673">
                                                +673 (BRUNEI DARUSSALAM)
                                              </option>
                                                                        <option value="674">
                                                +674 (NAURU)
                                              </option>
                                                                        <option value="675">
                                                +675 (PAPUA NEW GUINEA)
                                              </option>
                                                                        <option value="676">
                                                +676 (TONGA)
                                              </option>
                                                                        <option value="677">
                                                +677 (SOLOMON ISLANDS)
                                              </option>
                                                                        <option value="678">
                                                +678 (VANUATU)
                                              </option>
                                                                        <option value="679">
                                                +679 (FIJI)
                                              </option>
                                                                        <option value="680">
                                                +680 (PALAU)
                                              </option>
                                                                        <option value="681">
                                                +681 (WALLIS AND FUTUNA)
                                              </option>
                                                                        <option value="682">
                                                +682 (COOK ISLANDS)
                                              </option>
                                                                        <option value="683">
                                                +683 (NIUE)
                                              </option>
                                                                        <option value="684">
                                                +684 (SAMOA)
                                              </option>
                                                                        <option value="686">
                                                +686 (KIRIBATI)
                                              </option>
                                                                        <option value="687">
                                                +687 (NEW CALEDONIA)
                                              </option>
                                                                        <option value="688">
                                                +688 (TUVALU)
                                              </option>
                                                                        <option value="689">
                                                +689 (FRENCH POLYNESIA)
                                              </option>
                                                                        <option value="690">
                                                +690 (TOKELAU)
                                              </option>
                                                                        <option value="691">
                                                +691 (MICRONESIA, FEDERATED STATES OF)
                                              </option>
                                                                        <option value="692">
                                                +692 (MARSHALL ISLANDS)
                                              </option>
                                                                        <option value="850">
                                                +850 (KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF)
                                              </option>
                                                                        <option value="852">
                                                +852 (HONG KONG)
                                              </option>
                                                                        <option value="853">
                                                +853 (MACAO)
                                              </option>
                                                                        <option value="855">
                                                +855 (CAMBODIA)
                                              </option>
                                                                        <option value="856">
                                                +856 (LAO PEOPLE'S DEMOCRATIC REPUBLIC)
                                              </option>
                                                                        <option value="880">
                                                +880 (BANGLADESH)
                                              </option>
                                                                        <option value="886">
                                                +886 (TAIWAN, PROVINCE OF CHINA)
                                              </option>
                                                                        <option value="960">
                                                +960 (MALDIVES)
                                              </option>
                                                                        <option value="961">
                                                +961 (LEBANON)
                                              </option>
                                                                        <option value="962">
                                                +962 (JORDAN)
                                              </option>
                                                                        <option value="963">
                                                +963 (SYRIAN ARAB REPUBLIC)
                                              </option>
                                                                        <option value="964">
                                                +964 (IRAQ)
                                              </option>
                                                                        <option value="965">
                                                +965 (KUWAIT)
                                              </option>
                                                                        <option value="966">
                                                +966 (SAUDI ARABIA)
                                              </option>
                                                                        <option value="967">
                                                +967 (YEMEN)
                                              </option>
                                                                        <option value="968">
                                                +968 (OMAN)
                                              </option>
                                                                        <option value="970">
                                                +970 (PALESTINIAN TERRITORY, OCCUPIED)
                                              </option>
                                                                        <option value="971">
                                                +971 (UNITED ARAB EMIRATES)
                                              </option>
                                                                        <option value="972">
                                                +972 (ISRAEL)
                                              </option>
                                                                        <option value="973">
                                                +973 (BAHRAIN)
                                              </option>
                                                                        <option value="974">
                                                +974 (QATAR)
                                              </option>
                                                                        <option value="975">
                                                +975 (BHUTAN)
                                              </option>
                                                                        <option value="976">
                                                +976 (MONGOLIA)
                                              </option>
                                                                        <option value="977">
                                                +977 (NEPAL)
                                              </option>
                                                                        <option value="992">
                                                +992 (TAJIKISTAN)
                                              </option>
                                                                        <option value="994">
                                                +994 (AZERBAIJAN)
                                              </option>
                                                                        <option value="995">
                                                +995 (GEORGIA)
                                              </option>
                                                                        <option value="996">
                                                +996 (KYRGYZSTAN)
                                              </option>
                                                                        <option value="998">
                                                +998 (UZBEKISTAN)
                                              </option>
                                                                        <option value="1242">
                                                +1242 (BAHAMAS)
                                              </option>
                                                                        <option value="1246">
                                                +1246 (BARBADOS)
                                              </option>
                                                                        <option value="1264">
                                                +1264 (ANGUILLA)
                                              </option>
                                                                        <option value="1268">
                                                +1268 (ANTIGUA AND BARBUDA)
                                              </option>
                                                                        <option value="1284">
                                                +1284 (VIRGIN ISLANDS, BRITISH)
                                              </option>
                                                                        <option value="1340">
                                                +1340 (VIRGIN ISLANDS, U.S.)
                                              </option>
                                                                        <option value="1345">
                                                +1345 (CAYMAN ISLANDS)
                                              </option>
                                                                        <option value="1441">
                                                +1441 (BERMUDA)
                                              </option>
                                                                        <option value="1473">
                                                +1473 (GRENADA)
                                              </option>
                                                                        <option value="1649">
                                                +1649 (TURKS AND CAICOS ISLANDS)
                                              </option>
                                                                        <option value="1664">
                                                +1664 (MONTSERRAT)
                                              </option>
                                                                        <option value="1670">
                                                +1670 (NORTHERN MARIANA ISLANDS)
                                              </option>
                                                                        <option value="1671">
                                                +1671 (GUAM)
                                              </option>
                                                                        <option value="1684">
                                                +1684 (AMERICAN SAMOA)
                                              </option>
                                                                        <option value="1758">
                                                +1758 (SAINT LUCIA)
                                              </option>
                                                                        <option value="1767">
                                                +1767 (DOMINICA)
                                              </option>
                                                                        <option value="1784">
                                                +1784 (SAINT VINCENT AND THE GRENADINES)
                                              </option>
                                                                        <option value="1787">
                                                +1787 (PUERTO RICO)
                                              </option>
                                                                        <option value="1809">
                                                +1809 (DOMINICAN REPUBLIC)
                                              </option>
                                                                        <option value="1868">
                                                +1868 (TRINIDAD AND TOBAGO)
                                              </option>
                                                                        <option value="1869">
                                                +1869 (SAINT KITTS AND NEVIS)
                                              </option>
                                                                        <option value="1876">
                                                +1876 (JAMAICA)
                                              </option>
                                                                        <option value="7370">
                                                +7370 (TURKMENISTAN)
                                              </option>
                                                                    </select>
                                                                    <input type="tel" class="form-control" id="phone" placeholder="+1234567890">
                                    </div>
                                    
                                  </div>
                                </div>
                            
                                <!-- Select Fields -->
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="country">Country of Residence</label>
                                    <select class="form-control" id="country">
                                      <option disabled="" selected="">Select your country</option>
                                      <option>Malaysia</option>
                                      <option>India</option>
                                      <option>Pakistan</option>
                                      <option>Bangladesh</option>
                                      <option>Other</option>
                                    </select>
                                  </div>
                                </div>
                            
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="qualification">Highest Qualification</label>
                                    <select class="form-control" id="qualification">
                                      <option disabled="" selected="">Select your qualification</option>
                                      <option>High School</option>
                                      <option>Diploma</option>
                                      <option>Bachelor's Degree</option>
                                      <option>Master's Degree</option>
                                      <option>PhD</option>
                                    </select>
                                  </div>
                                </div>
                            
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="program">Interested Program</label>
                                    <select class="form-control" id="program">
                                      <option disabled="" selected="">Select a program</option>
                                      <option>MBBS</option>
                                      <option>Pharmacy</option>
                                      <option>Engineering</option>
                                      <option>Business Administration</option>
                                      <option>Other</option>
                                    </select>
                                  </div>
                                </div>
                            
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="intake">Preferred Intake</label>
                                    <select class="form-control" id="intake">
                                      <option disabled="" selected="">Select intake</option>
                                      <option>May 2025</option>
                                      <option>September 2025</option>
                                      <option>January 2026</option>
                                    </select>
                                  </div>
                                </div>
                            
                                <div class="col-12">
                                  <button type="submit" class="btn btn-primary" data-dismiss="modal">Submit</button>
                                </div>
                              </form>
                        </div>
                    </div>
                  </div>
            </div>
          
          </div>
        </div>
      </div>
    <!-- new header added start -->

    <!-- new header added end -->

    <!-- Top header-->
