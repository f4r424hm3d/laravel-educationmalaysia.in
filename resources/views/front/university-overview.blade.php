@extends('front.layouts.main')
@push('seo_meta_tag')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @include('front.layouts.dynamic_page_meta_tag')
@endpush
@push('breadcrumb_schema')
  <!-- breadcrumb schema Code -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "BreadcrumbList",
      "name": "{{ ucwords($meta_title) }}",
      "description": "{{ $meta_description }}",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "{{ url('/') }}"
      }, {
        "@type": "ListItem",
        "position": 2,
        "name": "University",
        "item": "{{ url('select-university') }}"
      }, {
        "@type": "ListItem",
        "position": 3,
        "name": "{{ $university->name }}",
        "item": "{{ url()->current() }}"
      }]
    }
  </script>
  <!-- breadcrumb schema Code End -->
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  @include('front.university-profile')
  <!-- Breadcrumb -->
  <!-- Menu -->
  @include('front.university-profile-menu')
  <!-- Menu -->

  <!-- Content -->
  <section class="bg-light pt-4 pb-4">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12">

          @if ($university->overviews->count() > 0)
            <!-- Overview -->
            <div class="edu_wraper all-overviews show-overs">
              <div class="show-more-box">
                <div class="text show-more-height">
                  @foreach ($university->overviews as $row)
                    @if ($row->h)
                      <h2 class="edu_title">{{ $row->h }}</h2>
                    @endif
                    @if ($row->imgpath)
                      <div class="cor-mid-img"> <img data-src="{{ asset($row->imgpath) }}" alt="{{ $university->name }}">
                      </div>
                    @endif
                    {!! $row->p !!}
                  @endforeach
                </div>
                <div class="show-more mt-2">Show More...</div>
                <!-- <div class="show-more mt-2">Show Less</div> -->
              </div>
            </div>
          @endif

          <div id="accordionExample" class="accordion shadow circullum">
            <!-- Call to action -->
            <div class="d-flex justify-content-center align-items-center set-gap my-3">
              <h3 class="intake_fee mb-0"> GET DETAILS ON FEE, ADMISSION, INTAKE</h3>
              <a href="{{ url('/sign-up/?return_to=') }}" class="btn btn-primary">Apply Now</a>
            </div>
            <div class="card">
              <div id="headingTwo" class="card-header bg-white shadow-sm border-0 pl-4 pr-4">
                <h6 class="mb-0 accordion_title">
                  <a href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo"
                    class="d-block position-relative collapsed text-dark collapsible-link py-2">
                    Find {{ $university->name }} Courses
                  </a>
                </h6>
              </div>
              <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample" class="collapse show">
                <div class="card-body pl-4 pr-4">
                  <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                      <div class="courses b-all">
                        <a target="_blank"
                          href="{{ url('university/' . $university->uname . '/pre-university-courses') }}">
                          <img data-src="{{ asset('assets/web/images/fuc-icons/certificate.png') }}" alt="icon"
                            height="40" width="40">
                          <span>Certificate</span>
                        </a>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                      <div class="courses b-all">
                        <a target="_blank"
                          href="{{ url('university/' . $university->uname . '/pre-university-courses') }}">
                          <img data-src="{{ asset('assets/web/images/fuc-icons/pre-university.png') }}" alt="icon"
                            height="40" width="40">
                          <span>Pre University</span>
                        </a>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                      <div class="courses b-all">
                        <a target="_blank" href="{{ url('university/' . $university->uname . '/diploma-courses') }}">
                          <img data-src="{{ asset('assets/web/images/fuc-icons/diploma.png') }}" alt="icon"
                            height="40" width="40">
                          <span>Diploma</span>
                        </a>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                      <div class="courses b-all">
                        <a target="_blank"
                          href="{{ url('university/' . $university->uname . '/under-graduate-courses') }}">
                          <img data-src="{{ asset('assets/web/images/fuc-icons/under-graduate.png') }}" alt="icon"
                            height="40" width="40">
                          <span>Under Graduate</span>
                        </a>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                      <div class="courses b-all">
                        <a target="_blank"
                          href="{{ url('university/' . $university->uname . '/post-graduate-courses') }}">
                          <img data-src="{{ asset('assets/web/images/fuc-icons/post-graduate.png') }}" alt="icon"
                            height="40" width="40">
                          <span>Post Graduate</span>
                        </a>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                      <div class="courses b-all">
                        <a target="_blank" href="{{ url('university/' . $university->uname . '/phd-courses') }}">
                          <img data-src="{{ asset('assets/web/images/fuc-icons/phd.png') }}" alt="icon"
                            height="40" width="40">
                          <span>Phd</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="multi-streams">
            <div class="card">
              <div class="card-header">
                <h3>{{ $university->name }} Popular Courses</h3>
              </div>
              <div class="card-body">
                <div class="row ">
                  <div class="col-12 col-sm-12 col-md-2 ">
                    <h2 class="top-streams">
                      Top Streams:
                    </h2>
                  </div>
                  <div class=" col-12 col-sm-12 col-md-10">
                    <div class="multi-options">
                      <ul>

                        @foreach ($universtySpecializationsForCourses as $row)
                          <li><span class="spanstream"
                              onclick="goToUniPrograms('{{ $university->uname }}', '{{ $row->id }}')">
                              {{ $row->name }}
                            </span></li>
                        @endforeach
                        <li> <a target="_blank" href="{{ url('university/' . $university->uname . '/courses') }}"
                            class="btn btn-sm btn-primary span-linames">View All</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3>Malaysia Popular Courses</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-sm-12 col-md-2 ">
                    <h2 class="top-streams">
                      Top Streams:
                    </h2>
                  </div>
                  <div class=" col-12 col-sm-12 col-md-10">
                    <div class="multi-options">
                      <ul>
                        @foreach ($randomSpecializations as $row)
                          <li>
                            <a class="spanstream" target="_blank"
                              href="{{ url($row->slug . '-courses') }}">{{ $row->name }}</a>
                          </li>
                        @endforeach
                        <li>
                          <a target="_blank" href="{{ url('courses-in-malaysia') }}"
                            class="btn btn-sm btn-primary span-linames">View
                            All</a>
                        </li>
                      </ul>

                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3>Top Courses to Study in Malaysia</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-sm-12 col-md-2 ">
                    <h2 class="top-streams">
                      Top Streams:
                    </h2>
                  </div>
                  <div class="col-md-10">
                    <div class="multi-options">
                      <ul>
                        @foreach ($specializationsWithContents as $row)
                          <li>
                            <a class="spanstream" target="_blank"
                              href="{{ route('specialization.detail', ['slug' => $row->slug]) }}">{{ $row->name }}</a>
                          </li>
                        @endforeach
                        <li>

                          <a target="_blank" href="{{ url('specialization') }}"
                            class="btn btn-sm btn-primary span-linames">View
                            All</a>
                        </li>
                      </ul>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- Sidebar -->
        <div class="col-xl-4 col-lg-4 col-md-12">
          @include('front.forms.university-side-form')
          <div class="ed_view_box style_2">
            <div class="ed_author">
              <div class="ed_author_box">
                <h4>Featured Universities</h4>
              </div>
            </div>
            @foreach ($trendingUniversity as $row)
              <div class="learnup-list">
                <div class="learnup-list-thumb">
                  <a href="{{ route('university.overview', ['university_slug' => $row->uname]) }}">
                    <img data-src="{{ asset($row->imgpath) }}" class="img-fluid" alt="{{ $row->name }}">
                  </a>
                </div>
                <div class="learnup-list-caption">
                  <h6><a
                      href="{{ route('university.overview', ['university_slug' => $row->uname]) }}">{{ $row->name }}</a>
                  </h6>
                  <p class="mb-0"><i class="ti-location-pin"></i> {{ $row->city }}, {{ $row->state }}</p>
                  <div class="learnup-info">
                    <span>
                      <a href="{{ route('university.courses', ['university_slug' => $row->uname]) }}"><i
                          class="fa fa-graduation-cap"></i> Programme</a>
                    </span>
                  </div>
                </div>
              </div>
            @endforeach
            <div class="ed_view_box style_2">
              <div class="ed_author">
                <div class="ed_author_box">
                  <h4>Find Universities Courses</h4>
                </div>
              </div>

              <div class="learnup-list">
                <div class="learnup-list-thumb">
                  <a href="{{ url('courses/pre-university') }}">
                    <img data-src="{{ asset('assets') }}/web/images/fuc-icons/pre-university.png" class="img-fluid"
                      alt="Pre University">
                  </a>
                </div>
                <div class="learnup-list-caption">
                  <h6>
                    <p>Certificate Course in Malaysia </p>
                  </h6>
                </div>
              </div>
              <div class="learnup-list">
                <div class="learnup-list-thumb">
                  <a href="{{ url('courses/diploma') }}">
                    <img data-src="{{ asset('assets') }}/web/images/fuc-icons/diploma.png" class="img-fluid"
                      alt="Pre University">
                  </a>
                </div>
                <div class="learnup-list-caption">
                  <h6>
                    <p>Diploma Course in Malaysia </p>
                  </h6>
                </div>
              </div>
              <div class="learnup-list">
                <div class="learnup-list-thumb">
                  <a href="{{ url('courses/under-graduate') }}">
                    <img data-src="{{ asset('assets') }}/web/images/fuc-icons/under-graduate.png" class="img-fluid"
                      alt="Pre University">
                  </a>
                </div>
                <div class="learnup-list-caption">
                  <h6>
                    <p>Bachelor Course in Malaysia </p>
                  </h6>
                </div>
              </div>
              <div class="learnup-list">
                <div class="learnup-list-thumb">
                  <a href="{{ url('courses/post-graduate') }}">
                    <img data-src="{{ asset('assets') }}/web/images/fuc-icons/post-graduate.png" class="img-fluid"
                      alt="Pre University">
                  </a>
                </div>
                <div class="learnup-list-caption">
                  <h6>
                    <p>Master Degree in Malaysia </p>
                  </h6>
                </div>
              </div>
              <div class="learnup-list">
                <div class="learnup-list-thumb">
                  <a href="{{ url('courses/phd') }}">
                    <img data-src="{{ asset('assets') }}/web/images/fuc-icons/phd.png" class="img-fluid"
                      alt="Pre University">
                  </a>
                </div>
                <div class="learnup-list-caption">
                  <h6>
                    <p>PHD Courses in Malaysia </p>
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Content -->
  <script>
    function goToUniPrograms(uname, specializationId) {
      if (specializationId != '') {
        $.ajax({
          url: "{{ url('university-course-list/specialization') }}",
          method: "GET",
          data: {
            specialization_id: specializationId
          },
          success: function(data) {
            window.open("{{ url('university/') }}/" + uname + "/courses", "_blank");
          }
        });
      }
    }
  </script>
@endsection
