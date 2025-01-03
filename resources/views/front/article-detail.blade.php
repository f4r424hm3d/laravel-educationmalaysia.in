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
        "name": "{{ $article->getDestination->destination_name }}",
        "item": "{{ url($article->getDestination->destination_slug) }}"
      }, {
        "@type": "ListItem",
        "position": 3,
        "name": "{{ $article->title }}",
        "item": "{{ url()->current() }}"
      }]
    }
  </script>
  <!-- breadcrumb schema Code End -->
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="ed_detail_head" data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1">
                <a href="{{ url($article->getDestination->destination_slug) }}">
                  {{ $article->getDestination->destination_name }}
                </a>
              </li>
              <li class="facts-1">{{ $article->title }}</li>
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

        <div class="col-lg-8 col-md-8">
          <div class="new-exam-page">

            <!-- <div class="sec-heading"> -->
            <h3>{{ $article->title }}</h3>
            <!-- </div> -->

            <div class="row align-items-center mb-3">
              @if ($article->author_id != null)
                <div class="col-8">
                  <div class="new-author">
                    <div class="img-div">
                      <img src="{{ userIcon($article->getUser->profile_picture ?? null) }}"
                        alt="{{ $article->getUser->name }}"><i class="fa fa-check-circle"></i>
                    </div>
                    <div class="cont-div">
                      <a href="#">{{ $article->getUser->name }} </a><span> Updated on -
                        {{ getFormattedDate($article->updated_at, 'M d, Y') }}</span>
                    </div>
                  </div>
                </div>
              @endif
              <div class="col-4">
                <div class="share-button">
                  <div class="share-button__back">
                    <a class="share__link" href="#" aria-label="Share This Page"><i
                        class="ti-facebook share__icon"></i></a>
                    <a class="share__link" href="#" aria-label="Share This Page"><i
                        class="ti-twitter share__icon"></i></a>
                    <a class="share__link" href="#" aria-label="Share This Page"><i
                        class="ti-instagram share__icon"></i></a>
                    <a class="share__link" href="#" aria-label="Share This Page"><i
                        class="ti-linkedin share__icon"></i></a>
                  </div>
                  <div class="share-button__front">
                    <p class="share-button__text">Share <i class="fa fa-share-alt"></i></p>
                  </div>
                </div>
              </div>
            </div>

            @if ($article->image_path != null)
              <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}">
            @endif
            <a href="{{ url($article->getDestination->destination_slug) }}" class="big-center-btn text-white">Study In
              {{ $article->getDestination->destination_name }}
            </a>
            <div class="edu_wraper">
              <h2>{{ $article->heading }}</h2>
              {!! $article->description !!}
              <a href="{{ url('book-demo') }}" class="big-center-btn btn-theme text-white rounded">
                Enquiry Now</a>

              <div id="accordionExample" class="accordion circullum">
                <div class="card mt-4 mb-4 shadow-0">
                  <div id="headingOne" class="card-header border-0 pl-4 pr-4 bg-light">
                    <h3 class="mb-0"><a data-toggle="collapse" data-target="#collapseOne" aria-expanded="false"
                        role="button" aria-controls="collapseOne"
                        class="d-block position-relative text-dark collapsible-link">Table of
                        Content</a></h3>
                  </div>

                  <div id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample" class="collapse">
                    <div class="card-body pl-4 pr-4 bg-light">
                      <div class="table-of-content">
                        <ul>

                          @foreach ($article->getAllMasterContent as $row)
                            <li><a href="#content{{ $row->id }}">{{ $row->heading }}</a>
                              @if ($row->getAllChild->count() > 0)
                                <ul>
                                  @foreach ($row->getAllChild as $ch)
                                    <li><a href="#content{{ $ch->id }}">{{ $ch->heading }}</a></li>
                                  @endforeach
                                </ul>
                              @endif
                            </li>
                          @endforeach
                          {{-- @if ($faqs->count() > 0)
                        <li><a href="#Frequently-Asked-Questions">Frequently Asked Questions</a></li>
                        @endif
                        @if ($destinations->count() > 0)
                        <li><a href="#Destinations">Study Abroad Destinations</a></li>
                        @endif --}}
                        </ul>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              {!! $article->description2 !!}

              @foreach ($article->getAllMasterContent as $row)
                <div id="content{{ $row->id }}">
                  <h2>{{ $row->heading }}</h2>
                  {!! $row->description !!}
                </div>
                @if ($row->getAllChild->count() > 0)
                  @foreach ($row->getAllChild as $ch)
                    <div id="content{{ $ch->id }}">
                      <h3>{{ $ch->heading }}</h3>
                      {!! $ch->description !!}
                    </div>
                  @endforeach
                @endif
              @endforeach

              @if ($article->faqs->count() > 0)
                <div id="Frequently-Asked-Questions" class="mt-3 card shadow-0 bg-light pt-4 pb-4 pr-4 pl-4">
                  <h3>Frequently Asked Questions</h3>
                  <div class="row mt-3">
                    <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                      <div class="container">
                        <div id="accordionExample" class="accordion circullum">
                          @foreach ($article->faqs as $row)
                            <div class="card mb-0 shadow-0">
                              <div id="faqheadingOne{{ $row->id }}" class="card-header bg-white border-0 b-b pr-4">
                                <div class="mb-0 accordion_title"><a href="#" data-toggle="collapse"
                                    data-target="#faqcollapseOne{{ $row->id }}" aria-expanded="false"
                                    aria-controls="faqcollapseOne{{ $row->id }}"
                                    class="d-block position-relative collapsible-link py-1"><strong>Q:</strong>
                                    {{ $row->question }}</a></div>
                              </div>
                              <div id="faqcollapseOne{{ $row->id }}"
                                aria-labelledby="faqheadingOne{{ $row->id }}" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body pt-3"><strong>Ans:</strong>
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
                @push('breadcrumb_schema')
                  <!-- FAQ SCHEMA START -->
                  <script type="application/ld+json">
                    {
                    "@context": "https:\/\/schema.org",
                    "@type": "FAQPage",
                    "mainEntity": [
                      <?php
                    $i = 1;
                    $tfaq = count($article->faqs);
                    foreach ($article->faqs as $faq) {
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
              @endif

            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 col-md-4">
          <div class="ed_view_box style_2">
            <div class="ed_author">
              <div class="ed_author_box">
                <h4>Top Universities in {{ $destination->destination_name }}</h4>
              </div>
            </div>
            @foreach ($trendingUniversity as $uni)
              <div class="learnup-list">
                <div class="learnup-list-thumb">
                  <a href="{{ url($uni->slug) }}">
                    <img data-src="{{ asset($uni->logo_path) }}" class="img-fluid" alt="{{ $uni->name }}">
                  </a>
                </div>
                <div class="learnup-list-caption">
                  <h6><a href="{{ url($uni->slug) }}">{{ $uni->name }}</a></h6>
                  <p class="mb-0"><i class="ti-location-pin"></i> {{ $uni->city }}, {{ $uni->state }}</p>
                  <div class="learnup-info">
                    <span class="mr-3">
                      <a href="{{ url($uni->slug) }}"><i class="fa fa-edit"></i> Admission</a>
                    </span>
                    <span>
                      <a href="{{ url($uni->slug . '/courses') }}"><i class="fa fa-graduation-cap"></i> Programme</a>
                    </span>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          <!-- Trending Posts -->
          <div class="single_widgets widget_thumb_post">
            <h4 class="title mb-3">Trending Posts</h4>
            <ul>

              @foreach ($articles as $row)
                <li>
                  <span class="left"><img data-src="{{ asset($row->image_path) }}" alt="{{ $row->title }}"
                      class=""></span>
                  <span class="right">
                    <a class="feed-title"
                      href="{{ url($row->getDestination->destination_slug . '/articles/' . $row->page_url) }}">{{ $row->title }}</a>
                    <span class="post-date"><i
                        class="ti-calendar"></i>{{ getFormattedDate($row->created_at, 'd M, Y') }}</span>
                  </span>
                </li>
              @endforeach

            </ul>
          </div>
          <!-- Tags Cloud -->
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
