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
            <div class="log_wraps booking">
              <div class="row  align-items-center">

                <div class="col-lg-12">
                  <a href="#" class="bck-arrow"><span class="ti-arrow-left"></span></a>
                  <h4 class="mt-3 mb-1">Mobile Verification</h4>
                  <div class="mcod">We've sent a code to +91-9634575238 <a href="#"><i class="ti-pencil"></i>
                      Edit</a></div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="enter-resend mt-4 mb-2">Enter Email</div>
                    <div class="input-group">
                      <input name="email" type="email" class="form-control b-0" placeholder="Enter Email"
                        value="" required="">
                    </div>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group"><button class="slot-btn">Save</button></div>
                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
