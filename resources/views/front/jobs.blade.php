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
              <li class="facts-1"><a href="{{ url('/jobs/') }}">Jobs</a></li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">Jobs</h1>
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
      <div class="row">
        @foreach ($jobs as $row)
          <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="education_block_grid style_2 mb-4">
              <div class="education_block_thumb n-shadow">
                <img data-src="{{ asset($row->thumbnail_path) }}" class="img-fluid" alt="{{ $row->title }}">
              </div>
              <div class="education_block_body">
                <h4 class="bl-title"><a href="{{ url($row->page_slug) }}">{{ $row->page_name }}</a></h4>
                {{-- <p class="mb-2">{{ $row->shortnote }}</p> --}}
              </div>
              <div class="education_block_footer align-items-center p-3">
                <div class="education_block_author"><a href="{{ url($row->page_slug) }}" class="card-btn">Read More</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </section>
  <!-- Content -->
@endsection
