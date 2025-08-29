@if (session()->has('smsg'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <span id="smsg">{{ session()->get('smsg') }}</span>
  </div>
@endif
@if (session()->has('emsg'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span id="emsg">{{ session()->get('emsg') }}</span>
  </div>
@endif

<div class="single_widgets widget_category  single-toch">
  <h5 class="title mb-3">Get in touch</h5>
  <div class="row align-items-center booking p-0">
    @error('g-recaptcha-response')
      <span class="text-danger">{{ $message }}</span>
    @enderror
    <form action="{{ route('inquiry.university.profile') }}" method="post">
      @csrf
      <input type="hidden" name="university_id" value="{{ $university->id }}">
      <input type="hidden" name="source" value="Education Malaysia - University Profile Page">
      <input type="hidden" name="source_path" value="{{ URL::full() }}">

      <input type="hidden" name="return_path" value="{{ url()->current() }}">
      <div class="col-lg-12 mb-3">
        <div class="form-group">
          <div class="input-group">
            <input name="name" type="text" class="form-control" placeholder="Full Name*"
              value="{{ old('name') }}" required="">
          </div>
          @error('name')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="col-12 mb-3">
        <div class="row">
          <div class="col-4 pr-0">
            <select name="country_code" class="form-control bg-white p-2" required>
              <option value="">Select</option>
              @foreach ($countries as $row)
                <option value="{{ $row->phonecode }}" {{ $row->phonecode == 91 ? 'selected' : '' }}>
                  {{ $row->iso3 }}
                  +({{ $row->phonecode }})</option>
              @endforeach
            </select>
            @error('country_code')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="col-8 pl-1">
            <div class="form-group mb-0">
              <div class="input-group">
                <input name="mobile" type="text" class="form-control bg-white" placeholder="Mobile/WhatsApp No*"
                  value="{{ old('mobile') }}" required="">
              </div>
              @error('mobile')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 mb-3">
        <div class="form-group">
          <div class="input-group">
            <input name="email" type="email" class="form-control b-0" placeholder="Email ID"
              value="{{ old('email') }}" required="">
          </div>
          @error('email')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="col-lg-12 mb-3">
        <div class="form-group">
          <div class="input-group">
            <select name="interested_program" id="interested_program" class="form-control program b-0">
              <option value="">Select Program</option>
              @foreach ($university->programs as $row)
                <option value="{{ $row->course_name }}"
                  {{ old('interested_program') == $row->course_name ? 'selected' : '' }}>{{ $row->course_name }}
                </option>
              @endforeach
            </select>
          </div>
          @error('interested_program')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="col-lg-12 mb-3">
        <div class="social-login ddd-login mb-3 d-flex align-items-center">
          <ul>
            <li class="b-0 p-0" style="width:auto">
              <input id="reg" class="checkbox-custom m-0" name="reg" type="checkbox" required>
              <label for="reg" class="checkbox-custom-label m-0 float-left">I accept the</label>
              <a href="{{ route('tc') }}" class="p-0">
                <span class="pl-1 float-left"> Terms & Conditions</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-12 mb-3">
        <div class="form-group">

          <div class="input-group">
            <div class="input-icon"><span class="ti-captcha_answer">
                <label for="captcha_question" class="capctaha">{{ $captcha['text'] }}</label>
              </span></div>
            <input type="number" name="captcha_answer" class="form-control b-0" placeholder="Enter Captcha Value"
              required="">
          </div>
          @error('captcha_answer')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="col-lg-12 ">
        <div class="form-group"><button class="btn btn-primary w-100" type="submit">Submit</button></div>
      </div>
    </form>
  </div>
</div>
