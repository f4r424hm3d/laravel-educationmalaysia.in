@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <section class="p-0">
    <div class="log-space">
      <div>
        <div class="row no-gutters position-relative log_rads">
          <div class="d-none d-md-block col-lg-6 col-md-5 bg-cover"
            style="background:#1f2431 url({{ url('front') }}/assets/img/log.png)no-repeat;">
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
            <div class="log_wraps booking">
              <form action="{{ url('book-demo/verify-email') }}" method="post">
                @csrf
                <div class="row  align-items-center">

                  <div class="col-lg-12">
                    <a href="#" class="bck-arrow"><span class="ti-arrow-left"></span></a>
                    <h4 class="mt-3 mb-1">Email Verification</h4>
                    <div class="mcod">We've sent a code to {{ $student->email }}</div>
                    <div class="mcod">Please check your email for OTP. Please check your spam folder also.</div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="enter-resend mt-4 mb-2">Enter Code</div>
                      <div class="input-group">
                        <input name="otp" type="text" class="form-control b-0" placeholder="Enter OTP"
                          value="" required="">
                      </div>
                      {{-- <div class="enter-resend mt-2 mb-4"><span class="font-weight-normal">Resend OTP in 35 sec</span>
                        / <a href="#">Resend Code</a></div> --}}
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group"><button class="slot-btn" type="submit">Verify and Proceed</button></div>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
