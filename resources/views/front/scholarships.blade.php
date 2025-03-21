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
              <li class="facts-1">Scholarships</li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">Scholarships</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- Content -->
  <section class="bg-light examslead">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 mb-3">
          <div class="sec-heading">
            <h2>Study <span class="theme-cl1">Abroad Exams</span> with Education Malaysia</h2>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($scholarships as $row)
          <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-4">
            <div class="education_block_grid style_2 all-cards">
              <div class="education_block_thumb n-shadow fix-sizes">
                <img data-src="{{ asset($row->thumbnail_path) }}" class="fix-sizes" alt="{{ $row->title }}">
                <div class="ul-offers">
                  <div class=" live-offer">{{ $row->active_status }}</div>
                  <div class=" live-exculsive">{{ $row->type }}</div>
                </div>

              </div>
              <div class="education_block_body title-size">
                <h4 class="bl-title card-title">{{ $row->title }}</h4>
              </div>
              <div class="education_block_footer align-items-center p">
                @if ($row->page_type == 'landing_page')
                  <a target="_blank" href="{{ $row->landing_page_link }}" class="btn-regi">Explore More</a>
                  {{-- <a href="{{ url('scholarship/' . $row->landing_page_link) }}" class="btn-regi">Explore More</a> --}}
                @else
                  <a href="{{ url('scholarship/' . $row->slug) }}" class="btn-regi">Explore More</a>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- Content -->
@endsection
