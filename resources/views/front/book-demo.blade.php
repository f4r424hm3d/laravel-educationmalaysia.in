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
                      <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut-->
                      <!--  labore et dolore magna aliqua.</p>-->
                    </div>
                    <div class="_loh_foot_r93">
                      <h4>Britanncia Overseas Education</h4>
                      <span>Study Abroad Consultant</span>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-7 position-static p-2">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <div class="log_wraps booking">
              @error('g-recaptcha-response')
                <span class="text-danger">{{ $message }}</span>
              @enderror
              <form action="{{ url('book-demo/save-info') }}" method="post">
                @csrf
                <input type="hidden" name="source_path" value="{{ url()->previous() }}">
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                <div class="row align-items-center">

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>Destination</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-book"></span></div>
                        <select name="preferred_destination" class="form-control b-0 pl-0 bg-white" required>
                          <option value="">Select Preferred Destination</option>
                          @foreach ($destinations as $row)
                            <option value="{{ $row->destination_name }}"
                              {{ $row->destination_name == old('preferred_destination') ? 'selected' : '' }}>
                              {{ $row->destination_name }}
                            </option>
                          @endforeach
                        </select>
                        @error('preferred_destination')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>Degree you’re planning to study</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-book"></span></div>
                        <select name="degree_planning_to_study" class="form-control b-0 pl-0 bg-white" required>
                          <option value="">Select type of degree</option>
                          @foreach ($levels as $row)
                            <option value="{{ $row->level }}"
                              {{ $row->level == old('degree_planning_to_study') ? 'selected' : '' }}>{{ $row->level }}
                            </option>
                          @endforeach
                        </select>
                        @error('degree_planning_to_study')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>When are you going to study abroad?</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-calendar"></span></div>
                        <select name="year_planning_to_study" class="form-control b-0 pl-0 bg-white" required>
                          <option value="">Select year</option>
                          @php
                            $years = [date('Y'), date('Y', strtotime('+1 year')), date('Y', strtotime('+2 year'))];
                          @endphp
                          @foreach ($years as $year)
                            <option value="{{ $year }}"
                              {{ $year == old('year_planning_to_study') ? 'selected' : '' }}>{{ $year }}
                            </option>
                          @endforeach
                        </select>
                        @error('year_planning_to_study')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>Are you Interested in Paid Counselling?</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-user"></span></div>
                        <select name="intrested_in_paid_counselling" class="form-control b-0 pl-0 bg-white" required>
                          <option value="">Select type of counselling</option>
                          <option value="Yes" {{ old('intrested_in_paid_counselling') == 'Yes' ? 'selected' : '' }}>
                            Yes
                          </option>
                          <option value="No" {{ old('intrested_in_paid_counselling') == 'No' ? 'selected' : '' }}>No
                          </option>
                          <option value="Not Sure"
                            {{ old('intrested_in_paid_counselling') == 'Not Sure' ? 'selected' : '' }}>Not
                            Sure</option>
                        </select>
                        @error('intrested_in_paid_counselling')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>Name</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-user"></span></div>
                        <input name="name" type="text" class="form-control b-0 pl-0" placeholder="Enter Name"
                          value="{{ old('name') }}" required="">
                      </div>
                      @error('name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>Email ID</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-email"></span></div>
                        <input name="email" type="email" class="form-control b-0 pl-0"
                          placeholder="eg: example@gmail.com" value="{{ old('email') }}" required="">
                      </div>
                      @error('email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                      <div class="mini">You will recieve a verification code on this Email id</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <label>Enter your mobile number</label>
                    <div class="row">
                      <div class="col-3 pr-0">
                        <select name="c_code" class="form-control bg-white p-2" required>
                          @foreach ($countries as $row)
                            <option value="{{ $row->phonecode }}"
                              {{ $row->phonecode == 91 || old('c_code') == $row->phonecode ? 'Selected' : '' }}>
                              +({{ $row->phonecode }}) {{ $row->iso3 }} </option>
                          @endforeach
                        </select>
                        @error('c_code')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-9 pl-1">
                        <div class="form-group mb-0">
                          <div class="input-group">
                            <div class="input-icon"><span class="ti-mobile"></span></div>
                            <input name="mobile" type="text" class="form-control b-0 bg-white pl-0"
                              placeholder="eg. 12345 78901" value="{{ old('mobile') }}" required="">
                          </div>
                          @error('mobile')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="mini">You will recieve a verification code on this number</div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="captcha_question">{{ $question['text'] }}</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-captcha_answer"></span></div>
                        <input type="number" name="captcha_answer" class="form-control b-0 pl-0"
                          placeholder="Enter Captcha Value" required="">
                      </div>
                      @error('captcha_answer')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group"><button class="slot-btn" type="submit">Book Your Slot</button></div>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    grecaptcha.ready(function() {
      grecaptcha.execute('{{ gr_site_key() }}', {
          action: 'contact_us'
        })
        .then(function(token) {
          // Set the reCAPTCHA token in the hidden input field
          document.getElementById('g-recaptcha-response').value = token;
        });
    });
  </script>
@endsection
