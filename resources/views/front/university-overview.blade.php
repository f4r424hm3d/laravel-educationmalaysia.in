@extends('front.layouts.main')
@push('seo_meta_tag')
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
  <!-- webpage schema Code Destinations -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "webpage",
      "url": "{{ url()->current() }}",
      "name": "{{ $meta_title }}",
      "description": "{{ $meta_description }}",
      "inLanguage": "en-US",
      "keywords": ["{{ $meta_keyword }}"]
    }
  </script>
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
        <div class="col-lg-8 col-md-8">

          @if ($university->overviews->count() > 0)
            <!-- Overview -->
            <div class="edu_wraper">
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
                <div class="show-more">(Show More)</div>
              </div>
            </div>
          @endif

          <div id="accordionExample" class="accordion shadow circullum">
            <!-- Call to action -->
            <div class="justify-content-center align-content-center text-center mb-4 font-weight-bold">
              GET DETAILS ON FEE, ADMISSION, INTAKE <a href="{{ url('/sign-up/?return_to=') }}"
                class="btn btn-theme-2 ml-2 rounded rounded-circle">Apply Now</a>
            </div>
            <div class="card">
              <div id="headingTwo" class="card-header bg-white shadow-sm border-0 pl-4 pr-4">
                <h6 class="mb-0 accordion_title">
                  <a href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo"
                    class="d-block position-relative collapsed text-dark collapsible-link py-2">Popular Courses</a>
                </h6>
              </div>
              <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample" class="collapse show">
                <div class="card-body pl-4 pr-4">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-6 pmr-7">
                      <div class="courses b-all">
                        <a target="_blank"
                          href="{{ url('university/' . $university->uname . '/pre-university-courses') }}">
                          <img data-src="{{ asset('assets/web/images/fuc-icons/certificate.png') }}" alt="icon"
                            height="40" width="40">
                          <span>Certificate</span>
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-6 pmr-7">
                      <div class="courses b-all">
                        <a target="_blank"
                          href="{{ url('university/' . $university->uname . '/pre-university-courses') }}">
                          <img data-src="{{ asset('assets/web/images/fuc-icons/pre-university.png') }}" alt="icon"
                            height="40" width="40">
                          <span>Pre University</span>
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-6 pmr-7">
                      <div class="courses b-all">
                        <a target="_blank" href="{{ url('university/' . $university->uname . '/diploma-courses') }}">
                          <img data-src="{{ asset('assets/web/images/fuc-icons/diploma.png') }}" alt="icon"
                            height="40" width="40">
                          <span>Diploma</span>
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-6 pmr-7">
                      <div class="courses b-all">
                        <a target="_blank"
                          href="{{ url('university/' . $university->uname . '/under-graduate-courses') }}">
                          <img data-src="{{ asset('assets/web/images/fuc-icons/under-graduate.png') }}" alt="icon"
                            height="40" width="40">
                          <span>Under Graduate</span>
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-6 pmr-7">
                      <div class="courses b-all">
                        <a target="_blank"
                          href="{{ url('university/' . $university->uname . '/post-graduate-courses') }}">
                          <img data-src="{{ asset('assets/web/images/fuc-icons/post-graduate.png') }}" alt="icon"
                            height="40" width="40">
                          <span>Post Graduate</span>
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-6 pmr-7">
                      <div class="courses b-all">
                        <a target="_blank" href="{{ url('university/' . $university->uname . '/phd-courses') }}">
                          <img data-src="{{ asset('assets/web/images/fuc-icons/phd.png') }}" alt="icon"
                            height="40" width="40">
                          <span>Phd</span>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div align="center"><a href="{{ url('university/' . $university->uname . '/courses') }}"
                      class="btn btn-outline-theme">View all courses</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- Sidebar -->
        <div class="col-lg-4 col-md-4">
          <div class="ed_view_box style_2">
            <div class="ed_author">
              <div class="ed_author_box">
                <h4>Affilated Colleges</h4>
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

          </div>
          @include('front.forms.university-side-form')
        </div>
      </div>
    </div>
  </section>
  <!-- Content -->
@endsection
