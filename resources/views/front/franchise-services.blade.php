@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="image-cover half_banner"
    style="background:#0b2248 url(https://www.educationmalaysia.in/front/assets/img/banner-1.jpg) no-repeat;">
    <div class="container">
      <!-- Type -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="banner-search-2 pt-heading">
            <h1 class="cl_2 mb-0">Services for <b class="theme-cl1"> Franchises</b> </h1>
            <p>“Our franchisees are the heart of our brand, and we're committed to nurturing your success every step of
              the way”</p>
            <p>Collaborate with the leading overseas Ed Tech Firm, experiencing rapid growth and unwavering credibility,
              to ignite your business endeavors. Joining our experienced team and utilizing our resources will enable you
              to position your business for remarkable success and a promising future in the education industry.</p>
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
            <li class="facts-1">Services for students</li>
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
                    <h3> Training and <b class="theme-cl1">Education</b></h3>
                    <hr>
                    <p class="mb-4">We provide the vital support, guidance, and training needed to turn dreams into
                      thriving businesses.</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Training programs</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Product knowledge</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Customer service training</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Operational procedure training</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Sales training</h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3> Marketing and <b class="theme-cl1">Branding</b></h3>
                    <hr>
                    <p class="mb-4">We understand the power of a strong brand, and they stand by their franchisees,
                      offering the marketing and branding support necessary to paint a vivid picture of success in the
                      market.</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>National or regional marketing campaigns</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Marketing materials</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Branding consistency</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Advertising guidance</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Local marketing support</h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3> Operations and <b class="theme-cl1">Logistic</b></h3>
                    <hr>
                    <p class="mb-4">Guiding our franchisees through operations and logistics, paving the way for
                      seamless business growth</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Site selection assistance</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Lease negotiation support</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Supply chain and procurement help</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Technology and systems access</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Quality control procedures</h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3> Hosting Events and <b class="theme-cl1"> Promotions </b></h3>
                    <hr>
                    <p class="mb-4">We've expanded our services to bolster our partners' student recruitment in
                      international education, whether virtually or in person. </p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Virtual and In-Person Education Expos</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Admission Week Activities and On-the-Spot Evaluations</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>University Representatives Visiting Your Offices</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Virtual Marketing Initiatives & Web Chat Support</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Online Informational Seminars and Workshops</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4> Virtual Campus Tours & Specialized Online Resources</h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Ongoing Support and <b class="theme-cl1"> Communication</b></h3>
                    <hr>
                    <p class="mb-4">We provide unwavering support and clear lines of communication that ensure our
                      franchisees thrive through every twist and turn of the business journey.</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Field support visits</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Regular communication</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Access to support teams</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Research and development updates</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Compliance with legal and regulatory requirements</h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Financial and <b class="theme-cl1">Networking Support</b></h3>
                    <hr>
                    <p class="mb-4">We offer a helping hand and fostering a network of support that transforms dreams
                      into profitable ventures.</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Financial assistance or incentives</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Access to financing options</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Networking opportunities with other franchisees</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Collaboration with other franchisees</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Sharing best practices within the franchise system</h4>
                      </span>
                    </span>
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
                data-src="https://www.educationmalaysia.in/front/assets/img/franchises-service.png" class="img-fluid"
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

      <div class="edu_cat_2 cat-6 mb-0 pl-4 pr-4">
        <div class="row align-items-center">

          <div class="col-lg-7">
            <div class="about-short">
              <h3>Services For <b class="theme-cl1">Universities</b></h3>
              <p class="mb-4">At Education Malaysia Education, we take pride in being a bridge between universities
                and international students. Our dedication to facilitating academic pursuits has made us a reliable
                partner for universities worldwide.</p>

              <h5 class="mb-3">Assistances</h5>
              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Enroll students from various nationalities</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Leverage Britannica's vast recruitment network</h4>
                </span>
              </span>

              <span class="list_facts">
                <span class="list_facts_icons"><i class="ti-star"></i></span>
                <span class="list_facts_caption">
                  <h4>Amplify brand visibility and recognition</h4>
                </span>
              </span>

              <a href="universities-services" class="btn btn-modern float-left mt-3">Know More<span><i
                    class="fa fa-angle-right"></i></span></a>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="list_facts_wrap_img"><img
                data-src="https://www.educationmalaysia.in/front/assets/img/university2.png" class="img-fluid"
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
