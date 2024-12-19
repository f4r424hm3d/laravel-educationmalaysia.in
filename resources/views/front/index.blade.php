@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Top header-->
  <!-- Content -->
  <!-- ============================ Hero Banner  Start================================== -->
  <div class="image-cover hero_banner hero-inner-2 shadow rlt" data-overlay="7">
    <div id="main-banner" class="arrow_slide one_slide-dots arrow_middle">
      <div class="singles_items" style="background:url({{ url('/front/') }}/assets/img/banner-2.jpg) no-repeat;"
        data-overlay="7"></div>
      <div class="singles_items" style="background:url({{ url('/front/') }}/assets/img/banner-3.jpg) no-repeat;"
        data-overlay="7"></div>
    </div>
    <div class="container text-center" style="position:absolute">
      <div class="hero-caption mb-2">
        <h1 class="big-header-capt cl_2 mb-0">Education Malaysia Education Your Gateway to Global Education</h1>
        <p class="text-center">Welcome to Education Malaysia Education, your trusted partner in realizing your dreams of
          pursuing world-class education. We take immense pride in being the bridge that connects you to an array of
          global opportunities in education.</p>
      </div>
      <!-- Type -->
      <div class="row justify-content-center">
        <div class="col-lg-9 col-md-12 col-sm-12">
          <div class="banner-search shadow_high">
            <div class="search_hero_wrapping">
              <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-9 col-9 pr-0">
                  <div class="form-group">
                    <div class="input-with-icon">
                      {{-- <input type="file" capture="enviroment" accept="image/*"> --}}
                      <input type="text" id="search" class="form-control"
                        placeholder="Search Universities and programs" />
                      <img data-src="{{ asset('front/') }}/assets/img/search.svg" class="search-icon" alt="" />
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 pl-0 col-3">
                  <div class="form-group none">
                    <a onclick="check()" href="javascript:void()" class="btn search-btn full-width"
                      id="searchBtn">Search</a>
                  </div>
                </div>
              </div>

              <div class="sItems" style="display:none">
                <ul class="sItemsUl">
                </ul>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ============================ Hero Banner End ================================== -->
  <!-- ============================ Trips Facts Start ================================== -->
  <div class="trips_wrap full colored">
    <div class="container">
      <div class="row m-0">

        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="trips">
            <div class="trips_icons">
              <i class="ti-video-camera"></i>
            </div>
            <div class="trips_detail">
              <h4>8 Glorious Years</h4>
              <p>With years of expertise, we have established ourselves as a reliable and all-encompassing provider of
                educational services.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="trips">
            <div class="trips_icons">
              <i class="ti-medall"></i>
            </div>
            <div class="trips_detail">
              <h4>Partner of over 1200 Universities</h4>
              <p>We take immense pride in being the bridge that connects you to an array of global opportunities in
                education.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="trips none">
            <div class="trips_icons">
              <i class="ti-infinite"></i>
            </div>
            <div class="trips_detail">
              <h4>50+ Global Offices (Own + Franchise)</h4>
              <p>We are dedicated to assisting students from every corner of the globe in realizing and accomplishing
                their academic aspirations.</p>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="row justify-content-center mt-3 mb-3 text-center">
      <div class="col-lg-9 col-md-12 col-sm-12">
        <a href="{{ url('/sign-up/?return_to=') }}"
          style="background: #252c41"class=" banner-center-btn btn-modern dark rounded">Need Help? Get 1 on 1
          counselling</a>
      </div>
    </div>
  </div>
  <!-- ============================ Trips Facts Start ================================== -->

  <!-- ============================ Trips Facts Start ================================== -->
  <section class="we-offer-area text-center bg-gray">
    <div class="container">
      <div class="sec-heading center">
        <h2>How <span class="theme-cl1">Do We</span> Work</h2>
      </div>
      <div class="row three_slide-dots">
        <div class="item singles_item" style="height:400px;">
          <i class="fas fa-pen-fancy"></i>
          <h4>Register Yourself / Sign Up</h4>
          <p>Ready to begin your academic journey? Our educational counseling services are tailored to empower you with
            the confidence and clarity needed to achieve your goals—just register for a counseling session with us to get
            started.</p>
        </div>
        <div class="item singles_item" style="height:400px;">
          <i class="fas fa-comment fa-comments"></i>
          <h4>Test Preparation</h4>
          <p>Standardized test preparation is a pivotal component of your study abroad path, and our counselors are wholly
            committed to your success. We start by evaluating your academic history, English skills, and your chosen
            universities' criteria to identify the ideal tests for you.</p>
        </div>
        <div class="item singles_item" style="height:400px;">
          <i class="fas fa-file-alt"></i>
          <h4>Academic Planning for Goal Clarity</h4>
          <p>Once we've established your educational objectives, we assist you in selecting the right academic programs,
            universities, and countries that align with your goals, providing the clarity you need for informed decisions
            about study options, scholarships, and career prospects.</p>
        </div>
        <div class="item singles_item" style="height:400px;">
          <i class="fas fa-building"></i>
          <h4>University Shortlist</h4>
          <p>Our mission is to empower you with the knowledge and guidance needed to craft a tailored university shortlist
            that aligns with your academic and career aspirations, recognizing the uniqueness of your dreams and
            supporting you on this exciting journey.</p>
        </div>
        <div class="item singles_item" style="height:400px;">
          <i class="fas fa-folder-open"></i>
          <h4>Document Guidance</h4>
          <p>Embarking on the journey of applying to international universities entails a meticulous documentation
            process, from providing document guidance to crafting outstanding SOPs, LORs, and resumes, we're your partners
            in this essential endeavor.</p>
        </div>
        <div class="item singles_item" style="height:400px;">
          <i class="fas fa-address-card"></i>
          <h4>Application Submission and Tracking</h4>
          <p>Our counselors ensure the smooth submission of your university applications with well-organized and punctual
            document submissions, supported by our user-friendly real-time application tracking system to maintain
            accuracy and meet deadlines.</p>
        </div>
        <div class="item singles_item" style="height:400px;">
          <i class="fas fa-wallet"></i>
          <h4>Finances Planning</h4>
          <p>Beyond academic dreams, studying abroad demands sound financial planning. Our counselors help with financial
            assessments, scholarship exploration, application guidance, budgeting, loan advice, and continuous support
            throughout your educational journey.</p>
        </div>
        <div class="item singles_item" style="height:400px;">
          <i class="fas fa-passport"></i>
          <h4>Effortless Visa Support</h4>
          <p>Visa application is a pivotal part of your study abroad journey, and our seasoned counselors are here to
            ensure a seamless process. We offer Visa Guidance, Application Support, and Interview Preparation to make your
            transition as smooth as possible.</p>
        </div>
        <div class="item singles_item" style="height:400px;">
          <i class="fas fa-plane-departure"></i>
          <h4>Post Visa Support</h4>
          <p>Our dedication extends beyond the visa; we're here to support you through your entire study abroad journey,
            providing Pre-Departure Briefing, Cultural Integration, and Ongoing Assistance. Your success and well-being
            remain our foremost concerns.</p>
        </div>
        <div class="item singles_item" style="height:400px;">
          <i class="fas fa-headphones-alt"></i>
          <h4>Talk to Counselor</h4>
          <p>Unlock the power of personalized guidance, steering students toward their dreams in international education.
            Whether it's choosing studies, scholarships, or careers, our counseling sessions illuminate the path to
            informed decisions</p>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-light">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="about-short">
            <div class="sec-heading">
              <h2>Few <span class="theme-cl1">Facts</span> About Us</h2>
            </div>
            <p>Education Malaysia Education is your gateway to international education on a global stage. With over 8
              years of expertise, we have established ourselves as a reliable and all-encompassing provider of educational
              services. We are dedicated to assisting students from every corner of the globe in realizing and
              accomplishing their academic aspirations. Our team of experienced consultants deeply comprehends the
              profound impact of education as a transformative experience. We provide customized guidance to aid you in
              selecting the perfect program and institution, streamlining the application procedure, and guaranteeing a
              smooth transition to your overseas studies.</p>
            <div class="cource_facts">
              <ul>
                <li><span class="theme-cl1">500+</span>Universities</li>
                <li><span class="theme-cl1">150K+</span>Courses</li>
                <li><span class="theme-cl1">800+</span>Applications Made</li>
              </ul>
            </div>
            <a href="about" class="btn btn-modern float-left">Know More<span><i
                  class="ti-arrow-right"></i></span></a>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="list_facts_wrap_img"><img data-src="{{ url('front/') }}/assets/img/edu_2.png" class="img-fluid"
              alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-light-1 pb-0">
    <div class="container">

      <div class="row mb-2">
        <div class="col-lg-12 col-sm-12 text-center">
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
                    class="ti-arrow-right"></i></span></a>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="list_facts_wrap_img"><img data-src="{{ url('front/') }}/assets/img/student2.png"
                class="img-fluid" alt="">
            </div>
          </div>
        </div>
      </div>

      <div class="edu_cat_2 cat-3 pl-4 pr-4">
        <div class="row align-items-center">

          <div class="col-lg-5">
            <div class="list_facts_wrap_img"><img data-src="{{ url('front/') }}/assets/img/partners.png"
                class="img-fluid" alt="">
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
                    class="ti-arrow-right"></i></span></a>
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
                    class="ti-arrow-right"></i></span></a>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="list_facts_wrap_img"><img data-src="{{ url('front/') }}/assets/img/franchise.png"
                class="img-fluid" alt="">
            </div>
          </div>

        </div>
      </div>

      <div class="edu_cat_2 cat-6 mb-0 pl-4 pr-4">
        <div class="row align-items-center">

          <div class="col-lg-5">
            <div class="list_facts_wrap_img"><img data-src="{{ url('front/') }}/assets/img/university2.png"
                class="img-fluid" alt="">
            </div>
          </div>

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
                    class="ti-arrow-right"></i></span></a>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>

  <section class="bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 mb-3">
          <div class="sec-heading center">
            <h2>Study <span class="theme-cl1">Abroad Exams</span> with Britannica</h2>
          </div>
        </div>
      </div>

      <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="education_block_grid style_2 mb-4">
            <div class="education_block_body">
              <div class="course-short">IELTS</div>
              <h4 class="bl-title">International English Language Testing System</h4>
            </div>
            <div class="cources_info_style3">
              <p class="mb-0">International English Language Testing System (IELTS) is an international standardized
                test that measures the level...</p>
            </div>
            <div class="education_block_footer align-items-center p-3">
              <div class="education_block_author"><a href="{{ url('/exam/ielts/overview') }}" class="card-btn">Click
                  more info <i class="fa fa-arrow-right ml-1"></i></a></div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="education_block_grid style_2 mb-4">
            <div class="education_block_body">
              <div class="course-short">TOEFL</div>
              <h4 class="bl-title">Test of English as a Foreign Language</h4>
            </div>
            <div class="cources_info_style3">
              <p class="mb-0">Test of English as a Foreign Language (TOEFL) is an international standardised test
                conducted to assess the level of English fluency of non-native speakers...</p>
            </div>
            <div class="education_block_footer align-items-center p-3">
              <div class="education_block_author"><a href="{{ url('/exam/toefl/overview') }}" class="card-btn">Click
                  more info <i class="fa fa-arrow-right ml-1"></i></a></div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="education_block_grid style_2 mb-4">
            <div class="education_block_body">
              <div class="course-short">PTE</div>
              <h4 class="bl-title">Pearson Test of English [PTE]</h4>
            </div>
            <div class="cources_info_style3">
              <p class="mb-0">PTE (Pearson Test of English) is an English language proficiency test conducted by
                Pearson PCL group in association with Edexcel. Any person whose na...</p>
            </div>
            <div class="education_block_footer align-items-center p-3">
              <div class="education_block_author"><a href="{{ url('/exam/pte/overview') }}" class="card-btn">Click
                  more info <i class="fa fa-arrow-right ml-1"></i></a></div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="education_block_grid style_2 mb-4">
            <div class="education_block_body">
              <div class="course-short">NHS</div>
              <h4 class="bl-title">National Health Service (NHS) In UK</h4>
            </div>
            <div class="cources_info_style3">
              <p class="mb-0">NHS—The National Health Service is the United Kingdom’s publicly funded healthcare
                system. NHS UK stands for the National Health Service of the United Kingdom...</p>
            </div>
            <div class="education_block_footer align-items-center p-3">
              <div class="education_block_author"><a href="{{ url('/exam/nhs/overview') }}" class="card-btn">Click
                  more info <i class="fa fa-arrow-right ml-1"></i></a></div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="education_block_grid style_2 mb-4">
            <div class="education_block_body">
              <div class="course-short">GMAT</div>
              <h4 class="bl-title">GMAT Exam Test</h4>
            </div>
            <div class="cources_info_style3">
              <p class="mb-0">Graduate Management Admission Test (GMAT) is conducted by GMAC for admission to nearly
                5400 management courses in various Business...</p>
            </div>
            <div class="education_block_footer align-items-center p-3">
              <div class="education_block_author"><a href="{{ url('/exam/gmat/overview') }}" class="card-btn">Click
                  more info <i class="fa fa-arrow-right ml-1"></i></a></div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="education_block_grid style_2 mb-4">
            <div class="education_block_body">
              <div class="course-short">OET</div>
              <h4 class="bl-title">Occupational English Test</h4>
            </div>
            <div class="cources_info_style3">
              <p class="mb-0">OET Test is considered as a verification of the candidate’s ability to communicate
                effectively in different organizations including Hospitals & Universities.</p>
            </div>
            <div class="education_block_footer align-items-center p-3">
              <div class="education_block_author"><a href="{{ url('/exam/oet/overview') }}" class="card-btn">Click
                  more info <i class="fa fa-arrow-right ml-1"></i></a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <a href="{{ url('exams') }}" class="btn btn-modern float-none">View all Exams<span><i
              class="ti-arrow-right"></i></span></a>
      </div>
    </div>
  </section>

  <section class="new-testi hide-this">
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
                counselling <span><i class="ti-arrow-right"></i></span></a></div>
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
                    <div class="three_slide">
                      @foreach ($blogs as $row)
                        <!-- Single Slide -->
                        <div class="singles_items">
                          <div class="education_block_grid style_2">
                            <div class="education_block_thumb n-shadow">
                              <a
                                href="{{ route('blog.detail', ['category_slug' => $row->category->slug, 'slug' => $row->slug . '-' . $row->id]) }}">
                                <img data-src="{{ asset($row->imgpath) }}" class="article-img"
                                  alt="{{ $row->headline }}">
                              </a>
                              <div class="cources_price"><a
                                  href="{{ route('blog.category', ['category_slug' => $row->category->slug]) }}">{{ $row->category->cate_name }}</a>
                              </div>
                            </div>
                            <div class="education_block_body">
                              <h4 class="bl-title">
                                <a
                                  href="{{ route('blog.detail', ['category_slug' => $row->category->slug, 'slug' => $row->slug . '-' . $row->id]) }}">{{ $row->headline }}
                                </a>
                              </h4>
                            </div>
                            <div class="cources_info_style3">
                              <ul>
                                <li><i class="ti-calendar mr-2"></i>{{ getFormattedDate($row->created_at, 'd M, Y') }}
                                </li>
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
          <a href="{{ route('blog') }}" class="btn btn-modern float-none">View all Articals<span><i
                class="ti-arrow-right"></i></span></a>
        </div>
      </div>
    </section>
  @endif
  <!-- ============================== Start Newsletter ================================== -->
  <section class="bg-cover newsletter inverse-theme" style="background:url({{ url('/front/') }}/assets/img/bg-sv.svg);"
    data-overlay="9">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7 col-md-8 col-sm-12">
          <div class="text-center">
            <h2>Join Thousand of Happy Students!</h2>
            <p class="text-center">Subscribe our newsletter & get latest news and updation!</p>
            <form class="sup-form">
              <input type="email" class="form-control sigmup-me" placeholder="Your Email Address"
                required="required">
              <input type="submit" class="btn btn-theme" value="Get Started">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ============== End Newsletter ===================-->
  <!-- Content -->
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
