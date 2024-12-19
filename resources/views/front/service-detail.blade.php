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
        "name": "Services",
        "item": "{{ url('services') }}"
      }, {
        "@type": "ListItem",
        "position": 3,
        "name": "{{ $service->page_name }}",
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
  <div class="image-cover ed_detail_head lg" style="background:url({{ url('/front/') }}/assets/img/ub.jpg);"
    data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1"><a href="{{ url('/services/') }}">Services</a></li>
              <li class="facts-1">{{ $service->page_name }}</li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">{{ $service->page_name }}</h1>
            </div>
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
        <div class="col-lg-8 col-md-8">
          <div class="card">
            <div class="card-body p-4">
              <div class="sec-heading">
                <h2>{{ $service->headline }}</h2>
              </div>
              <hr>
              <img data-src="{{ asset($service->imgpath) }}" class="img-fluid w-100 mb-3" alt="{{ $service->headline }}">
            </div>
          </div>

          @foreach ($service->contents as $row)
            <div class="card show-more-box-country">
              <div class="card-body p-4">
                @if ($row->tab_title != null)
                  <h3>{{ $row->tab_title }}</h3>
                @endif
                {!! $row->tab_content !!}
              </div>
            </div>
          @endforeach
        </div>
        <!-- Sidebar -->
        <div class="col-lg-4 col-md-4">
          <div class="single_widgets widget_category">
            <h4 class="title">Related Services</h4>
            <ul>
              @foreach ($services as $row)
                <li><a href="{{ url($row->uri) }}">{{ $row->page_name }}<span><i class="ti-arrow-right"></i></span></a>
                </li>
              @endforeach
            </ul>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- Content -->
@endsection
