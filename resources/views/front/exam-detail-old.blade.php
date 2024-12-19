@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.dynamic_page_meta_tag')
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
              <li class="facts-1"><a href="{{ url('/exams/') }}">Exams</a></li>
              <li class="facts-1">{{ $row->exam_name }}</li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">{{ $row->title }}</h1>
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
          <div class="sec-heading">
            <h2>{{ $row->title }}</h2>
          </div>
          <!-- Overview -->
          <div class="edu_wraper">
            <div class="show-more-box">
              <div class="text show-more-height">
                {!! $row->description !!}
              </div>
              <div class="show-more">(Show More)</div>
            </div>
          </div>
          <div id="accordionExample" class="accordion shadow circullum">
            @foreach ($examcontent as $ec)
              <div class="card show-more-box">
                <div id="headingOne{{ $ec->id }}" class="card-header bg-white shadow-sm border-0 pl-4 pr-4">
                  <h6 class="mb-0 accordion_title"><a href="#" data-toggle="collapse"
                      data-target="#collapseOne{{ $ec->id }}" aria-expanded="true"
                      aria-controls="collapseOne{{ $ec->id }}"
                      class="d-block position-relative text-dark collapsible-link py-2">{{ $ec->title }}</a></h6>
                </div>
                <div id="collapseOne{{ $ec->id }}" aria-labelledby="headingOne{{ $ec->id }}"
                  data-parent="#accordionExample" class="collapse show">
                  <div class="card-body pl-4 pr-4">
                    {!! $ec->description !!}
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          @if ($faqs->count() > 0)
            <div class="edu_wraper">
              <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                  <div class="sec-heading mb-0">
                    <h3>IELTS Exam FAQs</h3>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                  <div class="container">
                    <div id="accordionExample" class="accordion circullum">
                      @foreach ($faqs as $row)
                        <div class="card mb-0 shadow-0">
                          <div id="faqheadingOne{{ $row->id }}" class="card-header bg-white border-0 b-b pl-0 pr-4">
                            <div class="mb-0 accordion_title"><a href="#" data-toggle="collapse"
                                data-target="#faqcollapseOne{{ $row->id }}" aria-expanded="false"
                                aria-controls="faqcollapseOne{{ $row->id }}"
                                class="d-block position-relative collapsible-link py-1">{{ $row->question }}</a></div>
                          </div>
                          <div id="faqcollapseOne{{ $row->id }}" aria-labelledby="faqheadingOne{{ $row->id }}"
                            data-parent="#accordionExample" class="collapse">
                            <div class="card-body pt-3 pl-0 pr-0">
                              {{ $row->answer }}
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif

        </div>
        <!-- Sidebar -->
        <div class="col-lg-4 col-md-4">
          <div class="ed_view_box style_2">
            <div class="ed_author">
              <div class="ed_author_box">
                <h4>Related Exams</h4>
              </div>
            </div>
            @foreach ($exams as $exam)
              <div class="learnup-list align-items-center">
                <div class="learnup-list-thumb"><a href="{{ $exam->exam_slug }}"><img
                      src="{{ asset($exam->thumbnail_path) }}" class="img-fluid" alt=""></a></div>
                <div class="learnup-list-caption ml-2">
                  <h6><a href="{{ $exam->exam_slug }}">{{ $exam->exam_name }}</a></h6>
                  <p class="mb-0" style="line-height:normal">{{ $exam->title }}</p>
                </div>
              </div>
            @endforeach
            @push('breadcrumb_schema')
              <!-- FAQ SCHEMA START -->
              <script type="application/ld+json">
            {
                  "@context": "https:\/\/schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [
                    <?php
                  $i = 1;
                  $tfaq = count($faqs);
                  foreach ($faqs as $faq) {
                  ?> {
                        "@type": "Question",
                        "name": "{{ $faq->question }}",
                        "acceptedAnswer": {
                          "@type": "Answer",
                          "text": "{{ str_replace('/', '\/', str_replace('"', '\"', $faq->answer)) }}"
                        }
                      }
                      <?php if ($i < $tfaq) { ?>, <?php } ?>
                    <?php $i++;
                  } ?>
                  ]
                }
          </script>
              <!-- FAQ SCHEMA END -->
            @endpush
          </div>

        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="sec-heading">
            <h2>Browse universities abroad</h2>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="edu_cat_2">
            <div class="d-flex align-items-center">
              <div class="edu_cat_icons border">
                <span class="pic-main"><img data-src="https://educationmalaysia.in/front/assets/img/usa-flag.jpg"
                    class="img-fluid" alt="Country Flag"></span>
              </div>
              <div class="edu_cat_data">
                <h4 class="title"><a href="#">Universities in USA</a></h4>
                <ul class="meta">
                  <li class="video"><i class="ti-video-clapper"></i>967 Universities</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="edu_cat_2">
            <div class="d-flex align-items-center">
              <div class="edu_cat_icons border">
                <span class="pic-main"><img src="https://educationmalaysia.in/front/assets/img/canada-flag.jpg"
                    class="img-fluid" alt="Country Flag"></span>
              </div>
              <div class="edu_cat_data">
                <h4 class="title"><a href="#">Universities in Canada</a></h4>
                <ul class="meta">
                  <li class="video"><i class="ti-video-clapper"></i>150 Universities</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="edu_cat_2">
            <div class="d-flex align-items-center">
              <div class="edu_cat_icons border">
                <span class="pic-main"><img src="https://educationmalaysia.in/front/assets/img/australia-flag.jpg"
                    class="img-fluid" alt="Country Flag"></span>
              </div>
              <div class="edu_cat_data">
                <h4 class="title"><a href="#">Universities in Australia</a></h4>
                <ul class="meta">
                  <li class="video"><i class="ti-video-clapper"></i>118 Universities</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="edu_cat_2">
            <div class="d-flex align-items-center">
              <div class="edu_cat_icons border">
                <span class="pic-main"><img data-src="https://educationmalaysia.in/front/assets/img/uk-flag.jpg"
                    class="img-fluid" alt="Country Flag"></span>
              </div>
              <div class="edu_cat_data">
                <h4 class="title"><a href="#">Universities in UK</a></h4>
                <ul class="meta">
                  <li class="video"><i class="ti-video-clapper"></i>167 Universities</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="edu_cat_2">
            <div class="d-flex align-items-center">
              <div class="edu_cat_icons border">
                <span class="pic-main"><img src="https://educationmalaysia.in/front/assets/img/ireland-flag.jpg"
                    class="img-fluid" alt="Country Flag"></span>
              </div>
              <div class="edu_cat_data">
                <h4 class="title"><a href="#">Universities in Ireland</a></h4>
                <ul class="meta">
                  <li class="video"><i class="ti-video-clapper"></i>28 Universities</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="edu_cat_2">
            <div class="d-flex align-items-center">
              <div class="edu_cat_icons border">
                <span class="pic-main"><img src="https://educationmalaysia.in/front/assets/img/newzealand-flag.jpg"
                    class="img-fluid" alt="Country Flag"></span>
              </div>
              <div class="edu_cat_data">
                <h4 class="title"><a href="#">Universities in New Zealand</a></h4>
                <ul class="meta">
                  <li class="video"><i class="ti-video-clapper"></i>71 Universities</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Content -->
@endsection
