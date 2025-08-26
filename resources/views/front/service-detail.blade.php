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
        "name": "Resources",
        "item": "{{ url('/') }}"
      },{
        "@type": "ListItem",
        "position": 3,
        "name": "Services",
        "item": "{{ url('services') }}"
      }, {
        "@type": "ListItem",
        "position": 4,
        "name": "{{ $service->page_name }}",
        "item": "{{ url()->current() }}"
      }]
    }
  </script>
  <!-- breadcrumb schema Code End -->
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="head-imags" style="background:url({{ url('/front/') }}/assets/img/banner-head.jpg);"></div>
  <div class="image-cover ed_detail_head lg" public data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1">Resources</li>
              <li class="facts-1"><a href="{{ url('/services/') }}">Services</a></li>
              <li class="facts-1">{{ $service->page_name }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- nav-bar   -->
  {{-- <div class="new-scoll-links scroll-bar scroll-sticky new-stickyadd">
    <div class="container">
      <ul class="links scrollTo vertically-scrollbar">
        @php
          $i = 1;
        @endphp
        @foreach ($service->contents as $row)
          <li class="{{ $i == 1 ? 'active' : '' }}"><a
              href="#{{ slugify($row->tab_title) }}">{{ ucwords($row->tab_title) }}</a></li>
          @php
            $i++;
          @endphp
        @endforeach
      </ul>
    </div>
  </div> --}}
  <!-- Content -->
  <section class="bg-light pt-5 pb-5">
    <div class="container">
      <div class="row">

        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 mb-4">
          <div class="new-exam-page">
            <div class="sec-heading">
              <h3>{{ $service->headline }}</h3>
            </div>
            <hr>
            <img data-src="{{ cdn($service->thumbnail_path) }}" class="img-fluid w-100 mb-3"
              alt="{{ $service->headline }}">
            <div class="edu_wraper">
              @php
                $pgcont = 1;
              @endphp
              @foreach ($service->contents as $row)
                <h3>{{ $row->tab_title }}</h3>
                <div class="new-box mb-5" id="{{ slugify($row->tab_title) }}">
                  {!! $row->tab_content !!}
                </div>
                @php
                  $pgcont++;
                @endphp
              @endforeach

            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 ">
          <div class="single_widgets widget_category">
            <h4 class="title">Other Services</h4>
            <ul>
              @foreach ($services as $row)
                <li><a href="{{ route('service.detail', ['uri' => $row->uri]) }}">{{ $row->page_name }}<span><i
                        class="fa fa-angle-right"></i></span></a>
                </li>
              @endforeach
            </ul>
          </div>
          @include('front.forms.simple-form')
          @if ($specializations->count() > 0)
            <div class="single_widgets widget_category">
              <h5 class="title">Trending Course</h5>
              <ul>
                @foreach ($specializations as $row)
                  <li>
                    <a href="{{ url('specialization/' . $row->slug) }}">
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
                      <img data-src="{{ asset($row->logo_path) }}" class="img-fluid" alt="{{ $row->name }}">
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
        </div>

      </div>

    </div>
  </section>
  <!-- Content -->
@endsection
