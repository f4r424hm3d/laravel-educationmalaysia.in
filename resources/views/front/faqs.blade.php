@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
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
              <li class="facts-1"><a href="#">Faqs</a></li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">Faqs</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- Content -->
  <section class="min-sec">
    <div class="container">

      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
          <div class="sec-heading">
            <h2>FAQs</h2>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 p-0">

          <div class="container">

            <div class="custom-tab customize-tab tabs_creative">
              <ul class="nav nav-tabs pb-2 b-0 vertically-scrollbar mb-2" id="myTab" role="tablist">
                @php
                  $i = 1;
                @endphp
                @foreach ($categories as $cat)
                  <li class="nav-item">
                    <a class="nav-link {{ $i == 1 ? 'active' : '' }}" id="{{ $cat->category_slug }}-tab" data-toggle="tab"
                      href="#{{ $cat->category_slug }}" role="tab" aria-selected="true"
                      aria-expanded="true">{{ $cat->category_name }}</a>
                  </li>
                  @php
                    $i++;
                  @endphp
                @endforeach

              </ul>

              <div class="tab-content" id="myTabContent">
                @php
                  $j = 1;
                @endphp
                @foreach ($categories as $row)
                  <div class="tab-pane fade {{ $j == 1 ? 'active' : '' }} show" id="{{ $row->category_slug }}"
                    role="tabpanel" aria-labelledby="{{ $row->category_slug }}-tab" aria-expanded="true">

                    <div id="accordionExample" class="accordion circullum">

                      @foreach ($row->faqs as $faq)
                        <div class="card mb-0 shadow-0">
                          <div id="heading{{ $faq->id }}" class="card-header bg-white border-0 b-b pl-0 pr-4">
                            <div class="mb-0 accordion_title"><a href="#" data-toggle="collapse"
                                data-target="#collapse{{ $faq->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $faq->id }}"
                                class="d-block position-relative collapsible-link py-1">
                                {{ $faq->question }}
                              </a></div>
                          </div>
                          <div id="collapse{{ $faq->id }}" aria-labelledby="heading{{ $faq->id }}"
                            data-parent="#accordionExample" class="collapse">
                            <div class="card-body pt-3 pl-0 pr-0">
                              {!! $faq->answer !!}
                            </div>
                          </div>
                        </div>
                      @endforeach

                    </div>

                  </div>
                  @php
                    $j++;
                  @endphp
                @endforeach
              </div>
            </div>

          </div>

        </div>
      </div>

    </div>
  </section>
@endsection
