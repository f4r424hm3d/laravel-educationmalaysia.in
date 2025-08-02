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
        "name": "Courses",
        "item": "{{ url('courses/under-graduate') }}"
      }, {
        "@type": "ListItem",
        "position": 3,
        "name": "{{ $category->name }}",
        "item": "{{ url('stream/' . $category->slug) }}"
      }]
    }
  </script>
  <!-- breadcrumb schema Code End -->
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <!-- Breadcrumb -->
  <div class="ed_detail_head lg" data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1"><a href="{{ url('courses') }}">Course</a></li>
              <li class="facts-1">{{ $category->name }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- nav-bar   -->
  <div class="new-scoll-links scroll-bar scroll-sticky new-stickyadd">
    <div class="container">
      <ul class="links scrollTo vertically-scrollbar">
        @php
          $i = 1;
        @endphp
        @foreach ($category->contents as $row)
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
          <div class="new-exam-page">
            @if ($og_image_path != '' && file_exists($og_image_path))
              <img data-src="{{ asset($og_image_path) }}" loading="lazy" alt="{{ $category->name }}"
                class="img-responsive loading" data-was-processed="true">
            @endif
            <br>
            <div class="edu_wraper">
              @php
                $pgcont = 1;
              @endphp
              @foreach ($category->contents as $row)
                <div class="new-box mb-5" id="{{ slugify($row->tab) }}">
                  {!! $row->description !!}
                </div>
                @if ($pgcont == 1)
                  <div class="text-center  ">
                    <a onclick="window.location.href='{{ url('sign-up') }}'" href="javascript:void()" target="blank"
                      class="new-btn-sms" rel="nofollow" title="Click to direct apply">
                      Apply Here
                    </a>
                    <a href="#enquiry-form" class="new-btn-sms" data-toggle="tooltip" title="View All Courses">
                      Enquire Now
                    </a>
                  </div>
                  <br>
                  <div>
                    @if ($relatedUniversities)
                      <div>
                        <h2>List of {{ $category->name }} Universities in Malaysia with courses</h2>
                        @foreach ($relatedUniversities as $row)
                          @php
                            $allspcprograms = UniversityProgram::where([
                                'course_category_id' => $category->id,
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
                                  <a target="_blank"
                                    href="{{ url('university/' . $row->uname) }}">{{ $row->name }}</a>
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
                                    <h6> Courses:</h6> <span>{{ $row->activePrograms->count() }}</span>
                                  </div>
                                  <div class="d-flex courcs-gap">
                                    <h6> World Rank:</h6> <span>{{ $row->qs_rank }}</span>
                                  </div>

                                  <div class="d-flex courcs-gap">
                                    <h6> Scholarship: </h6> <span>Yes</span>
                                  </div>
                                </div>

                                <em></em>

                              </div>
                              <div class="col-md-5 col-xs-12">
                                <div class="btn-mobile">
                                  <button class="set-bx"
                                    onclick="goToUniPrograms('{{ $row->uname }}', '{{ $category->id }}')">
                                    {{ $allspcprograms }} {{ $category->name }} Courses Available
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                      <div class="text-center mb-4">
                        <a href="{{ url($category->slug . '-courses') }}" class="btn  btn-primary">
                          Browse All Courses</a>
                      </div>
                    @endif
                  </div>
                @endif
                @php
                  $pgcont++;
                @endphp
              @endforeach
            </div>

            <div class="boxfaq">
              <div id="accordion">
                @if ($category->faqs->count() > 0)
                  <div class="boxfaq">
                    <h2>FAQs about {{ $category->name }}</h2>
                    <div id="accordion">
                      @foreach ($category->faqs as $row)
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
          </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 col-md-4">
          @if ($categories->count() > 0)
            <div class="single_widgets widget_category">
              <h5 class="title">Trending Course</h5>
              <ul>
                @foreach ($categories as $row)
                  <li>
                    <a href="{{ url('course/' . $row->slug) }}">
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
    $(document).ready(function() {
      // Wrap the table in a div with class 'table-responsive'
      $('table').before('<div class="table-responsive"></div>');

      // Move the table inside the newly created div
      $('table').prev('.table-responsive').append($('table'));
    });
  </script>
  <script>
    function goToUniPrograms(uname, specializationId) {
      if (specializationId != '') {
        $.ajax({
          url: "{{ url('university-course-list/category') }}",
          method: "GET",
          data: {
            course_category_id: specializationId
          },
          success: function(data) {
            window.open("{{ url('university/') }}/" + uname + "/courses", "_blank");
          }
        });
      }
    }
  </script>

@endsection
