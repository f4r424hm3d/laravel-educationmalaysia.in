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
        "name": "{{ $exam->heading }}",
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
      "name": "{{ $exam->heading }}",
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
      "dateModified": "<?= getISOFormatTime($exam->updated_at) ?>",
      "datePublished": "<?= getISOFormatTime($exam->created_at) ?>",
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
              <li class="facts-1"><a href="{{ url('exams') }}">Exams</a></li>
              <li class="facts-1"><a href="{{ url($exam->uri) }}">{{ $exam->page_name }}</a>
              </li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">{{ $exam->heading }}</h1>
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

            <div class="sec-heading">
              <h2>{{ $exam->heading }}</h2>
            </div>

            @if ($exam->imgpath != null)
              <img data-src="{{ asset($exam->imgpath) }}" alt="{{ $exam->heading }}">
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
        <div class="col-lg-4 col-md-4">

          @if ($exams->count() > 0)
            <div class="single_widgets widget_category">
              <h5 class="title">Important Exams</h5>
              <ul>
                @foreach ($exams as $row)
                  <li>
                    <a href="{{ url($row->uri) }}">
                      {{ $row->page_name }}<span><i class="ti-arrow-right"></i></span>
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
              <form action="{{ url('inquiry/exam-page') }}" method="post">
                @csrf
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                <input type="hidden" name="source" value="Exam Detail Page">
                <input type="hidden" name="source_path" value="{{ URL::full() }}">

                <input type="hidden" name="retpath" value="{{ 'exam/' . $exam->exam_slug . '/' . $exam->tab_slug }}">
                <input type="hidden" name="intrest" value="{{ $exam->exam_name }}">
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="input-group">
                      <input name="name" type="text" class="form-control b-0" placeholder="Full Name*"
                        value="{{ old('name') }}" required="">
                    </div>
                    @error('name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-12">
                  <div class="row">
                    <div class="col-4 pr-0">
                      <select name="c_code" class="form-control bg-white p-2" style="height:50px" required>
                        <option value="">Select</option>
                        @foreach ($countries as $row)
                          <option value="{{ $row->phonecode }}" {{ $row->phonecode == 91 ? 'selected' : '' }}>
                            {{ $row->iso3 }}
                            +({{ $row->phonecode }})</option>
                        @endforeach
                      </select>
                      @error('c_code')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-8 pl-1">
                      <div class="form-group">
                        <div class="input-group">
                          <input name="mobile" type="text" class="form-control b-0 bg-white"
                            placeholder="Mobile/WhatsApp No*" value="{{ old('mobile') }}" required="">
                        </div>
                        @error('mobile')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="input-group">
                      <input name="email" type="email" class="form-control b-0" placeholder="Email ID"
                        value="{{ old('email') }}" required="">
                    </div>
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="social-login mb-3 d-flex align-items-center">
                    <ul>
                      <li class="b-0 p-0" style="width:auto">
                        <input id="reg" class="checkbox-custom m-0" name="reg" type="checkbox" required>
                        <label for="reg" class="checkbox-custom-label m-0 float-left">I accept the</label>
                        <a href="{{ url('terms-conditions') }}" class="theme-cl font-size-13 m-0">
                          <u class="ml-2">Terms & Conditions</u>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="captcha_question">{{ $question['text'] }}</label>
                    <div class="input-group">
                      <div class="input-icon"><span class="ti-captcha_answer"></span></div>
                      <input type="number" name="captcha_answer" class="form-control b-0 pl-0"
                        placeholder="Enter Captcha Value" required="">
                    </div>
                    @error('captcha_answer')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group"><button class="slot-btn" type="submit">Submit</button></div>
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
