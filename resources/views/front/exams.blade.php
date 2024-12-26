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
              <li class="facts-1">Exams</li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">Exams</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- Content -->
  <section class="bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 mb-3">
          <div class="sec-heading">
            <h2>Study <span class="theme-cl1">Abroad Exams</span> with Education Malaysia</h2>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($exams as $row)
          <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-4">
            <div class="education_block_grid style_2 all-cards">
              <div class="education_block_thumb n-shadow fix-sizes">
                <img data-src="{{ asset($row->imgpath) }}" class="fix-sizes" alt="{{ $row->page_name }}">
                <div class="cources_price">{{ $row->page_name }}</div>
              </div>
              <div class="education_block_body title-size">
                <h4 class="bl-title card-title">{{ $row->headline }}</h4>
              </div>
              <div class="education_block_footer align-items-center p">
                <a href="{{ url($row->uri) }}" class="btn-regi">View Details</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- Content -->
@endsection
