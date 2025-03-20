@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
  <section class="bannerfixed">
    <div class="container">
      <div class="banner-fix">
        <img src="{{ cdn('assets/images/new-banner2.png') }}" class="fix-banners" alt="">
      </div>
    </div>
  </section>
  <section class="institutes">
    <div class="container">
      @foreach ($universities as $row)
        <div class="row-institutes">
          <div class="row">
            <div class="col-2 col-sm-12 col-md-2 mb-4">
              <div class="institues-img">
                <img src="{{ asset($row->university->logo_path) }}" class="img-fluid" alt="{{ $row->university->name }}">
              </div>

            </div>
            <div class="col-12 col-sm-12 col-md-10 mb-4 ">
              <div class="universitynames">
                <h2>{{ $row->university->name }}</h2>
                <p> <span>Location:</span> {{ $row->university->city }}</p>
              </div>
            </div>
            <div class="col-12">
              <p class=" parargraph-more">
                {!! $row->university->shortnote !!}
              </p>
              <a class="showbx" href="#">Show More <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              <a class="showbx" href="#">Show Less <i class="fa fa-angle-up" aria-hidden="true"></i>
              </a>
            </div>
          </div>
          <button class="featuresoption"> <span></span> Featured </button>
        </div>
      @endforeach
    </div>
  </section>
@endsection
