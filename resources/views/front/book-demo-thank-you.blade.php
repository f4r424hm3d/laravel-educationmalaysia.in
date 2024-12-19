@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <section class="p-0">
    <div class="log-space">
      <div>
        <div class="row no-gutters position-relative log_rads">
          <div class="col-lg-4 col-md-4 position-static p-2"></div>
          <div class="col-lg-4 col-md-4 position-static p-2">
            <div class="log_wraps booking">
              <div class="row  align-items-center">
                <div class="col-lg-12">
                  <h4 class="mt-3 mb-1 text-success">Email Verified <span class="ti-check"></span></h4>
                  <div class="mcod">Thank You {{ $student->name }} for contact us. We will contact you very soon.</div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group"><a href="{{ url('/') }}" class="btn btn-sm btn-danger">OK</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
