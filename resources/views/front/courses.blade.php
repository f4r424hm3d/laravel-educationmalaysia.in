@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@push('breadcrumb_schema')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="ed_detail_head" data-overlay="10">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1"><a href="{{ url('select-level') }}">Select Level</a></li>
              <li class="facts-1">{{ REquest::segment(2) }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->

  <!-- === Hero Banner End ===-->
  <section class="bg-light">
    @if ($pageContent != null)
      <div class="container">
        <div class="edu_wraper mb-0">
          <div class="show-more-box-country">

            <div class="text show-more-height">
              <div class="author">
                <div class="img-div">
                  <img src="{{ userIcon($pageContent->author->profile_picture ?? null) }}"
                    alt="{{ $pageContent->author->name ?? 'Author' }}"><i class="fa fa-check-circle"></i>
                </div>
                <div class="cont-div">
                  <a
                    href="{{ $pageContent->author_id != null ? url('author/' . $pageContent->author->id . '-' . $pageContent->author->slug) : '#' }}">{{ $pageContent->author->name ?? 'Author' }}
                  </a><span> Updated on - {{ getFormattedDate($pageContent->updated_at, 'M d, Y') }}</span>
                </div>
              </div>
              <div class="sec-heading mb-2">
                <h1>Study in {{ $pageContent->heading }}</h1>
              </div>
              {!! $pageContent->description !!}
            </div>
            <div class="show-more">(Show More)</div>
          </div>
        </div>
      </div>
    @endif
  </section>
@endsection
