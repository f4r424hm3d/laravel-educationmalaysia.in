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
        "name": "Scholarships",
        "item": "{{ url('exams') }}"
      }, {
        "@type": "ListItem",
        "position": 3,
        "name": "{{ $scholarship->title }}",
        "item": "{{ url('scholarship/' . $scholarship->slug) }}"
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
      "name": "{{ $scholarship->heading }}",
      "description": "{{ $meta_description }}",
      "inLanguage": "en-US",
      "keywords": ["{{ $meta_keyword }}"]
    }
  </script>
  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Article",
      "inLanguage": "en",
      "headline": "<?= $meta_title ?>",
      "description": "<?= $meta_description ?>",
      "keywords": "<?= $meta_keyword ?>",
      "dateModified": "<?= getISOFormatTime($scholarship->updated_at) ?>",
      "datePublished": "<?= getISOFormatTime($scholarship->created_at) ?>",
      "mainEntityOfPage": { "id": "<?= $page_url ?>", "@type": "WebPage" },
      "author": { "@type": "Person", "name": "Britannica Team", "url": "https://www.educationmalaysia.in/author/6-britannica-team" },
      "publisher": {
          "@type": "Organization",
          "name": "Education Malaysia Education",
          "logo": { "@type": "ImageObject", "name": "Education Malaysia Education", "url": "https://www.educationmalaysia.in/front/assets/img/logo.webp", "height": "65", "width": "258" }
      },
      "image": { "@type": "ImageObject", "url": "<?= asset($og_image_path) ?>" }
    }
  </script>
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
              <li class="facts-1"><a href="{{ url('scholarships') }}">Scholarships</a></li>
              <li class="facts-1"><a href="{{ url('scholarship/' . $scholarship->slug) }}">{{ $scholarship->title }}</a>
              </li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">{{ $scholarship->heading }}</h1>
            </div>
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
        @foreach ($scholarship->contents as $row)
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

            <div class="edu_wraper">
              @php
                $pgcont = 1;
              @endphp
              @foreach ($scholarship->contents as $row)
                <div class="new-box mb-5" id="{{ slugify($row->tab) }}">
                  {!! $row->description !!}
                </div>
                @if ($pgcont == 1)
                  <img data-src="{{ asset($scholarship->og_image_path) }}" loading="lazy" alt="{{ $scholarship->title }}"
                    class="img-responsive loading" data-was-processed="true">
                  <div class="text-center mt-4">
                    <a onclick="window.location.href='{{ url('sign-up?return_to=' . Request::path()) }}'"
                      href="javascript:void()" target="blank" class="new-btn-sm" rel="nofollow"
                      title="Click to direct apply">Apply Here</a>
                    <a href="#enquire" class="new-btn-sm" data-toggle="tooltip" title="View All Courses">Enquire Now</a>
                  </div>
                @endif
                @php
                  $pgcont++;
                @endphp
              @endforeach

            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 col-md-4">

          @if ($scholarships->count() > 0)
            <div class="single_widgets widget_category">
              <h5 class="title">Other Scholarships</h5>
              <ul>
                @foreach ($scholarships as $row)
                  <li>
                    <a href="{{ url('scholarship/' . $row->slug) }}">
                      {{ $row->title }}<span><i class="ti-arrow-right"></i></span>
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif

          @include('front.forms.simple-form')
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
