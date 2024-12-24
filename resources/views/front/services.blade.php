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
              <li class="facts-1"><a href="{{ url('/services/') }}">Services</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- Content -->
  <section class="main-specialization">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 mb-3">
          <div class="sec-heading">
            <h2>What we do</h2>
            <p class="text-center">Having and managing a correct marketing strategy is crucial in a fast moving market.
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($services as $row)
          <div class="col-lg-3 col-md-3 col-sm-4">
            <a href="{{ url($row->uri) }}" target="_blank">
              <div class="fuc-box">
                <p class="card-body">{{ $row->page_name }} <i class="fa fa-angle-right"></i>
                </p>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- Content -->
@endsection
