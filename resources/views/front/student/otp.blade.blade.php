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
                <div class="log__heads text-center">
                  <h4 class="mb-0">An OTP has been send to<br><span class="theme-cl">your registerd email address</span>
                  </h4>
                </div>

                <div class="form-group text-center">
                  <label>OTP will expire in 5 minutes</label>
                  <div class="row">
                    <div class="col-2"><input type="text" maxlength="1" class="form-control"></div>
                    <div class="col-2"><input type="text" maxlength="1" class="form-control"></div>
                    <div class="col-2"><input type="text" maxlength="1" class="form-control"></div>
                    <div class="col-2"><input type="text" maxlength="1" class="form-control"></div>
                    <div class="col-2"><input type="text" maxlength="1" class="form-control"></div>
                    <div class="col-2"><input type="text" maxlength="1" class="form-control"></div>
                  </div>
                </div>

                <div class="form-group"><a href="student-profile.html" class="btn btn-theme-2 rounded w-100">Submit</a>
                </div>

                <div class="form-group text-center mb-0">
                  Are you a already member?&nbsp;&nbsp; <a href="https://educationmalaysia.in/sign-in"
                    class="theme-cl">Sign In</a>
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
