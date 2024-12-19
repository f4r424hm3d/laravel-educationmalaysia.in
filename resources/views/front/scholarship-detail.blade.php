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

          @if (session()->has('smsg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <span id="smsg">{{ session()->get('smsg') }}</span>
            </div>
          @endif
          @if (session()->has('emsg'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <span id="emsg">{{ session()->get('emsg') }}</span>
            </div>
          @endif

          <div class="single_widgets widget_category">
            <h5 class="title mb-3">Get in touch</h5>
            <div class="row align-items-center booking p-0">
              @error('g-recaptcha-response')
                <span class="text-danger">{{ $message }}</span>
              @enderror
              <form action="{{ url('inquiry/stream-page-inquiry') }}" method="post" class="p-3">
                @csrf
                @if (Request::segment(1) == 'stream')
                  <input type="hidden" name="source" value="Education Malaysia - Specialization Page">
                @elseif (Request::segment(1) == 'course')
                  <input type="hidden" name="source" value="Education Malaysia - Course Category Page">
                @endif
                <input type="hidden" name="source_path" value="{{ URL::full() }}">
                <input type="hidden" name="return_path" value="{{ Request::path() }}">

                <!-- Name Field -->
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="form-control" pattern="[a-zA-Z\s]+" required>
                      @error('name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

                <!-- Email Field -->
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" id="email"
                        value="{{ old('email') }}" required>
                      @error('email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

                <!-- Phone Field -->
                <div class="row">
                  <div class="col-xs-4 pr-0">
                    <div class="form-group">
                      <label for="c_code">Country Code</label>
                      <select class="form-control" name="c_code" id="c_code" required>
                        <option value="">Select</option>
                        @foreach ($countries as $row)
                          <option value="{{ $row->phonecode }}"
                            {{ old('c_code') == $row->phonecode || $row->phonecode == '91' ? 'selected' : '' }}>
                            +{{ $row->phonecode }}
                          </option>
                        @endforeach
                      </select>
                      @error('c_code')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-xs-8 pl-0">
                    <div class="form-group">
                      <label for="mobile">Phone</label>
                      <input type="text" class="form-control" name="mobile" id="mobile"
                        placeholder="987654321" value="{{ old('mobile') }}" required>
                      @error('mobile')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

                <!-- Nationality Field -->
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="s-nationality">Nationality</label>
                      <select class="form-control" name="nationality" id="s-nationality" required>
                        <option value="">Select Nationality</option>
                        @foreach ($countries as $row)
                          <option value="{{ $row->name }}" {{ old('nationality') == $row->name ? 'selected' : '' }}>
                            {{ $row->name }}
                          </option>
                        @endforeach
                      </select>
                      @error('nationality')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

                <!-- Captcha Field -->
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <input type="text" placeholder="Captcha: {{ $captcha['text'] }} =" class="form-control"
                      disabled readonly>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <input type="text" id="captcha" placeholder="Enter the Captcha Code" class="form-control"
                      name="captcha_input" required>
                  </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group mt-2">
                      <input type="checkbox" id="tnc" name="tnc" required>
                      <label for="tnc">
                        I agree to the <a href="{{ url('terms-and-conditions') }}">Terms</a> and <a
                          href="{{ url('privacy-policy') }}">Privacy Statement</a>
                      </label>
                    </div>
                  </div>
                </div>

                <!-- Submit Button -->
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                  </div>
                </div>
              </form>

            </div>
          </div>
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
