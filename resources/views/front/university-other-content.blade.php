@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.dynamic_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  @include('front.university-profile')
  <!-- Breadcrumb -->
  <!-- Menu -->
  @include('front.university-profile-menu')
  <!-- Menu -->

  <!-- Content -->
  <section class="bg-light pt-4 pb-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">

          <!-- Overview -->
          <div class="edu_wraper">
            <div class="show-more-box">
              <div class="text show-more-height">
                {!! $universityTabContent->description !!}
              </div>
              <div class="show-more">(Show More)</div>
            </div>
          </div>
        </div>
        <!-- Sidebar -->
        <div class="col-lg-4 col-md-4">
          <div class="ed_view_box style_2">
            <div class="ed_author">
              <div class="ed_author_box">
                <h4>Affilated Colleges</h4>
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
        </div>
      </div>
    </div>
  </section>
  <!-- Content -->
@endsection
