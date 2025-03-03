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
        "position": 3,
        "name": "Exams",
        "item": "{{ route('exams') }}"
      }, {
        "@type": "ListItem",
        "position": 4,
        "name": "{{ $exam->page_name }}",
        "item": "{{ url()->current() }}"
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
              <li class="facts-1">Resources</li>
              <li class="facts-1"><a href="{{ route('exams') }}">Exams</a></li>
              <li class="facts-1"><a href="{{ url($exam->uri) }}">{{ $exam->page_name }}</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->

  <!-- Content -->
  <section class="bg-light pt-5 pb-5">
    <div class="container">
      <div class="row">

        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 mb-4">
          <div class="new-exam-page  pages-examss">

            <!-- <div class="sec-headline"> -->
            <h3>{{ $exam->headline }}</h3>
            <!-- </div> -->

            @if ($exam->imgpath != null)
              <img data-src="{{ asset($exam->imgpath) }}" alt="{{ $exam->headline }}">
            @endif

            <div class="edu_wraper">

              {!! $exam->description !!}

              <a href="#enquiry-now" class="big-center-btn btn-theme text-white rounded">
                Enquiry Now
              </a>

            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 ">
          @if ($exams->count() > 0)
            <div class="single_widgets widget_category">
              <h5 class="title">Important Exams</h5>
              <ul>
                @foreach ($exams as $row)
                  <li>
                    <a href="{{ route('exam.detail', ['uri' => $row->uri]) }}">
                      {{ $row->page_name }}<span><i class="fa fa-angle-right"></i></span>
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
          @if ($specializations->count() > 0)
            <div class="single_widgets widget_category">
              <h5 class="title">Trending Course</h5>
              <ul>
                @foreach ($specializations as $row)
                  <li>
                    <a href="{{ route('specialization.detail', ['slug' => $row->slug]) }}">
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
          @include('front.forms.exam-page-form')
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
  </script>

@endsection
