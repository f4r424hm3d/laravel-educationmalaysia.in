@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
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
  <div class="image-cover half_banner"
    style="background:#0b2248 url(https://www.educationmalaysia.in/front/assets/img/students-banner.jpg) no-repeat;">
    <div class="container">
      <!-- Type -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="banner-search-2 pt-heading">
            <h1 class="cl_2 mb-0">Services for <b class="theme-cl1"> Students </b> </h1>
            <h4>Your Journey to a Prestigious Global University Starts Here!</h4>
            <p>Your career goals are our priority, and we're dedicated to connecting you with the finest global
              universities. Join the countless successful students who are already realizing their academic dreams at
              renowned international schools. Your journey begins now!</p>
            <strong>Why Britannica</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid pt-2 pb-1" data-overlay="9">
    <div class="row align-items-center">
      <div class="col-lg-12 col-md-12">
        <div class="ed_detail_wrap light">
          <ul class="cources_facts_list">
            <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
            <li class="facts-1">Services for Students</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <section class=" pb-0 service-section">
    <div class="container">
      <div class="cat-10 pl-4 pr-4">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <div id="carouselExampleControls" class="carousel slide service-slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="about-short">
                    <h3> 46 Countries & 1200+ University <b class="theme-cl1">Tie-Ups</b></h3>
                    <hr>
                    <p class="mb-4">With countless possibilities, let us help you discover the ideal fit for you</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Assisting through the Process</h4>
                        <p>We stand with you, providing unwavering support from your first inquiry to your arrival at your
                          desired university.</p>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Our records demonstrate our excellence</h4>
                        <p>Our history is marked by the success stories of countless students who have made it to their
                          dream universities.</p>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3> How do we aid students in <b class="theme-cl1"> their journey?</b></h3>
                    <h4>Personalized Counseling </h4>
                    <hr>
                    <p class="mb-4">"We assure you that our counseling sessions will significantly aid you in selecting
                      the academic path that best suits your career goals."</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Personalized Career-Centric Guidance</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Shaping Your Future with Trendsetting Courses and Careers</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Direct Interactions with University Delegates</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4> Career Path Exploration </h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Education and Career Goal Alignment </h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3> Test <b class="theme-cl1">Training</b></h3>
                    <hr>
                    <p class="mb-4">Achieve your highest potential test scores effortlessly with the guidance of our
                      certified, highly skilled, and dedicated tutors, who will expertly help you prepare for the tests
                      you aim for.</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Personalized Study Plans and One-on-One Tutoring </h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Interactive Virtual Classrooms with No-Cost Preview Sessions</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Simplified yet Exceptionally Effective Study Materials</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Tutorials and Practice Exams Geared Toward Achieving High Scores</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Progress Tracking and Improvement Strategic sessions </h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Picking the Right Course, Country, and <b class="theme-cl1"> University </b></h3>
                    <hr>
                    <p class="mb-4">We assist you in selecting the perfect course, university, and country that align
                      with your career goals, academic aspirations, and financial considerations. </p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Opt for well-informed academic and career choices.</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Analyze universities based on their rankings, available courses, and scholarship offerings.
                        </h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Explore course options at over 1200+ universities across 46 different countries</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Evaluating Admission Requirements, Location and Environment</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Assessing Cost of Living, Tuition and Work plus Study opportunities </h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Enrolment and <b class="theme-cl1"> Acceptance</b></h3>
                    <hr>
                    <p class="mb-4">Make the right intake selection, submit your applications in a timely and strategic
                      manner to the courses and universities that best match your aspirations, and watch admission offers
                      come quickly.</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Seamless applications for guaranteed admissions</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Supported by Top-notch SOPs, LORs, and Resumes</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Live application tracking and ongoing interaction with educational institutions</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Interview preparation through Mock sessions</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Timeline and Deadlines Management </h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Scholarships and <b class="theme-cl1">Grants</b></h3>
                    <hr>
                    <p class="mb-4">Among our worldwide network of universities, numerous scholarships are available
                      and We'll guide you in identifying and applying for the scholarships that align most with your
                      achievements.</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Access to Searchable Scholarship Databases </h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Customized Scholarship Matching </h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Profile Creation and Management </h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Step-by-step instructions on applying for scholarships</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Support for enhancing scholarship essays</h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Apprenticeships</h3>
                    <hr>
                    <p class="mb-4">Recognizing the importance of apprenticeships in shaping your profile, our course
                      recommendations are brimming with options that offer built-in internship experiences.</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Internship/apprenticeship Search. </h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Receive advice on paid and unpaid internship opportunities </h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Familiarize yourself with placement durations and stipend details </h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Work place etiquette and Soft Skills Training </h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Post Internship Transition Support </h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Education <b class="theme-cl1">Loan</b> </h3>
                    <hr>
                    <p class="mb-4">Securing a student loan to enroll in your dream university has become more
                      accessible than ever!</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Loan Counseling and Loan Comparison Tools </h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4> Study loans available from all major Banks and NBFCs </h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Tailored financial structuring to match your university requirements.</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Smooth and stress-free documentation process </h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Emergency Assistance and Loan Refinancing guidance </h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Visa <b class="theme-cl1">Process</b> </h3>
                    <hr>
                    <p class="mb-4">Our proficient visa specialists will assist you in organizing and submitting your
                      visa paperwork to Embassies and High Commissions, guaranteeing swift and successful visa approvals.
                    </p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Exceptional Support for Visa Documentation </h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Consistently High Visa Approval Rates Worldwide</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Simulated Visa Interviews for Practice</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4> Travel and Accommodation Assistance </h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Status Tracking and Post Visa Support </h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Pre Travel <b class="theme-cl1">Services </b> </h3>
                    <hr>
                    <p class="mb-4">Pre-travel services equip students with the tools to navigate the path to a foreign
                      land and seamlessly integrate into a new academic and cultural landscape.</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Travel and Immigration Assistance </h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Airport Pickup, Housing and Accommodation support</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Pre-Departure Orientation sessions</h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4> Social and Cultural Integration training </h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Student Community Building </h4>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="about-short">
                    <h3>Supportive <b class="theme-cl1">Services </b> </h3>
                    <hr>
                    <p class="mb-4">Complementary services are instrumental in ensuring the success of international
                      students in their overseas studies. We have further streamlined this process by offering amenities
                      like arranging Medical Insurance, Remittance process, Education Loan and Forex to make transactions
                      in foreign currencies.</p>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Leverage exchange rates in your favor </h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Opt for the lowest premium with maximum coverage</h4>
                      </span>
                    </span>

                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Counseling and Mental Health Services </h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Career and Academic advising </h4>
                      </span>
                    </span>
                    <span class="list_facts">
                      <span class="list_facts_icons"><i class="ti-star"></i></span>
                      <span class="list_facts_caption">
                        <h4>Permanent Residency support </h4>
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
                data-src="https://www.educationmalaysia.in/front/assets/img/student2.png" class="img-fluid"
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
            <div class="list_facts_wrap_img"><img
                data-src="https://www.educationmalaysia.in/front/assets/img/franchise.png" class="img-fluid"
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
                    class="ti-arrow-right"></i></span></a>
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
                    class="ti-arrow-right"></i></span></a>
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
              class="ti-arrow-right"></i></span></a>
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
                class="ti-arrow-right"></i></span></a>
        </div>
      </div>
    </section>
  @endif
@endsection
