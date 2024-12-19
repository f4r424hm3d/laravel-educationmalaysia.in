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
          <div class="no-gutters position-relative log_rads">
            <div class="log_wraps">
              <form method="post" action="{{ url('reset-password') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $_GET['uid'] }}">
                <input type="hidden" name="remember_token" value="{{ $_GET['token'] }}">
                <div class="form-group">
                  <label>Enter New Password</label>
                  <input name="new_password" type="password" class="form-control" placeholder="Enter New Password"
                    required>
                  <span class="text-danger">
                    @error('new_password')
                    {{ $message }}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label>Confirm New Password</label>
                  <input name="confirm_new_password" type="password" class="form-control"
                    placeholder="Confirm New Password" required>
                  <span class="text-danger">
                    @error('confirm_new_password')
                    {{ $message }}
                    @enderror
                  </span>
                </div>
                <div class="form-group text-center add_top_20 mb-0">
                  <input class="btn btn-theme-2 rounded w-100" type="submit" value="Submit">
                </div>
              </form>
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
