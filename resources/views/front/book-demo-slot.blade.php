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
              <form action="{{ url('book-slot/save-slot') }}" method="post">
                @csrf
                <div class="row align-items-center">

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Select date</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-calendar"></span></div>
                        <input name="preferred_counselling_date" type="date" class="form-control b-0 pl-0"
                          placeholder="Select a date" value="{{ old('preferred_counselling_date') }}" required=""
                          min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                      </div>
                      @error('preferred_counselling_date')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Select time</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-timer"></span></div>
                        <input name="preferred_counselling_time" type="time" class="form-control b-0 pl-0"
                          placeholder="Select a slot" value="{{ old('preferred_counselling_time') }}" required="">
                      </div>
                      @error('preferred_counselling_time')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group mb-0">
                      <label>Courses you’re interested in</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-search"></span></div>
                        <select name="intrested_course_category" class="form-control b-0 pl-0 bg-white" required>
                          <option value="">Select</option>
                          @foreach ($courseCategories as $row)
                            <option value="{{ $row->category_name }}"
                              {{ $row->category_name == old('intrested_course_category') ? 'selected' : '' }}>
                              {{ $row->category_name }}
                            </option>
                          @endforeach
                        </select>
                        @error('intrested_course_category')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    {{-- <div class="mini">You can choose up to 2 courses<br>
                      <div class="course-btns">
                        <a href="javascript:void(0)" class="course-btn">Data Science and Business Intelligence <span
                            class="cross">×</span></a>
                        <a href="javascript:void(0)" class="course-btn">Data Science and Business Intelligence <span
                            class="cross">×</span></a>
                      </div>
                    </div> --}}
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>Where are you in your study abroad journey?</label>
                      <div class="input-group">
                        <select name="study_abroad_journey_status" class="form-control b-0 pl-0 bg-white">
                          <option value="">Select stage</option>
                          @foreach ($sajs as $stage)
                            <option value="{{ $stage }}"
                              {{ $stage == old('study_abroad_journey_status') ? 'selected' : '' }}>{{ $stage }}
                            </option>
                          @endforeach
                        </select>
                        @error('study_abroad_journey_status')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group"><button class="slot-btn" type="submit">Finish Booking</button></div>
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
