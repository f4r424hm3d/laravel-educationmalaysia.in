@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="image-cover half_banner"
    style="background:#0b2248 url(https://www.educationmalaysia.in/front/assets/img/universities-banner.jpg) no-repeat;">
    <div class="container">
      <!-- Type -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="banner-search-2 pt-heading">
            <h1 class="cl_2 mb-0">Services for <b class="theme-cl1"> Universities </b> </h1>
            <p>We exist to enroll the world's finest minds in substantial volumes, paving the way for the leaders of the
              future.</p>
            <p>In the current highly competitive global education arena, universities are ceaselessly venturing into
              creative avenues to entice elite students from around the world, and here we stand, bolstering their
              efforts.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <div class="container-fluid pt-2 pb-1" data-overlay="9">
    <div class="row align-items-center">
      <div class="col-lg-12 col-md-12">
        <div class="ed_detail_wrap light">
          <ul class="cources_facts_list">
            <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
            <li class="facts-1">Services for Universities</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Content -->
  <section class=" pb-0 service-section">
    <div class="container">
      <div class="cat-10 pl-4 pr-4">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <div id="carouselExampleControls" class="carousel slide service-slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="about-short">
                    <h3> Effortless Efficiency, <b class="theme-cl1"> Optimal Results</b></h3>
                    <hr>
                    <p class="mb-4">Receive thoroughly verified and complete applications from eligible students. Leave
                      the labor-intensive task of screening and verifying applications and documents to us, while you
                      prioritize what truly matters to you.</p>
                  </div>
                  <div class="about-short">
                    <h3> Market Insight and <b class="theme-cl1"> Strategy</b></h3>
                    <hr>
                    <p class="mb-4">We start by conducting in-depth market research to identify trends, preferences, and
                      key recruitment opportunities. Our team then formulates a customized strategy to help universities
                      reach their target audience effectively.</p>

                  </div>
                  <div class="about-short">
                    <h3> Brand <b class="theme-cl1"> Building </b></h3>
                    <hr>
                    <p class="mb-4">We dedicate our efforts to shaping our partner university's brand identity,
                      encompassing its mission, values, and key messages, ensuring alignment with institutional goals and
                      resonance with the intended audience</p>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Counseling <b class="theme-cl1"> Services </b></h3>
                    <hr>
                    <p class="mb-4">Our experienced counselors offer guidance to prospective students regarding
                      university choices, application procedures, scholarship opportunities, and visa requirements. </p>
                  </div>
                  <div class="about-short">
                    <h3>Digital Marketing <b class="theme-cl1"> Expertise </b></h3>
                    <hr>
                    <p class="mb-4">We employ cutting-edge digital marketing techniques to create online visibility and
                      reach prospective students encompassing social media campaigns, email marketing, and search engine
                      optimization to maximize engagement. </p>
                  </div>
                  <div class="about-short">
                    <h3>Lead Generation and <b class="theme-cl1"> Management </b></h3>
                    <hr>
                    <p class="mb-4">We specialize in lead generation and management, ensuring that universities have
                      access to a steady stream of potential applicants. Our lead nurturing strategies help universities
                      convert these prospects into enrolled students. </p>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Data-Driven <b class="theme-cl1"> Insights</b></h3>
                    <hr>
                    <p class="mb-4">We provide universities with regular data analysis and reporting, enabling them to
                      monitor the effectiveness of their recruitment strategies and make data-driven decisions for
                      continuous improvement.</p>
                  </div>
                  <div class="about-short">
                    <h3>On-the-Ground <b class="theme-cl1"> Presence</b></h3>
                    <hr>
                    <p class="mb-4">With physical counseling centers in strategic locations, we ensure that students
                      have access to support in their home countries, enhancing the personal touch in the recruitment
                      process.</p>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev slick-next slick-icon slick-arrow" href="#carouselExampleControls"
                role="button" data-slide="prev">
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next slick-next slick-icon slick-arrow" href="#carouselExampleControls"
                role="button" data-slide="next">
                <span class="sr-only">Next</span>
              </a>

            </div>
          </div>
          <div class="col-lg-5">
            <div class="list_facts_wrap_img ser image-services"><img
                data-src="https://www.educationmalaysia.in/front/assets/img/universities-service.png" class="img-fluid"
                alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="strengths core-section  "
    style="background:url(https://www.educationmalaysia.in/front/assets/img/testimonial.png)">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12 text-center">
          <h2>Our Core Strengths</h2>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-lg-4 text-center">
          <h3 class="orange">700+</h3>
          <h4>Global University Tie Ups</h4>
          <p class="text-center">Our students aren’t just pursuing their higher education, but their dreams and ambitions
            in eminent universities across the globe</p>
        </div>

        <div class="col-lg-4 text-center">
          <h3 class="green">65+</h3>
          <h4>Offices across the Globe</h4>
          <p class="text-center">We’re growing, we’re expanding and we’re doing that fast! Join the fastest growing
            EdTech brand in South and South-East Asia.</p>
        </div>

        <div class="col-lg-4 text-center">
          <h3 class="blue">25+</h3>
          <h4>Years of Industry Presence</h4>
          <p class="text-center">With over two decades of industry expertise, we know what’s best for you and that makes
            us really good at what we do!</p>
        </div>
      </div>

    </div>
  </section>
  <section class="bg-light-1 offerings-section">
    <div class="container">

      <div class="row mb-2">
        <div class="col-lg-12 col-sm-12 text-center service-heading-pb">
          <h2>Britannica <span class="theme-cl1">Services & </span> Offerings</h2>
        </div>
      </div>

      <div class="edu_cat_2 cat-10 pl-4 pr-4">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <div class="about-short">
              <h3> Services For <b class="theme-cl1">Students</b></h3>
              <p class="mb-4">Our services are designed to be comprehensive, empowering you to navigate every step of
                the
                study abroad journey with confidence and success.</p>

              <h5 class="mb-3">Offerings</h5>
              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Virtual Coaching & Expert-Led Premium Admission Consultation</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Facilitating High-Value Scholarships and Study Loans</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Assistance with Applications, Admissions, and Visas</h4>
                </span>
              </span>

              <a href="student-services" class="btn btn-modern float-left mt-3">Know More<span><i
                    class="fa fa-angle-right"></i></span></a>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="list_facts_wrap_img"><img
                data-src="https://www.educationmalaysia.in/front/assets/img/student2.png" class="img-fluid"
                alt="">
            </div>
          </div>
        </div>
      </div>

      <div class="edu_cat_2 cat-3 pl-4 pr-4">
        <div class="row align-items-center">

          <div class="col-lg-5">
            <div class="list_facts_wrap_img"><img
                data-src="https://www.educationmalaysia.in/front/assets/img/partners.png" class="img-fluid"
                alt="">
            </div>
          </div>

          <div class="col-lg-7">
            <div class="about-short">
              <h3>Services For <b class="theme-cl1">Partners</b></h3>
              <p class="mb-4"><em><b>"Your Success is Our Only Benchmark"</b></em> Partner with our experts and
                cutting-edge tech solutions to discover their game-changing impact on your business.</p>

              <h5 class="mb-3">Offerings</h5>
              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Customized business solutions Tailored to your Market</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Comprehensive Support for Operations, Events, and Marketing</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Access to Britannica's extensive Knowledge Repository</h4>
                </span>
              </span>

              <a href="partner-services" class="btn btn-modern float-left mt-3">Know More<span><i
                    class="fa fa-angle-right"></i></span></a>
            </div>
          </div>

        </div>
      </div>

      <div class="edu_cat_2 cat-4 pl-4 pr-4">
        <div class="row align-items-center">

          <div class="col-lg-7">
            <div class="about-short">
              <h3>Services For <b class="theme-cl1">Franchisees</b></h3>
              <p class="mb-4">At Education Malaysia Education, we understand the unique needs and challenges faced by
                our franchisees. We are dedicated to providing comprehensive support and resources to ensure your success
                as a franchise partner.</p>

              <h5 class="mb-3">Offerings</h5>
              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Business solutions tailor made for your market</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Support for Operations, Events and Marketing</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Access to Britannica's rich Knowledge Repository</h4>
                </span>
              </span>

              <a href="franchise-services" class="btn btn-modern float-left mt-3">Know More<span><i
                    class="fa fa-angle-right"></i></span></a>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="list_facts_wrap_img"><img
                data-src="https://www.educationmalaysia.in/front/assets/img/franchise.png" class="img-fluid"
                alt="">
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <section class="bg-light lets-helps">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="sec-heading center">
            <h2>Let’s <span class="theme-cl1"> help you live</span> your dream</h2>
          </div>
        </div>
      </div>
      @if ($destinations->count() > 0)
        <div class="row mt-3 arrow_slide five_slide arrow_middle _wrk_prc_wrap active bg-white">
          @foreach ($destinations as $row)
            <div class="singles_items">
              <div class="card shadow-0 mb-0">
                <img data-src="{{ asset($row->thumbnail_path) }}" class="img-fluid" alt="{{ $row->destination_name }}">
                <div class="card-header bg-light border-0 pl-4 pr-4">
                  <h4 class="text-center" style="font-size:15px; font-weight:600;">Study in {{ $row->destination_name }}
                  </h4>
                  <a href="{{ url($row->destination_slug) }}" class="btn btn_apply w-100" style="height:40px">View
                    Details</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif

      <div class="row justify-content-center mt-4">
        <a href="{{ url('cities') }}" class="btn btn-modern float-none">View all Destinations<span><i
              class="fa fa-angle-right"></i></span></a>
      </div>
    </div>
  </section>

  <section class="new-testi student-saying hide-this">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12 text-center">
          <h2>What our <span class="theme-cl1">students</span> are saying</h2>
        </div>
      </div>

      <div class="row mt-3 edu_cat_2 cat-3">
        <div class="col-lg-3 rating-box">
          <div class="rating _wrk_prc_wrap active">
            <p>42,150+ reviews</p>
            <div class="testi-rate">
              <i class="fa fa-star filled"></i>
              <i class="fa fa-star filled"></i>
              <i class="fa fa-star filled"></i>
              <i class="fa fa-star filled"></i>
              <i class="fa fa-star filled"></i>
            </div>
            <h3>4.9/5</h3>
            <div class="row justify-content-center"><a href="#" class="btn btn-modern float-none">Get free
                counselling <span><i class="fa fa-angle-right"></i></span></a></div>
          </div>
        </div>

        <div class="col-lg-9 text-center">
          <div class="reviews_third" id="reviews-slide">

            <div class="testimonial-wraps">
              <div class="testimonial-icon">
                <div class="testimonial-icon-thumb"><span class="quotes"><i class="fas fa-quote-left"></i></span></div>
                <h4>Student Name</h4>
              </div>
              <div class="facts-detail">
                <p>Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem
                  velit nisi.</p>
                <h5>Student from Delhi</h5>
              </div>
            </div>

            <div class="testimonial-wraps">
              <div class="testimonial-icon">
                <div class="testimonial-icon-thumb"><span class="quotes"><i class="fas fa-quote-left"></i></span></div>
                <h4>Student Name</h4>
              </div>
              <div class="facts-detail">
                <p>Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem
                  velit nisi.</p>
                <h5>Student from Delhi</h5>
              </div>
            </div>

            <div class="testimonial-wraps">
              <div class="testimonial-icon">
                <div class="testimonial-icon-thumb"><span class="quotes"><i class="fas fa-quote-left"></i></span></div>
                <h4>Student Name</h4>
              </div>
              <div class="facts-detail">
                <p>Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem
                  velit nisi.</p>
                <h5>Student from Delhi</h5>
              </div>
            </div>

            <div class="testimonial-wraps">
              <div class="testimonial-icon">
                <div class="testimonial-icon-thumb"><span class="quotes"><i class="fas fa-quote-left"></i></span></div>
                <h4>Student Name</h4>
              </div>
              <div class="facts-detail">
                <p>Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem
                  velit nisi.</p>
                <h5>Student from Delhi</h5>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </section>

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
                    <div class="arrow_slide three_slide arrow_middle">
                      @foreach ($blogs as $row)
                        <!-- Single Slide -->
                        <div class="singles_items">
                          <div class="education_block_grid style_2">
                            <div class="education_block_thumb n-shadow">
                              <a href="{{ url($row->slug) }}"><img data-src="{{ asset($row->thumbnail_path) }}"
                                  class="article-img" alt="{{ $row->title }}"></a>
                              <div class="cources_price">{{ $row->getCategory->category_name }}</div>
                            </div>
                            <div class="education_block_body">
                              <h4 class="bl-title"><a href="{{ url($row->slug) }}">{{ $row->title }}</a></h4>
                            </div>
                            <div class="cources_info_style3">
                              <ul>
                                <li><i class="ti-calendar mr-2"></i>{{ getFormattedDate($row->created_at, 'd M, Y') }}
                                </li>
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
        <div class="row justify-content-center">
          <a href="{{ url('/articles') }}" class="btn btn-modern float-none">View all Articals<span><i
                class="fa fa-angle-right"></i></span></a>
        </div>
      </div>
    </section>
  @endif

  <!-- Content -->
@endsection
