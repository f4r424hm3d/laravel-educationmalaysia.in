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
              <li class="facts-1">Faqs</li>
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
                    <a class="nav-link" id="{{ $cat->category_slug }}-tab"
                      href="{{ route('faq.category', ['category_slug' => $cat->category_slug]) }}"
                      role="tab">{{ $cat->category_name }}</a>
                  </li>
                  @php
                    $i++;
                  @endphp
                @endforeach

              </ul>
            </div>

          </div>

        </div>
      </div>

    </div>
  </section>
@endsection
