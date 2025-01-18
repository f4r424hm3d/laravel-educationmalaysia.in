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
<div class="single_widgets widget_category">
  <h5 class="title text-center">Get in touch</h5>
  <div class="row align-items-center booking p-0">
    @error('g-recaptcha-response')
      <span class="text-danger">{{ $message }}</span>
    @enderror
    <form action="{{ route('stream.inquiry') }}" method="post" class="p-3">
      @csrf
      @if (Request::segment(1) == 'stream')
        <input type="hidden" name="source" value="Education Malaysia - Specialization Page">
      @endif
      @if (Request::segment(1) == 'course')
        <input type="hidden" name="source" value="Education Malaysia - Course Category Page">
      @endif
      <input type="hidden" name="source_path" value="{{ URL::full() }}">
      <input type="hidden" name="return_path" value="{{ url()->current() }}">

      <!-- Name Field -->
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"
              pattern="[a-zA-Z\s]+" required>
            @error('name')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>

      <!-- Email Field -->
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"
              required>
            @error('email')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>

      <!-- Phone Field -->
      <div class="row">
        <div class="col-5">
          <div class="form-group">
            <label for="c_code">Country Code</label>
            <select class="form-control" name="c_code" id="c_code" required>
              <option value="">Select</option>
              @foreach ($phonecodes as $row)
                <option value="{{ $row->phonecode }}"
                  {{ old('c_code') == $row->phonecode || $row->phonecode == '91' ? 'selected' : '' }}>
                  +{{ $row->phonecode }}
                </option>
              @endforeach
            </select>
            @error('c_code')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-7 pl-0">
          <div class="form-group">
            <label for="mobile">Phone</label>
            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="987654321"
              value="{{ old('mobile') }}" required>
            @error('mobile')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>

      <!-- Nationality Field -->
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="s-nationality">Nationality</label>
            <select class="form-control" name="nationality" id="s-nationality" required>
              <option value="">Select Nationality</option>
              @foreach ($countries as $row)
                <option value="{{ $row->name }}" {{ old('nationality') == $row->name ? 'selected' : '' }}>
                  {{ $row->name }}
                </option>
              @endforeach
            </select>
            @error('nationality')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>

      <!-- Interested Program Field -->
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="interested_program">Select Interested Program</label>
            <select class="form-control" name="interested_program" id="interested_program" required>
              <option value="">Select Interested Program</option>
              @foreach ($programs as $row)
                <option value="{{ $row->course_name }}"
                  {{ old('interested_program') == $row->course_name ? 'selected' : '' }}>
                  {{ $row->course_name }}
                </option>
              @endforeach
            </select>
            @error('interested_program')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>

      <!-- Captcha Field -->
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <input type="text" placeholder="Captcha: {{ $captcha['text'] }} =" class="form-control" disabled readonly>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <input type="text" id="captcha" placeholder="Enter the Captcha Code" class="form-control"
            name="captcha_answer" required>
        </div>
      </div>

      <!-- Terms & Conditions -->
      <div class="row">
        <div class="col-12">
          <div class="form-check mt-2 ml-4">
            <input type="checkbox" id="tnc" name="tnc" required class="form-check-input">
            <label for="tnc" class="allcheckbx">
              I agree to the <a href="{{ url('terms-and-conditions') }}">Terms</a> and <a
                href="{{ url('privacy-policy') }}">Privacy Statement</a>
            </label>
          </div>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="row">
        <div class="col-12">
          <div class="form-group text-center mb-0">
            <button class="btn btn-primary" type="submit">Submit</button>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>
