@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <style>
    .hide-this {
      display: none;
    }
  </style>
  <!-- Content -->
  <section class="bg-light">
    <div class="log-space">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 col-md-12">
            <div class="row no-gutters position-relative log_rads">

              <div class="d-none d-lg-block col-lg-6 col-xl-6 col-md-5">
                <img src="/assets/images/singup.jpg" class="singups" alt="">

              </div>
              <div class="col-lg-6 col-xl-6 col-md-12 position-static p-2 sign-froms">
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
                @error('g-recaptcha-response')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
                <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="source_path" value="{{ url()->current() }}">
                  <input type="hidden" name="return_to" value="{{ $_GET['return_to'] ?? null }}">
                  <input type="hidden" name="program_id" value="{{ $_GET['program_id'] ?? null }}">
                  <div class="log_wraps">
                    <div class="log__heads">
                      <h4 class="mt-0 logs_title">Sign <span class="theme-cl1">Up</span></h4>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-user"></span></div>
                        <input name="name" type="text" class="form-control b-0 bg-white "
                          placeholder="Ex. Peter Parker" value="{{ old('name') }}" required="">
                      </div>
                      <span class="text-danger">
                        @error('name')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-email"></span></div>
                        <input name="email" type="email" class="form-control " placeholder="Enter Your Email Id"
                          value="{{ old('email') }}" required="">
                      </div>
                      <span class="text-danger">
                        @error('email')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="row">
                      <div class="col-4 pr-0">
                        <select name="c_code" id="c_code" class="form-control bg-white">
                          <option value="">Select</option>
                          @foreach ($phonecodes as $row)
                            <option value="{{ $row->phonecode }}"
                              {{ (old('c_code') && old('c_code') == $row->phonecode) || $row->phonecode == '91' ? 'Selected' : '' }}>
                              +{{ $row->phonecode }} ({{ $row->name }})
                            </option>
                          @endforeach
                        </select>
                        <span class="text-danger">
                          @error('c_code')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                      <div class="col-8 pl-1">
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-icon"><span class="ti-mobile"></span></div>
                            <input name="mobile" type="number" class="form-control b-0 bg-white"
                              placeholder="Ex. 9634575238" value="{{ old('mobile') }}" required="">
                          </div>
                          <span class="text-danger">
                            @error('mobile')
                              {{ $message }}
                            @enderror
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <select name="highest_qualification" id="highest_qualification" class="form-control bg-white">
                        <option value="">Qualification Level</option>
                        @foreach ($levels as $row)
                          <option value="{{ $row->level }}"
                            {{ old('highest_qualification') && old('highest_qualification') == $row->level ? 'Selected' : '' }}>
                            {{ $row->level }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('highest_qualification')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group">
                      <select name="interested_course_category" id="interested_course_category"
                        class="form-control bg-white">
                        <option value="">Intrested Course Category</option>
                        @foreach ($course_categories as $row)
                          <option value="{{ $row->name }}"
                            {{ old('interested_course_category') && old('interested_course_category') == $row->name ? 'Selected' : '' }}>
                            {{ $row->name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('interested_course_category')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group">
                      <select name="nationality" id="nationality" class="form-control bg-white">
                        <option value="">Nationality</option>
                        @foreach ($countries as $row)
                          <option value="{{ $row->name }}"
                            {{ old('nationality') && old('nationality') == $row->name ? 'Selected' : '' }}>
                            {{ $row->name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('nationality')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-icon">
                          <span id="password_icon_show" class="ti-eye" onclick="showPassword('password')"></span>
                          <span id="password_icon_hide" class="ti-eye hide-this"
                            onclick="hidePassword('password')"></span>
                        </div>
                        <input name="password" id="password" type="password" class="form-control bg-white b-0 b-l"
                          placeholder="Password">
                      </div>
                      <span class="text-danger">
                        @error('password')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-icon">
                          <span id="confirm_password_icon_show" class="ti-eye"
                            onclick="showPassword('confirm_password')"></span>
                          <span id="confirm_password_icon_hide" class="ti-eye hide-this"
                            onclick="hidePassword('confirm_password')"></span>
                        </div>
                        <input name="confirm_password" id="confirm_password" type="password"
                          class="form-control bg-white b-0 b-l" placeholder="Confirm Password">
                      </div>
                      <span class="text-danger">
                        @error('confirm_password')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group">

                      <div class="input-group">
                        <div class="input-icon"><span class="ti-captcha_answer">
                            <label for="captcha_question">{{ $question['text'] }}</label>
                          </span></div>
                        <input type="number" name="captcha_answer" class="form-control"
                          placeholder="Enter Captcha Value" required="">
                      </div>
                      @error('captcha_answer')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-theme-2 rounded w-100">Sign Up</button>
                    </div>
                    <div class="form-group text-center mb-0">
                      Are you a already member? &nbsp;&nbsp; <a
                        href="{{ url('sign-in') . (request()->has('program_id') ? '?program_id=' . request()->query('program_id') : '') }}"
                        class="theme-cl1">Sign
                        In</a>
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
  <script>
    function showPassword(id) {
      $("#" + id).attr('type', 'text');
      $("#" + id + '_icon_show').hide();
      $("#" + id + '_icon_hide').show();
    }

    function hidePassword(id) {
      $("#" + id).attr('type', 'password');
      $("#" + id + '_icon_show').show();
      $("#" + id + '_icon_hide').hide();
    }
  </script>
@endsection
