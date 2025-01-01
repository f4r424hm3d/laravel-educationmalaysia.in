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
<section class="bg-light new-home-box">
  @if ($pageContent != null)
    <div class="container">
    <div class="graduate_bx">
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
        <div class="study-bx mb-2">
        <h3>Study in {{ $pageContent->heading }}</h3>
        </div>
        {!! $pageContent->description !!}
      </div>
      <div class="show-more">Show More...</div>
      </div>
    </div>
    </div>
  @endif
</section>


<section class="pop-cour">
  <div class="container com-sp">
   
     
          <div class="home-top-cour">
          <div class="row">
            <div class="col-md-3 text-center">
              <img data-src="https://www.educationmalaysia.in/assets/uploadFiles/study/IMG_20210202_131711.jpg"
                alt="Agriculture and Veterinary Medicine" class="img-responsive initial loaded">
            </div>
            <div class="col-md-9 ">
            <div class="home-top-cour-desc">
            <a href="#">
                <h3>Agriculture and Veterinary Medicine</h3>
              </a>
              <p>Don't think it is just about 'working the land'. You'll study land-based industries, such as rural
                management, animal medicine, GM crops, food security and climate change.</p>
              <div class="event-head-sub">
                <ul>
                  <li><a href="#">Animal Science </a></li>
                </ul>
              </div>
            </div>
             
            </div>
          </div>

    </div>
  </div>
</section>


@endsection