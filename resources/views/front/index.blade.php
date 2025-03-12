@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Top header-->
  <!-- Content -->
  <!-- ============================ Hero Banner  Start================================== -->
  <!-- first section start  -->
  <section class="main-sliderss">
    <div class="content">
      <div class="slider secondheader">
        <div>
          <h3>
            <div class="slidd">
              <img class="img-fluid" src="https://educationmalaysia.in/uploads/files/banner1_1741674968.webp"
                alt="First slide">
              <div class="slidersshome">
                <div class="text-center mainsliders">
                  <h3 class="elh-banner-title">Education Roadmap: From Admissions to Community Connection
                  </h3>
                  <p>Navigate admissions, access essential resources, and connect with our vibrant
                    community for a fulfilling academic journey in Malaysia.</p>
                  <a href="{{ url('specialization') }}" class="slider-btn">Know More</a>
                </div>
              </div>
            </div>
          </h3>
        </div>
        <div>
          <h3>
            <div class="slidd">
              <img class="img-fluid" src="https://educationmalaysia.in/uploads/files/banner1_1741674968.webp"
                alt="First slide">
              <div class="slidersshome">
                <div class="text-center mainsliders">
                  <h3 class="elh-banner-title">Welcome to the premier platform for academic excellence in
                    Malaysia!</h3>
                  <p>
                    Explore top-tier universities and colleges known for academic excellence and
                    innovation.
                  </p>
                  <a href="{{ route('uim') }}" class="slider-btn">Explore Universities </a>
                </div>
              </div>
            </div>
          </h3>
        </div>
        <div>
          <h3>
            <div class="slidd">
              <img class="img-fluid" src="https://educationmalaysia.in/uploads/files/banner2_1741675006.webp"
                alt="First slide">
              <div class="slidersshome">
                <div class="text-center mainsliders">
                  <h3 class="elh-banner-title">Explore. Learn. Excel. Your Future Begins Here.
                  </h3>
                  <p>Education Malaysia: Your portal to a world of educational opportunities, fostering
                    academic excellence and personal growth</p>
                  <a href="{{ url('courses-in-malaysia') }}" class="slider-btn">Find Your Course </a>
                </div>
              </div>
            </div>
          </h3>
        </div>
      </div>
    </div>
  </section>
  <!-- first section  end-->

  <!-- third section start  -->

  <section class="top-trending-universities">
    <div class="container">
      <div class="row">
        <div class="col-12  text-center mb-4 ">
          <div class="con-title">
            <h2>Top Trending <span>Universities in Malaysia</span></h2>
          </div>
          <div class="content">
            <div class="slider multiple-items">
              @foreach ($universities as $row)
                <div class="item-ol">
                  <div class="header">
                    <div class="imgdiv">
                      <img src="{{ asset($row->imgpath) }}" alt="{{ $row->name }}" class="img-fluid">
                    </div>
                    <div>
                      <div class="university-name">{{ $row->name }}</div>
                      <div class="course">Courses: {{ $row->programs->count() }}</div>
                    </div>
                  </div>
                  <div class="footer">
                    <a class="d-brochure"
                      href="{{ route('university.overview', ['university_slug' => $row->uname]) }}">Download
                      Brochure</a>
                    <a class="v-details"
                      href="{{ route('university.overview', ['university_slug' => $row->uname]) }}">View
                      Details</a>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <div class="text-center pt-4">
            <a href="{{ route('uim') }}" class="new-btn">Browse All Universities</a>
          </div>
        </div>
      </div>

    </div>
    </div>
  </section>
  <!-- third section end -->

  <!-- fourth section start  -->
  <section class="why-study">
    <div class=" container">

      <div class="row flex-column-reverse flex-xl-row align-items-center">
        <div class="col-xl-8 col-lg-12">
          <h2>Why Study in Malaysia: <span>Unlock Global Opportunities</span></h2>
          <p>Malaysia offers a unique combination of world-class education and diverse cultural experiences,
            making it top destination for international students. With globally recognized universities,
            cutting-edge infrastructure, and an affordable cost of living, Malaysia delivers the perfect
            environment for students seeking a high-quality education. Discover Malaysia that combines academic
            excellence with global exposure, offering both personal growth and career development in a vibrant,
            multicultural setting.</p>
          <div class="row">
            <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="header">
                <div class="visa-approve"><img src="{{ asset('assets/images/icons-new-home/visa-approval.png') }} "
                    class="loading" alt="Visa Approval Rate"></div>
                <div>
                  <div class="heading">90%</div>
                  <div class="text">Visa Approval Rate</div>
                </div>
              </div>
            </div>
            <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="header">
                <div><img src=" {{ asset('assets/images/icons-new-home/institute.png') }}" class="loading"
                    alt="Total Institutions and Universities"></div>
                <div>
                  <div class="heading">500+</div>
                  <div class="text">Total Institutions</div>
                </div>
              </div>
            </div>
            <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="header">
                <div><img src="{{ asset('assets/images/icons-new-home/summer.png ') }}" class="loading"
                    alt="Best Intake in Malaysia"></div>
                <div>
                  <div class="heading">Summer</div>
                  <div class="text">Best Intake</div>
                </div>
              </div>
            </div>
            <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="header">
                <div><img src="{{ asset('assets/images/icons-new-home/study-cost.png ') }}" class="loading"
                    alt="Average Study Cost"></div>
                <div>
                  <div class="heading">11400$ to 150000$</div>
                  <div class="text">Average Study Cost</div>
                </div>
              </div>
            </div>
            <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="header">
                <div><img src="{{ asset('assets/images/icons-new-home/living-cost.png ') }}" class="loading"
                    alt="Living Cost"></div>
                <div>
                  <div class="heading">1000$ to 1200$</div>
                  <div class="text">Living Cost</div>
                </div>
              </div>
            </div>
            <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="header">
                <div><img src="{{ asset('assets/images/icons-new-home/travel-cost.png ') }}" class="loading"
                    alt="Travel Cost"></div>
                <div>
                  <div class="heading">800$ to 4000$</div>
                  <div class="text">Travel Cost</div>
                </div>
              </div>
            </div>
            <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="header">
                <div><img src="{{ asset('assets/images/icons-new-home/tofel.png') }}" class="loading"
                    alt="Min TOFEL Score"></div>
                <div>
                  <div class="heading">80 (iBT)</div>
                  <div class="text">Min TOFEL Score</div>
                </div>
              </div>
            </div>
            <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="header">
                <div><img src="{{ asset('assets/images/icons-new-home/ielts.png') }}" class="loading"
                    alt="Min IELTS Score"></div>
                <div>
                  <div class="heading">6</div>
                  <div class="text">Min IELTS Score</div>
                </div>
              </div>
            </div>
            <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="header">
                <div><img src="{{ asset('assets/images/icons-new-home/pte.png ') }}" class="loading"
                    alt="Min PTE Score"></div>
                <div>
                  <div class="heading">58</div>
                  <div class="text">Min PTE Score</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-4  col-lg-12 hidden-xs text-center">
          <img src="{{ asset('assets/images/icons-new-home/malaysia-map.png') }}" class="map-malysia loading"
            alt="Malaysia Map">
        </div>
      </div>
    </div>
  </section>
  <!-- fourth section end  -->

  <section class="main-specialization pt-0">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 mb-3">
          <div class="sec-heading">
            <h2 class="mt-0 chooses">Choose Your Favourite Programme in Malaysia</h2>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($specializations as $row)
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-4 col-12">
            <a href="{{ url($row->slug . '-courses') }}" target="_blank">
              <div class="fuc-box">
                <p class="card-body">{{ $row->name }} <i class="fa fa-angle-right"></i>
                </p>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- five section end  -->

  <!-- seven section start   -->
  <section class="academic-counsellor new-home-box">
    @if ($pageContent != null)
      <div class="container">
        <div class="edu_wraper mb-0 showdetailss ">
          <div class="show-more-box-country">

            <div class="text show-more-height">
              <div class="author">
                <div class="new-uers">
                  <div class="img-div">
                    <img src="{{ userIcon($pageContent->author->profile_picture ?? null) }}"
                      alt="{{ $pageContent->author->name ?? 'Author' }}"><i class="fa fa-check-circle"></i>
                  </div>
                </div>

                <div class="cont-div">
                  <a
                    href="{{ $pageContent->author_id != null ? url('author/' . $pageContent->author->id . '-' . $pageContent->author->slug) : '#' }}">{{ $pageContent->author->name ?? 'Author' }}
                  </a><span> Updated on - {{ getFormattedDate($pageContent->updated_at, 'M d, Y') }}</span>
                </div>
              </div>
              <div class="sec-heading mb-2">
                <h2>Study in {{ $pageContent->heading }}</h2>
              </div>
              {!! $pageContent->description !!}
            </div>
            <div class="show-more">(Show More)</div>
          </div>
        </div>
      </div>
      <section class="pb-5">

      </section>
    @endif
    <div class="container">
      <div class="row flex-column-reverse flex-xl-row">
        <div class="col-xl-7 col-lg-12 mb-4">
          <h2>How Our <span>Academic Counsellor</span> Can Help You Get Admission in Malaysia</h2>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-12 ">
              <div class="academic-card">
                <div class="academic-card-body"> <i><img
                      src="https://www.educationmalaysia.in/assets/web/images/icons-new-home/register-yourself.png"
                      alt="Register Yourself" class="img-fluid"></i>
                  <h5 class="academic-card-title mt-2 mb-0">Register<br><span>Yourself</span></h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-12 ">
              <div class="academic-card">
                <div class="academic-card-body"> <i><img
                      src="https://www.educationmalaysia.in/assets/web/images/icons-new-home/document-counselling.png"
                      alt="Document Counselling" class="img-fluid"></i>
                  <h5 class="academic-card-title mt-2 mb-0">Document<br><span>Counselling</span></h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-12 ">
              <div class="academic-card">
                <div class="academic-card-body"> <i><img
                      src="https://www.educationmalaysia.in/assets/web/images/icons-new-home/entrance-test.png"
                      alt="Entrance Test" class="img-fluid"></i>
                  <h5 class="academic-card-title mt-2 mb-0">Entrance<br><span>Test</span></h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-12 ">
              <div class="academic-card">
                <div class="academic-card-body"> <i><img
                      src="https://www.educationmalaysia.in/assets/web/images/icons-new-home/university-shortlist.png"
                      alt="University Shortlist" class="img-fluid"></i>
                  <h5 class="academic-card-title mt-2 mb-0">University<br><span>Shortlist</span></h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-12 ">
              <div class="academic-card">
                <div class="academic-card-body"> <i><img
                      src="https://www.educationmalaysia.in/assets/web/images/icons-new-home/preparing-documentation.png"
                      alt="Preparing Documentation" class="img-fluid"></i>
                  <h5 class="academic-card-title mt-2 mb-0">Preparing<br><span>Documentation</span></h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-12 ">
              <div class="academic-card">
                <div class="academic-card-body"> <i><img
                      src="https://www.educationmalaysia.in/assets/web/images/icons-new-home/application-guidance.png"
                      alt="Application Guidance" class="img-fluid"></i>
                  <h5 class="academic-card-title mt-2 mb-0">Application<br><span>Guidance</span></h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-12 ">
              <div class="academic-card">
                <div class="academic-card-body"> <i><img
                      src="https://www.educationmalaysia.in/assets/web/images/icons-new-home/financial-dcumentation.png"
                      alt="Financial Documentation" class="img-fluid"></i>
                  <h5 class="academic-card-title mt-2 mb-0">Financial<br><span>Documentation</span></h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-12 ">
              <div class="academic-card">
                <div class="academic-card-body"> <i><img
                      src="https://www.educationmalaysia.in/assets/web/images/icons-new-home/visa-application.png"
                      alt="VISA Application" class="img-fluid"></i>
                  <h5 class="academic-card-title mt-2 mb-0">VISA<br><span>Application</span></h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-12 ">
              <div class="academic-card">
                <div class="academic-card-body"> <i><img
                      src="https://www.educationmalaysia.in/assets/web/images/icons-new-home/post-visa.png"
                      alt="Post Visa" class="img-fluid"
                      src="https://www.educationmalaysia.in/assets/web/images/icons-new-home/post-visa.png"></i>
                  <h5 class="academic-card-title mt-2 mb-0">Post<br><span>Visa</span></h5>
                </div>
              </div>
            </div>
          </div>

          <div class="text-center text-xl-left pt-mob"> <a href="#" class="new-btn">Talk to Counsellor <svg
                xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
                </path>
              </svg></a> </div>

        </div>
        <div class="col-xl-5 col-lg-12 mb-4">
          <div class="row">
            <div class="col-md-12">
              <h2>Study in <span>Malaysia Courses</span></h2>
            </div>
          </div>
          <div class="new-home-fuc ">
            <div class="row">
              <div class="col-xl-6 col-lg-4 col-md-4 col-sm-6 col-12 "><a
                  href="https://www.educationmalaysia.in/courses/pre-university">
                  <div class="fuc-box">
                    <div class="img-divs"><img src="{{ asset('assets/images/fuc-icons/certificate.png') }} "
                        alt="Certificate Courses" class="loading"></div>
                    <p>Certificate <i class="fa fa-angle-right"></i></p>
                  </div>
                </a></div>
              <div class="col-xl-6 col-lg-4 col-md-4 col-sm-6 col-12 "><a
                  href="https://www.educationmalaysia.in/courses/pre-university">
                  <div class="fuc-box">
                    <div class="img-divs"><img src="{{ asset('assets/images/fuc-icons/pre-university.png') }} "
                        alt="Pre University Courses" class="loading"></div>
                    <p>Pre University <i class="fa fa-angle-right"></i></p>
                  </div>
                </a></div>
              <div class="col-xl-6 col-lg-4 col-md-4 col-sm-6 col-12 "><a
                  href="https://www.educationmalaysia.in/courses/diploma">
                  <div class="fuc-box">
                    <div class="img-divs"><img src="{{ asset('assets/images/fuc-icons/diploma.png') }} "
                        alt="Diploma Courses" class="loading"></div>
                    <p>Diploma <i class="fa fa-angle-right"></i></p>
                  </div>
                </a></div>
              <div class="col-xl-6 col-lg-4 col-md-4 col-sm-6 col-12 "><a
                  href="https://www.educationmalaysia.in/courses/under-graduate">
                  <div class="fuc-box">
                    <div class="img-divs"><img src="{{ asset('assets/images/fuc-icons/under-graduate.png') }} "
                        alt="Under Graduate Courses" class="loading"></div>
                    <p>Under Graduate <i class="fa fa-angle-right"></i></p>
                  </div>
                </a></div>
              <div class="col-xl-6 col-lg-4 col-md-4 col-sm-6 col-12 "><a
                  href="https://www.educationmalaysia.in/courses/post-graduate">
                  <div class="fuc-box mb-0">
                    <div class="img-divs"><img src="{{ asset('assets/images/fuc-icons/post-graduate.png') }} "
                        alt="Post Graduate Courses" class="loading"></div>
                    <p>Post Graduate <i class="fa fa-angle-right"></i></p>
                  </div>
                </a></div>
              <div class="col-xl-6 col-lg-4 col-md-4 col-sm-6 col-12 "><a
                  href="https://www.educationmalaysia.in/courses/phd">
                  <div class="fuc-box mb-0">
                    <div class="img-divs"><img src="{{ asset('assets/images/fuc-icons/phd.png') }} "
                        alt="P.hd Courses" class="loading"></div>
                    <p>P.hd <i class="fa fa-angle-right"></i></p>
                  </div>
                </a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- seven section end   -->

  <!-- eight section start  -->
  <section class="top-trending-courses">
    <div class="container">
      <div class="show-more-box-trending">
        <div class="text show-more-height-trending show-more-height-home">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2>List of Top <span>Trending</span> Courses in Malaysia</h2>
            </div>
          </div>
          <div class="row">
            @foreach ($specializationsWithContent as $row)
              <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <a href="{{ route('specialization.detail', ['slug' => $row->slug]) }}">
                  <div class="fuc-box">
                    <p>{{ $row->name }} <i class="fa fa-angle-right"></i></p>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div class="text-center mt-3">
      <a href="{{ url('specialization') }}" class="new-btn">Browse All Courses <svg xmlns="http://www.w3.org/2000/svg"
          width="18" height="18" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
          </path>
        </svg></a>
    </div>
  </section>
  <!-- eight section end  -->
  <!-- nine section start  -->
  <section class="why-study" style="background:#fff">
    <div class=" container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <h2>Top Malaysian Universities/Colleges <span>Ranking 2025</span></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class=" b-all ranking-table table-responsive">
            <table class=" table table-striped mb-0">
              <tbody>
                <tr class="bg-primary text-white">
                  <th class="d-none mob-hide">Logo</th>
                  <th>University</th>
                  <th>
                    <div align="center">The times</div>
                  </th>
                  <th>
                    <div align="center">QS World Rank</div>
                  </th>
                  <th>
                    <div align="center">QS Malaysia</div>
                  </th>
                </tr>
                @foreach ($universityRanks as $row)
                  <tr>
                    <td width="60" class="d-none mob-hide">
                      <img data-src="{{ asset($row->imgpath) }}" alt="{{ $row->name }}" class="loading">
                    </td>
                    <td>
                      <a
                        href="{{ route('university.overview', ['university_slug' => $row->uname]) }}">{{ $row->name }}</a>
                      <br><br>
                      <a href="{{ route('university.courses', ['university_slug' => $row->uname]) }}">
                        View All Courses
                      </a>
                    </td>
                    <td>
                      <div class="circle-g">{{ $row->times_rank != '' ? $row->times_rank : 'N/A' }}</div>
                    </td>
                    <td>
                      <div class="circle-g">{{ $row->qs_rank != '' ? $row->qs_rank : 'N/A' }}</div>
                    </td>
                    <td>
                      <div class="circle-g">{{ $row->rank != '' ? $row->rank : 'N/A' }}</div>
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
  <!-- nine section end -->
  <!-- TEN section start -->
  <section class="service-new">
    <div class="container">
      <h2 class="text-center mb-0">Why Choose Education Malaysia Consultants?</h2>
      <div class="content">
        <div class="slider serviceitedms">
          <div>
            <h3>
              <div class="servicebox">
                <div class="service-icon"><span><i class="fa fa-sitemap"></i></span></div>
                <div class="title">Official University Partner </div>
                <p>We work directly with top Malaysian universities, and provide most accurate and updated information on
                  courses, fees, and scholarships.
                </p>
              </div>

            </h3>
          </div>
          <div>
            <h3>
              <div class="servicebox">
                <div class="service-icon"><span><i class="fa fa-sitemap"></i></span></div>
                <div class="title">End-to-End Student Support</div>
                <p>From choosing the right university to application processing, visa assistance, and accommodation
                  support, we provide one-on-one expert guidance.</p>
              </div>

            </h3>
          </div>
          <div>
            <h3>
              <div class="servicebox">
                <div class="service-icon"><span><i class="fa fa-sitemap"></i></span></div>
                <div class="title">Transparent & Cost-Effective Services
                </div>
                <p>Our guidance ensures student gets the best value for their investment, No hidden charges, reliable,
                  student-focused support to help you achieve your academic goals.</p>
              </div>

            </h3>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- TEN section end -->

  <!-- evelen section start  -->
  <section class="popular-colleges">
    <div class="container">
      <div class="show-more-box-popular">
        <div class="text show-more-height-popular">
          <div class=" text-center">
            <h2>Popular Searches of <span>Malysian Universities/Colleges</span> of the Week</h2>
          </div>
          <div class="row">
            @foreach ($universities as $row)
              <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-2 col-12 mb-4">
                <a href="{{ route('university.overview', ['university_slug' => $row->uname]) }}">
                  <div class="fuc-box">
                    <span>
                      <img data-src="{{ $row->imgpath }}" alt="{{ $row->name }} Logo" class="loading"
                        data-was-processed="true">
                    </span>
                    <p>{{ $row->name }}<i class="fa fa-angle-right"></i></p>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
        <div class="show-more-popular">Show More...</div>
      </div>

    </div>

    <div class="text-center pt-4">
      <a href="{{ route('select.university') }}" class="new-btn">
        Browse All Universities
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
          class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
          </path>
        </svg>
      </a>
    </div>
  </section>
  <!-- evelen section end  -->
  <!-- twelve section start  -->
  <section class="new-testi">
    <div class="container">

      <div class=" text-center">
        <h2>What our <span>Students</span> are Saying</h2>
      </div>
      <div class="box">
        <div class="row">
          <div class="col-lg-12 col-md-12 text-center">
            <div class="carousel3 owl-carousel">
              @foreach ($testimonials as $row)
                <div class="item">
                  <div class="testimonial-wraps">
                    <div class="testimonial-icon">
                      <div class="testimonial-icon-thumb">
                        <span class="quotes"><i class="fa fa-quote-left"></i></span>
                      </div>
                      <h4>{{ $row->name }}</h4>
                    </div>
                    <div class="facts-detail">
                      <p>{{ $row->review }}</p>
                      <h5>Student from {{ $row->country }}</h5>
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
  </section>
  <!-- twelve section end -->

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
