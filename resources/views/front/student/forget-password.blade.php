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
        <div class="col-lg-12 col-md-12">

          <div class="row no-gutters position-relative log_rads">
            <div class="d-none d-md-block col-lg-6 col-md-5 bg-cover"
              style="background:#1f2431 url({{ url('/front/') }}/assets/img/log.png)no-repeat;">
              <div class="lui_9okt6">
                <div class="_loh_revu97">
                  <div id="reviews-login">

                    <!-- Single Reviews -->
                    <div class="_loh_r96">
                      <div class="_bloi_quote"><i class="fa fa-quote-left"></i></div>
                      <div class="_loh_r92">
                        <h4>Good Services</h4>
                      </div>
                      <div class="_loh_r93">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                          labore et dolore magna aliqua.</p>
                      </div>
                      <div class="_loh_foot_r93">
                        <h4>Shilpa D. Setty</h4>
                        <span>Team Leader</span>
                      </div>
                    </div>

                    <!-- Single Reviews -->
                    <div class="_loh_r96">
                      <div class="_bloi_quote"><i class="fa fa-quote-left"></i></div>
                      <div class="_loh_r92">
                        <h4>Good Services</h4>
                      </div>
                      <div class="_loh_r93">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                          labore et dolore magna aliqua.</p>
                      </div>
                      <div class="_loh_foot_r93">
                        <h4>Adam Wilsom</h4>
                        <span>Mak Founder</span>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-7 position-static p-2">
              @if (session()->has('smsg'))
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('smsg') }}
              </div>
              @endif
              @if (session()->has('emsg'))
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('emsg') }}
              </div>
              @endif
              <form method="post" action="{{ url('forget-password') }}" enctype="multipart/form-data">
                @csrf
                <div class="log_wraps">
                  <div class="log__heads">
                    <h4 class="mt-0 logs_title">Forgot <span class="theme-cl1">Password</span></h4>
                  </div>

                  <div class="form-group">
                    <label>Enter your email we'll send you a link to reset your password.</label>
                    <div class="input-group">
                      <div class="input-icon"><span class="ti-email"></span></div>
                      <input name="email" type="email" class="form-control bg-white b-0 b-l"
                        placeholder="Enter your registered email address" value="{{ old('email') }}" required>
                      <span class="text-danger">
                        @error('email')
                        {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-theme-2 rounded w-100">Reset Password</button>
                  </div>

                  <div class="form-group text-center mb-0">
                    Are you a already member?&nbsp;&nbsp; <a href="{{ url('sign-in') }}" class="theme-cl1">Sign In</a>
                  </div>

                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<!-- Content -->
@endsection
