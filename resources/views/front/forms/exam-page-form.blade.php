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
  <div class="row">
    @error('g-recaptcha-response')
      <span class="text-danger">{{ $message }}</span>
    @enderror
    <form action="{{ route('stream.inquiry') }}" method="post" class="px-3">
      @csrf
      <input type="hidden" name="source" value="Education Malaysia - Exam Page">
      <input type="hidden" name="source_path" value="{{ URL::full() }}">
      <input type="hidden" name="return_path" value="{{ url()->current() }}">

      <!-- Name Field -->
      <div class="row">
        <div class="col-12 mb-3">
          <div class="form-group text-left">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"
              pattern="[a-zA-Z\s]+" required>
            @error('name')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
     

      <!-- Email Field -->
     
        <div class="col-12 mb-3">
          <div class="form-group text-left">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"
              required>
            @error('email')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
    

      <!-- Phone Field -->
    
        <div class="col-5 mb-3 pr-0">
          <div class="form-group text-left">
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
        <div class="col-7 mb-3">
          <div class="form-group text-left">
            <label for="mobile">Phone</label>
            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="987654321"
              value="{{ old('mobile') }}" required>
            @error('mobile')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
      

      <!-- Nationality Field -->
    
        <div class="col-12 mb-3">
          <div class="form-group text-left">
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
      
      <!-- Interested Program Field -->
     
        <div class="col-12 mb-3 ">
          <div class="form-group text-left">
            <label for="interested_program">Select Interested Exam</label>
            <select class="form-control" name="interested_program" id="interested_program" required>
              <option value="">Select Interested Exam</option>
              @foreach ($allExams as $row)
                <option value="{{ $row->page_name }}"
                  {{ old('interested_program') == $row->page_name ? 'selected' : '' }}>
                  {{ $row->page_name }}
                </option>
              @endforeach
            </select>
            @error('interested_program')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
    

      <!-- Captcha Field -->
    
        <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
          <label for="captcha">Captcha: {{ $captcha['text'] }} =</label>
          <input type="text" id="captcha" placeholder="Enter the Captcha Code" class="form-control"
            name="captcha_answer" required>
        </div>
    

      <!-- Terms & Conditions -->
     
        <div class="col-12 mb-3">
          <div class="form-check mt-2 ml-4">
            <input type="checkbox" id="tnc" name="tnc" required class="form-check-input">
            <label for="tnc" class="allcheckbx">
              I agree to the <a href="{{ url('terms-and-conditions') }}">Terms</a> and <a
                href="{{ url('privacy-policy') }}">Privacy Statement</a>
            </label>
          </div>
        </div>
     

      <!-- Submit Button -->
    
        <div class="col-12 ">
          <div class="form-group  text-center mb-0">
            <button class="btn btn-primary" type="submit">Submit</button>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>
