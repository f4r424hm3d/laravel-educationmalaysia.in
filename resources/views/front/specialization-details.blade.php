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
  <div class="image-cover ed_detail_head" data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1"><a href="{{ url('specialization') }}">Course</a></li>
              <li class="facts-1">{{ $specialization->name }}</li>
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
          <div class="new-exam-page">
            @php
              $pgcont = 1;
            @endphp
            @foreach ($specialization->contents as $row)
              <div class="new-box mb-5" id="{{ slugify($row->tab) }}">
                {!! $row->description !!}
              </div>
              @if ($pgcont == 1)
                <img data-src="{{ asset($og_image_path) }}" loading="lazy" alt="{{ $specialization->name }}"
                  class="img-responsive loading" data-was-processed="true">

                <div class="text-center mt-4">
                  <a onclick="window.location.href='{{ url('sign-up') }}'" href="javascript:void()" target="blank"
                    class="btn btn-sm btn-primary" rel="nofollow" title="Click to direct apply">Apply Here</a>
                  <a href="#enquiry-form" class="btn btn-sm btn-primary" data-toggle="tooltip"
                    title="View All Courses">Enquire
                    Now</a>
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
                          <div class="row">
                            <div class="col-md-2 col-xs-12">
                              <img data-src="{{ asset($row->logo_path) }}" class="img-responsive"
                                alt="{{ $row->name }} Logo">
                            </div>
                            <div class="col-md-10 col-xs-12 pl0">
                              <a target="_blank" href="{{ url('university/' . $row->uname) }}">{{ $row->name }}</a>
                              <div class="loc-rating">
                                <span><i class="fa fa-map-marker"></i> {{ $row->state }}</span>
                                <span style="padding-left:12px"><i class="fa fa-graduation-cap"></i>
                                  {{ $row->inst_type }}</span>
                              </div>
                            </div>
                          </div>
                          <div class="row footer">
                            <div class="col-md-7 col-xs-12">
                              Courses: <em>{{ $row->programs->count() }}</em> <span></span>
                              World Rank: <em>{{ $row->qs_rank }}</em> <span></span>
                              Scholarship: <em>Yes</em>
                            </div>
                            <div class="col-md-5 col-xs-12">
                              <div class="btn-mobile">
                                <button class="btn btn-sm btn-info"
                                  onclick="goToUniPrograms('{{ $row->uname }}', '{{ $specialization->id }}')">
                                  <span>{{ $allspcprograms }} {{ $specialization->name }} Courses Available</span>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                    <div class="text-center">
                      <a href="{{ url($specialization->slug . '-courses') }}" class="btn btn-md btn-primary">
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
          @include('front.forms.category-specialization-form')
        </div>

      </div>

    </div>
  </section>
  <!-- Content -->
  <script>
    $('a[href*="#"]')
      .not('[href="#"]')
      .not('[href="#0"]')
      .click(function(event) {
        if (
          location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
          location.hostname == this.hostname
        ) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          if (target.length) {
            event.preventDefault();
            $('html, body').animate({
              scrollTop: target.offset().top - 80
            }, 500, function() {});
          }
        }
      });

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
