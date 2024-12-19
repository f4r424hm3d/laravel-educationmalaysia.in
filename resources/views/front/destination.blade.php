@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.dynamic_page_meta_tag')
@endpush
@push('breadcrumb_schema')
  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Article",
      "inLanguage": "en",
      "headline": "<?= $meta_title ?>",
      "description": "<?= $meta_description ?>",
      "keywords": "<?= $meta_keyword ?>",
      "dateModified": "<?= getISOFormatTime($destination->updated_at) ?>",
      "datePublished": "<?= getISOFormatTime($destination->created_at) ?>",
      "mainEntityOfPage": { "id": "<?= $page_url ?>", "@type": "WebPage" },
      "author": { "@type": "Person", "name": "Britannica Team", "url": "https://www.educationmalaysia.in/author/6-britannica-team" },
      "publisher": {
          "@type": "Organization",
          "name": "Tutelage Study",
          "logo": { "@type": "ImageObject", "name": "Tutelage Study", "url": "https://www.educationmalaysia.in/front/assets/img/logo.webp", "height": "65", "width": "258" }
      },
      "image": { "@type": "ImageObject", "url": "<?= asset($og_image_path) ?>" }
    }
  </script>
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="ed_detail_head" data-overlay="10">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1">Study in {{ $destination->country }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- Content -->
  <div class="hero_banner" data-overlay="7" style="height: 280px;">
    <div id="main-banner">
      <div class="singles_items"> </div>
    </div>
    <div class="container text-center" style="position:absolute">
      <div class="hero-caption mb-2">
        <h2 class="big-header-capt cl_2 mb-0">Study in {{ $destination->country }}</h2>
        <p class="text-center">Study any topic, anytime. Explore thousands of courses for the lowest price ever!</p>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-9 col-md-12 col-sm-12">
          <div class="banner-search shadow_high">
            <div class="search_hero_wrapping">
              <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-9 col-9 pr-0">
                  <div class="form-group">
                    <div class="input-with-icon"> <input type="text" id="search" class="form-control"
                        placeholder="Search Universities and programs" /> <img
                        src="{{ url('front/') }}/assets/img/search.svg" class="search-icon" alt="search icon" /> </div>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 pl-0 col-3">
                  <div class="form-group none"> <a onclick="check()" href="javascript:void()"
                      class="btn search-btn full-width">Search</a> </div>
                </div>
              </div>
              <div class="sItems" style="display:none">
                <ul class="sItemsUl"> </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center mt-3">
        <div class="col-lg-7 col-md-12 col-sm-12">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-2 col-md-2 col-sm-2 text-white text-right d-none d-sm-inline-block pb-2 pr-0">Other
              Countries:</div>
            <div class="col-lg-9 col-md-9 col-sm-9 mini-btns">
              @foreach ($destinations as $row)
                <a href="{{ url($row->destination_slug) }}">{{ $row->destination_name }}</a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- === Hero Banner End ===-->
  <section class="bg-light">
    @if ($destination->description != null)
      <div class="container">
        <div class="edu_wraper mb-0">
          <div class="show-more-box-country">

            <div class="text show-more-height">
              <div class="author">
                <div class="img-div">
                  <img src="{{ userIcon($destination->getUser->profile_picture ?? null) }}"
                    alt="{{ $destination->getUser->name ?? 'Author' }}"><i class="fa fa-check-circle"></i>
                </div>
                <div class="cont-div">
                  <a
                    href="{{ $destination->author_id != null ? url('author/' . $destination->getUser->id . '-' . $destination->getUser->slug) : '#' }}">{{ $destination->getUser->name ?? 'Author' }}
                  </a><span> Updated on - {{ getFormattedDate($destination->updated_at, 'M d, Y') }}</span>
                </div>
              </div>
              <div class="sec-heading mb-2">
                <h1>Study in {{ $destination->country }}: {{ $destination->title }}</h1>
              </div>
              {!! $destination->description !!}

              <hr />
              @if ($faqs->count() > 0)
                <div class="row mt-4">
                  <div class="col-lg-12 col-md-12">
                    <div class="sec-heading mb-0">
                      <h6>Study In {{ $destination->country }} FAQs</h6>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div id="accordionExample" class="accordion circullum">

                      @foreach ($faqs as $row)
                        <div class="card mb-0 shadow-0">
                          <div id="headingOne{{ $row->id }}" class="card-header bg-white border-0 b-b pl-0 pr-4">
                            <div class="mb-0 accordion_title"><a href="#" data-toggle="collapse"
                                data-target="#collapseOne{{ $row->id }}" aria-expanded="false"
                                aria-controls="collapseOne{{ $row->id }}"
                                class="d-block position-relative collapsible-link py-1">{{ $row->question }}</a></div>
                          </div>
                          <div id="collapseOne{{ $row->id }}" aria-labelledby="headingOne{{ $row->id }}"
                            data-parent="#accordionExample" class="collapse">
                            <div class="card-body pt-3 pl-0 pr-0">
                              {{ $row->answer }}
                            </div>
                          </div>
                        </div>
                      @endforeach
                      @push('breadcrumb_schema')
                        <!-- FAQ SCHEMA START -->
                        <script type="application/ld+json">
                  {
                  "@context": "https:\/\/schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [
                    <?php
                  $i = 1;
                  $tfaq = count($faqs);
                  foreach ($faqs as $faq) {
                  ?> {
                        "@type": "Question",
                        "name": "{{ $faq->question }}",
                        "acceptedAnswer": {
                          "@type": "Answer",
                          "text": "{{ str_replace('/', '\/', str_replace('"', '\"', $faq->answer)) }}"
                        }
                      }
                      <?php if ($i < $tfaq) { ?>, <?php } ?>
                    <?php $i++;
                  } ?>
                  ]
                }
                </script>
                        <!-- FAQ SCHEMA END -->
                      @endpush
                    </div>
                  </div>
                </div>
              @endif

            </div>
            <div class="show-more">(Show More)</div>
          </div>
        </div>
      </div>
    @endif
    @if ($states->count() > 0)
      <div class="fuc">
        <div class="container">
          <div class="sec-heading mb-4">
            <h2>Top Places To <span class="theme-cl1">Study In {{ $destination->country }}</span></h2>
          </div>
          <div class="row four_slide">

            @foreach ($states as $row)
              <div class="item singles_item">
                <a href="{{ url($destination->destination_slug . '/' . $row->state_slug . '-universities') }}">
                  <div class="fuc-box justify-content-center">
                    <span><img data-src="{{ url('front/') }}/assets/img/city-icon.png" alt="city name"></span>
                    <p>{{ $row->state }} <i class="fa fa-angle-right float-right"></i></p>
                  </div>
                </a>
              </div>
            @endforeach

          </div>
        </div>
      </div>
    @endif
  </section>

  @if ($destinationArticles->count() > 0)
    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="sec-heading">
              <div class="sec-heading">
                <h2>Study in <span class="theme-cl1">{{ $destination->destination_name }} </span> Guides & Resources
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 p-0">
            <div class="three_slide ">
              @foreach ($destinationArticles as $row)
                <div class="singles_items">
                  <div class="education_block_grid style_2">
                    <div class="education_block_body">
                      <h4 class="bl-title">{{ $row->title }}</h4>
                      <p>{{ substr($row->heading, 0, 115) }}</p>
                      <a href="{{ url($destination->destination_slug . '/articles/' . $row->page_url) }}"
                        class="btn btn-theme-2 ml-2 rounded rounded-circle mt-3 mb-4">View
                        Details</a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif
  @if ($categories->count() > 0)
    <section class="bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="sec-heading">
              <h2>Choose <span class="theme-cl1">Your Favourite</span> Programme</h2>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($categories as $row)
            <div class="col-lg-2 col-md-2 col-sm-4 col-6 pmr-7">
              <div class="courses">
                <a
                  href="{{ url($destination->destination_slug . '/' . $row->getCategory->category_slug . '-universities') }}">
                  <img data-src="{{ categoryIcon($row->getCategory->icon_path) }}" alt="icon" height="40"
                    width="40">
                  <span>{{ $row->getCategory->category_name }}</span>
                </a>
              </div>
            </div>
          @endforeach
        </div>
        <div class="row justify-content-center">
          <a href="{{ url($destination->destination_slug . '/' . $destination->destination_slug . '-universities') }}"
            class="btn btn-modern float-none">
            View all Programmes<span><i class="ti-arrow-right"></i></span>
          </a>
        </div>
      </div>
    </section>
  @endif

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="about-short">
            <div class="sec-heading">
              <h2>How Our <span class="theme-cl1">Academic Counsellor</span> Can Help You Get Admission</h2>
            </div>
            <div class="row card-items">
              <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="card">
                  <div class="card-body pt-3 pr-3 pb-3 pl-4"> <i class="fas fa-pen-fancy"></i>
                    <h5 class="card-title mt-2 mb-0">Register<br><span>Yourself</span></h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="card">
                  <div class="card-body pt-3 pr-3 pb-3 pl-4"> <i class="fas fa-comments"></i>
                    <h5 class="card-title mt-2 mb-0">Document<br><span>Counselling</span></h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="card">
                  <div class="card-body pt-3 pr-3 pb-3 pl-4"> <i class="fas fa-file-alt"></i>
                    <h5 class="card-title mt-2 mb-0">Entrance<br><span>Test</span></h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="card">
                  <div class="card-body pt-3 pr-3 pb-3 pl-4"> <i class="fas fa-building"></i>
                    <h5 class="card-title mt-2 mb-0">University<br><span>Shortlist</span></h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="card">
                  <div class="card-body pt-3 pr-3 pb-3 pl-4"> <i class="fas fa-folder-open"></i>
                    <h5 class="card-title mt-2 mb-0">Preparing<br><span>Documentation</span></h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="card">
                  <div class="card-body pt-3 pr-3 pb-3 pl-4"> <i class="fas fa-address-card"></i>
                    <h5 class="card-title mt-2 mb-0">Application<br><span>Guidance</span></h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="card">
                  <div class="card-body pt-3 pr-3 pb-3 pl-4"> <i class="fas fa-wallet"></i>
                    <h5 class="card-title mt-2 mb-0">Financial<br><span>Documentation</span></h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="card">
                  <div class="card-body pt-3 pr-3 pb-3 pl-4"> <i class="fas fa-passport"></i>
                    <h5 class="card-title mt-2 mb-0">VISA<br><span>Application</span></h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="card">
                  <div class="card-body pt-3 pr-3 pb-3 pl-4"> <i class="fas fa-plane-departure"></i>
                    <h5 class="card-title mt-2 mb-0">Post<br><span>Visa</span></h5>
                  </div>
                </div>
              </div>
            </div> <a href="sign-in" class="btn btn-modern float-none">Talk to Counsellor<span><i
                  class="ti-arrow-right"></i></span></a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="list_facts_wrap_img"><img data-src="{{ url('front/') }}/assets/img/online.jpg" class="img-fluid"
              alt="Talk to Counsellor"> </div>
        </div>
      </div>
    </div>
  </section>

  @if ($universities->count() > 0)
    <section class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="sec-heading">
              <div class="sec-heading">
                <h2>Top <span class="theme-cl1">Universities</span> In {{ $destination->country }} for International
                  Students</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 p-0">
            <div class=" two_slide">

              @foreach ($universities as $row)
                <!-- Single Slide -->
                <div class="singles_items">
                  <div class="image-cover ed_detail_head lg p-3 mb-3" data-overlay="8">
                    <div class="row align-items-center justify-content-center">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-4">
                        <img data-src="{{ universityLogo($row->logo_path) }}" class="img-fluid circle"
                          style="width: 60px; height: 60px; border: 2px solid #e3ecf5; border-radius: 100%;"
                          alt="{{ $row->name }} Logo">
                      </div>
                      <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                        <div class="ed_detail_wrap light">
                          <div class="ed_header_caption mt-0 mb-0">
                            <h5 class="ed_title">{{ $row->name }}</h5>
                            <ul class="mb-2">
                              <li><i class="fa fa-globe"></i>Ranked : {{ $row->university_rank }}</li>
                            </ul>
                            <ul class="cources_facts_list">
                              <li class="facts-1 mb-0"><a href="{{ url($row->slug) }}"></i> View Details</a>
                              </li>
                              @if ($row->getPrograms->count() > 0)
                                <li class="facts-1 mb-0 mt-2"><a href="{{ url($row->slug . '/courses') }}"> View all
                                    courses</a></li>
                              @endif
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  @if ($counsellors->count() > 0)
    <section class="edu_cat_2 cat-3">
      <div class="container">

        <div class="row justify-content-center">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="sec-heading">
              <h2><span class="theme-cl1">Top Counsellors</span> Start Virtual Meeting</h2>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="four_slide-dots arrow_middle">

              @foreach ($counsellors as $row)
                <div class="singles_items">
                  <div class="instructor_wrap">
                    <div class="instructor_thumb">
                      <img data-src="{{ userIcon($row->profile_pic) }}" class="img-fluid"
                        alt="{{ $row->name }} education counsellor"></a>
                    </div>
                    <div class="instructor_caption">
                      <h4>{{ $row->name }}</h4>
                      <ul class="instructor_info">
                        <li><i class="ti-tag"></i> {{ $row->designation }}</li>
                        <li> <i class="ti-tag"></i>{{ $row->experience }}</li>
                      </ul>
                      <a href="{{ url('book-demo') }}" class="btn btn-outline-theme">Book Appointment <i
                          class="ti-arrow-right"></i></a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  @if ($universities->count() > 0)
    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="sec-heading">
              <h2>{{ $destination->country }}'s Best Colleges <span class="theme-cl1">Ranking</span> 2024</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="table-responsive b-all ranking-table align-items-center">
              <table class="style_table table table-striped mb-0">
                <thead>
                  <tr class="bg-primary text-white">
                    <th class="d-none d-sm-block">Logo</th>
                    <th>University</th>
                    <th>
                      <div align="center">The 2024</div>
                    </th>
                    <th>
                      <div align="center">QS 2024</div>
                    </th>
                    <th>
                      <div align="center">US World 2024</div>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($universities as $row)
                    <tr>
                      <td width="60" class="d-none d-sm-block"><img
                          data-src="{{ universityLogo($row->logo_path) }}" alt="{{ $row->name }} Logo">
                      </td>
                      <td><a href="{{ url($row->slug) }}">{{ $row->name }}</a><br><br>
                        <a href="{{ url($row->slug . '/courses') }}">VIEW ALL COURSES <i
                            class=" ti-arrow-right"></i></a>
                      </td>
                      <td>
                        <div class="circle-{{ $row->university_rank != null ? 'c' : 'g' }}">
                          {{ $row->university_rank ?? 'N/A' }}</div>
                      </td>
                      <td>
                        <div class="circle-{{ $row->qs_rank != null ? 'c' : 'g' }}">{{ $row->qs_rank ?? 'N/A' }}</div>
                      </td>
                      <td>
                        <div class="circle-{{ $row->us_world_rank != null ? 'c' : 'g' }}">
                          {{ $row->us_world_rank ?? 'N/A' }}
                        </div>
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  @if ($blogs->count() > 0)
    <section class="min-sec bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 col-md-12">
            <div class="sec-heading">
              <h2>Recent Articles</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 p-0">
            <div class="container">
              <div class="custom-tab customize-tab tabs_creative mb-0">
                <div class="tab-content" id="myTabContent" style="margin:0px -10px">
                  <div class="tab-pane fade active show pb-0" id="artical1" role="tabpanel"
                    aria-labelledby="artical1-tab" aria-expanded="true">
                    <div class="three_slide">
                      @foreach ($blogs as $row)
                        <div class="singles_items">
                          <div class="education_block_grid style_2">
                            <div class="education_block_thumb n-shadow">
                              <a href="{{ url($row->getCategory->category_slug . '/' . $row->slug) }}">
                                <img data-src="{{ asset($row->thumbnail_path) }}" class="img-fluid"
                                  alt="{{ $row->title }}">
                              </a>
                              <div class="cources_price">{{ $row->getCategory->category_name }}</div>
                            </div>
                            <div class="education_block_body">
                              <h4 class="bl-title">
                                <a
                                  href="{{ url($row->getCategory->category_slug . '/' . $row->slug) }}">{{ $row->title }}</a>
                              </h4>
                            </div>
                            <div class="cources_info_style3">
                              <ul>
                                <li><i class="ti-calendar mr-2"></i>24 Aug 22</li>
                                {{-- <li><i class="ti-eye mr-2"></i>55 Views</li>
                          <li><i class="ti-star text-warning mr-2"></i>4.7 Rating</li> --}}
                              </ul>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center"> <a href="{{ url('articles') }}" class="btn btn-modern float-none">
            View all Articals<span><i class="ti-arrow-right"></i></span> </a> </div>
      </div>
    </section>
  @endif

  <section class="bg-cover newsletter inverse-theme" data-overlay="8">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7 col-md-8 col-sm-12">
          <div class="text-center">
            <h2>Join Thousand of Happy Students!</h2>
            <p>Subscribe our newsletter & get latest news and updation!</p>
            <form class="sup-form"> <input type="email" class="form-control sigmup-me"
                placeholder="Your Email Address" required="required"> <input type="submit" class="btn btn-theme"
                value="Get Started"> </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Content -->
  <!-- Show more -->
  <script>
    function check() {
      var keyword = $("#search").val();
      //alert(keyword);
      //alert(`${start_date} ${to}`);
      if (keyword != '') {
        return new Promise(function(resolve, reject) {
          $('#searchBtn').text('Searching...');
          setTimeout(() => {
            $.ajax({
              url: "{{ url('search-university-and-program') }}",
              method: "GET",
              data: {
                keyword: keyword
              },
              success: function(data) {
                //alert(data);
                $(".sItems").show();
                $(".sItems").html(data);
                //$(".sItemsUl").html(data);
                $('#searchBtn').text('Search');
              }
            }).fail(err => {
              console('Failed');
            });
          }, 3000);
        });
      } else {
        $("#errsd").text('Please select start date');
      }
    }
  </script>
@endsection
