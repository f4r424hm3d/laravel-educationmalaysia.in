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
        "name": "Exams",
        "item": "{{ url('exams') }}"
      }, {
        "@type": "ListItem",
        "position": 3,
        "name": "{{ $exam->exam_name }}",
        "item": "{{ url('exam/' . $exam->exam_slug . '/overview') }}"
      }, {
        "@type": "ListItem",
        "position": 4,
        "name": "{{ $exam->headline }}",
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
              <li class="facts-1"><a href="{{ url('exams') }}">Exams</a></li>
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

              <a href="#inquiry" class="big-center-btn btn-theme text-white rounded">
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
                    <a href="{{ url($row->uri) }}">
                      {{ $row->page_name }}<span><i class="fa fa-angle-right"></i></span>
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif

          @include('front.forms.exam-page-form')
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
  </script>

@endsection
