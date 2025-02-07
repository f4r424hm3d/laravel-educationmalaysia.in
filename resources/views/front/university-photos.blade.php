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
          <div class="card">
            <div class="card-body p-4">
              <div class="row">

                @foreach ($university->photos as $row)
                  <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                    <div class="course_overlay_cat">
                      <div class="course_overlay_cat_thumb">
                        <a href="{{ asset($row->imgpath) }}" class="fancybox" data-fancybox="gallery"
                          data-caption="Image title type here">
                          <img data-src="{{ asset($row->imgpath) }}" class="img-fluid" alt="{{ $row->title }}">
                        </a>
                      </div>
                    </div>
                  </div>
                @endforeach

              </div>
            </div>
          </div>
          <!-- Call to action -->
          <div class="justify-content-center align-content-center text-center mb-4 font-weight-bold">
            GET DETAILS ON FEE, ADMISSION, INTAKE <a href="{{ url('/sign-up/?return_to=') }}"
              class="btn btn-theme-2 ml-2 rounded rounded-circle">Apply Now</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="ed_view_box style_2 hide-this" style="display: none">
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
