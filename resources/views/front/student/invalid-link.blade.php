@extends('front.layouts.main')
@push('seo_meta_tag')
@include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
<!-- Content -->
<section class="bg-light">
  <div class="log-space">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 col-12">

          <div class="no-gutters position-relative log_rads">
            <div class="log_wraps">
              <h5>
                <center>This link is invalid</center>
              </h5>
              <p class="mb-3">
                <center>Please request a new one and try again.</center>
              </p>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
  </div>
</section>
<!-- Content -->
@endsection
