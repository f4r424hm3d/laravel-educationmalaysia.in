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
              <li class="facts-1"><a href="{{ url('faqs') }}">Faqs</a></li>
              <li class="facts-1">{{ ucwords($category->category_name) }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- Content -->
  <section class="min-sec">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 p-0">
          <h2>{{ ucwords($category->category_name) }} Frequently Asked Questions</h2>
          <div class="container">
            <div class="custom-tab customize-tab tabs_creative">
              <ul class="nav nav-tabs pb-2 b-0 vertically-scrollbar mb-2" id="myTab" role="tablist">

                @foreach ($categories as $cat)
                  <li class="nav-item">
                    <a class="nav-link {{ $cat->category_slug == $category->category_slug ? 'active' : '' }}"
                      id="{{ $cat->category_slug }}-tab"
                      href="{{ route('faq.category', ['category_slug' => $cat->category_slug]) }}">{{ $cat->category_name }}</a>
                  </li>
                @endforeach

              </ul>

              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="faq" role="tabpanel" aria-labelledby="faq-tab"
                  aria-expanded="true">

                  <div id="accordionExample" class="accordion circullum">

                    @foreach ($category->faqs as $faq)
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
