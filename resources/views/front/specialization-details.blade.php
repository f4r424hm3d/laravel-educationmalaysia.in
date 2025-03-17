@php
  use App\Models\UniversityProgram;
@endphp
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
        "name": "Specializations",
        "item": "{{ url('specialization') }}"
      }, {
        "@type": "ListItem",
        "position": 3,
        "name": "{{ $specialization->name }}",
        "item": "{{ url('stream/' . $specialization->slug) }}"
      }]
    }
  </script>
  <!-- breadcrumb schema Code End -->
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="new-top-header">
    <div class="container">
      <div class="row align-items-center flex-column-reverse flex-md-row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-8 mb-4 mb-md-0  ">
          <h2 class="malaysia-student">{{ $specialization->name }} Course in Malaysia : Complete Guide for International
            Students
          </h2>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4 mb-md-0  ">
          <div class="specilaizationbx">
            <img src="https://www.educationmalaysia.in/assets/web/images/em-cource-img-lite.webp"
              alt="accounting finance in Malaysia" class="initial loading" data-was-processed="true">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="image-cover ed_detail_head" data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1"><a href="{{ url('specialization') }}">Specialization</a></li>
              <li class="facts-1">{{ $specialization->name }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- nav-bar   -->
  <div class="new-scoll-links scroll-bar scroll-sticky new-stickyadd  ">
    <div class="container">
      <ul class="links scrollTo vertically-scrollbar">
        @php
          $i = 1;
        @endphp
        @foreach ($specialization->contents as $row)
          <li class="{{ $i == 1 ? 'active' : '' }}"><a href="#{{ slugify($row->tab) }}">{{ ucwords($row->tab) }}</a></li>
          @php
            $i++;
          @endphp
        @endforeach
      </ul>
    </div>
  </div>
  <!-- Content -->
  <section class="bg-light pt-5 pb-5">
    <div class="container">
      <div class="row">

        <div class="col-lg-8 col-md-8">
          <div class="new-exam-page set-exam-pages li-pages ">
            @php
              $pgcont = 1;
            @endphp
            @foreach ($specialization->contents as $row)
              <div class="new-box mb-4" id="{{ slugify($row->tab) }}">
                {!! $row->description !!}

              </div>
              @if ($pgcont == 1)
                <img data-src="{{ asset($og_image_path) }}" loading="lazy" alt="{{ $specialization->name }}"
                  class="img-responsive loading" data-was-processed="true">

                <div class="text-center mt-4 acn-gap ">
                  <a onclick="window.location.href='{{ url('sign-up') }}'" href="javascript:void()" target="blank"
                    class="new-btn-sms" rel="nofollow" title="Click to direct apply">Apply Here <svg
                      xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                      class="bi bi-arrow-right" viewBox="0 0 16 16">
                      <path fill-rule="evenodd"
                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
                      </path>
                    </svg> </a>
                  <a href="#enquiry-form" class="new-btn-sms" data-toggle="tooltip" title="View All Courses">Enquire
                    Now<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                      class="bi bi-arrow-right" viewBox="0 0 16 16">
                      <path fill-rule="evenodd"
                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
                      </path>
                    </svg>
                  </a>
                </div>
                <br>
                <div>
                  @if ($relatedUniversities)
                    <div>
                      <h2>List of {{ $specialization->name }} Universities in Malaysia with courses</h2>
                      @foreach ($relatedUniversities as $row)
                        @php
                          $allspcprograms = UniversityProgram::where([
                              'specialization_id' => $specialization->id,
                              'university_id' => $row->id,
                          ])->count();
                        @endphp
                        <div class="card card-body">
                          <div class="row align-items-center">
                            <div class="col-md-2 col-xs-12 mb-3">
                              <div class="details-img">
                                <img data-src="{{ asset($row->logo_path) }}" class="img-fluid"
                                  alt="{{ $row->name }} Logo">
                              </div>
                            </div>
                            <div class="col-md-10 col-xs-12 mb-3">
                              <div class="detail-rating">
                                <a target="_blank" href="{{ url('university/' . $row->uname) }}">{{ $row->name }}</a>
                                <div class="loc-rating">
                                  <span><i class="fa fa-map-marker"></i> {{ $row->state }}</span>
                                  <span style="padding-left:12px"><i class="fa fa-graduation-cap"></i>
                                    {{ $row->inst_type }}</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-7 col-xs-12">
                              <div class="d-flex cor-gaps">
                                <div class="d-flex courcs-gap ">
                                  <h6> Courses:</h6> <span>{{ $row->programs->count() }}</span>
                                </div>
                                <div class="d-flex courcs-gap">
                                  <h6> World Rank:</h6> <span>{{ $row->qs_rank }}</span>
                                </div>

                                <div class="d-flex courcs-gap">
                                  <h6> Scholarship: <em>Yes</em></h6> <span>{{ $row->programs->count() }}</span>
                                </div>
                              </div>

                              <em></em>

                            </div>
                            <div class="col-md-5 col-xs-12">
                              <div class="btn-mobile">
                                <button class="set-bx"
                                  onclick="goToUniPrograms('{{ $row->uname }}', '{{ $specialization->id }}')">
                                  {{ $allspcprograms }} {{ $specialization->name }} Courses Available
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                    <div class="text-center mb-4">
                      <a href="{{ url($specialization->slug . '-courses') }}" class="btn  btn-primary">
                        Browse All Courses</a>
                    </div>
                  @endif
                </div>
              @endif
              @php
                $pgcont++;
              @endphp
            @endforeach
            @if ($specialization->faqs->count() > 0)
              <div class="boxfaq">
                <h2>FAQs : {{ $specialization->name }}</h2>
                <div id="accordion">
                  @foreach ($specialization->faqs as $row)
                    <div class="card">
                      <div class="card-header" id="headdingbx{{ $row->id }}">
                        <h5 class="mb-0">
                          <button class="btn btn-link" data-toggle="collapse" data-target="#onebx{{ $row->id }}"
                            aria-expanded="true" aria-controls="onebx{{ $row->id }}">
                            {{ $row->question }}
                          </button>
                        </h5>
                      </div>

                      <div id="onebx{{ $row->id }}" class="collapse "
                        aria-labelledby="headdingbx{{ $row->id }}" data-parent="#accordion">
                        <div class="card-body">
                          {!! $row->answer !!}
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif
          </div>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 col-md-4">
          @if ($specializations->count() > 0)
            <div class="single_widgets widget_category">
              <h5 class="title">Trending Course</h5>
              <ul>
                @foreach ($specializations as $row)
                  <li>
                    <a href="{{ url('stream/' . $row->slug) }}">
                      {{ $row->name }}<span><i class="fa fa-angle-right"></i></span>
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
          @if ($featuredUniversities->count() > 0)
            <div class="card">
              <div class="ed_author">
                <div class="ed_author_box">
                  <h4>Featured Universities</h4>
                </div>
              </div>
              @foreach ($featuredUniversities as $row)
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
          @endif
          @include('front.forms.category-specialization-form')
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
