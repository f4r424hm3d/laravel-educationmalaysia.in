@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="image-cover ed_detail_head lg" style="background:url({{ url('/front/') }}/assets/img/ub.jpg);"
    data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1">Write a Review</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->

  <!-- Content -->
  <section>
    <div class="container">

      <div class="row">

        <div class="col-lg-12 col-md-12">
          @if (session()->has('smsg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session()->get('smsg') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          @if (session()->has('emsg'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session()->get('emsg') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <div class="prc_wrap">
            <div class="prc_wrap_header">
              <h4 class="property_block_title theme-cl">Your Review of Your Institution Experience Can Help Others</h4>
            </div>
            <div class="prc_wrap-body">
              <div class="contact-info">
                <p>Thank you for writing a review of your experience at University Name. Your honest feedback can help
                  future students make the right decision about their choice of institution and course.</p>
              </div>
            </div>
          </div>

          <div class="prc_wrap bg-light">
            <div class="prc_wrap-body">

              <h4 class="mt-2">Rate the University - <span class="theme-cl">SUBMIT YOUR REVIEW</span></h4>
              <p>Your email address will not be published. Required fields are marked<span class="theme-cl">*</span></p>
              <form action="{{ route('add.review') }}" method="post">
                @csrf
                <div class="row">

                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Your Name</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-user"></span></div>
                        <input name="name" type="text" class="form-control b-0 pl-0" placeholder="Enter your name"
                          value="{{ old('name') }}" required="">
                        <span class="text-danger">
                          @error('nationality')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Your Email</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-email"></span></div>
                        <input name="email" type="email" class="form-control b-0 pl-0" placeholder="Enter your email"
                          value="{{ old('name') }}" required="">
                        <span class="text-danger">
                          @error('email')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4">
                    <label>Your Mobile No.</label>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-mobile"></span></div>
                        <input name="mobile" type="number" class="form-control b-0 pl-0"
                          placeholder="Enter your mobile no." value="{{ old('mobile') }}" required="">
                        <span class="text-danger">
                          @error('mobile')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Select College/University</label>
                      <select id="university" name="university" class="form-control">
                        <option value="">Select University</option>
                        @foreach ($universities as $row)
                          <option value="{{ $row->id }}"
                            {{ old('university') && old('university') == $row->id ? 'Selected' : '' }}>
                            {{ $row->name }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Select Programme</label>
                      <select id="program" name="program" class="form-control">
                        <option value="">Select Program</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Passing Year</label>
                      <select name="passing_year" id="passing_year" class="form-control">
                        <option value="">Select Year</option>
                        @for ($year = 1980; $year <= date('Y'); $year++)
                          <option value="{{ $year }}"
                            {{ old('passing_year') && old('passing_year') == $year ? 'Selected' : '' }}>
                            {{ $year }}
                          </option>
                        @endfor
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <label>Review Title* <i class="fa fa-info-circle theme-cl" data-toggle="tooltip"
                          title="Give your review title"></i> <span class="pl-2 theme-cl font-size-13">(Title cannot be
                          less
                          than 20 and more than 100 characters.)</span></label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-briefcase"></span></div>
                        <input name="review_title" type="text" class="form-control b-0 pl-0"
                          placeholder="How would you sum up your experience studying at this institution in a sentence?"
                          value="{{ old('review_title') }}" required="">
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12 col-md-12">
                    <div class="form-group mb-2">
                      <label>Write a Review* <i class="fa fa-info-circle theme-cl" data-toggle="tooltip"
                          title="Give your review"></i> <span class="pl-2 theme-cl font-size-13">(Description cannot be
                          less than 150 characters.)</span></label>
                      <div class="input-group input-group-merge">
                        <div class="input-icon align-items-start pt-3"><span class="ti-pencil-alt color-primary"></span>
                        </div>
                        <textarea name="description" id="description" type="text" class="form-control b-0 pl-0"
                          placeholder="Share your experience at this institution from the time you first enrolled to its various course subjects, student lifestyle, teaching and facilities."
                          style="height:100px; padding-top:17px">{{ old('description') }}</textarea>
                      </div>
                      <div class="star-rating mt-2">
                        @for ($i = 1; $i <= 5; $i++)
                          <input id="star-{{ $i }}" type="radio" name="rating"
                            value="{{ $i }}" />
                          <label for="star-{{ $i }}" title="{{ $i }} star">
                            <i class="active fa fa-star" aria-hidden="true"></i>
                          </label>
                        @endfor
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group mb-0">
                  <button class="btn btn-modern float-none" type="submit">
                    Submit Review <span><i class="fa fa-angle-right"></i></span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>
  <!-- Content -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#university').change(function() {
        let universityId = $(this).val();
        let programDropdown = $('#program');

        // Clear existing options
        programDropdown.empty();
        programDropdown.append('<option value="">Select Program</option>');

        if (universityId) {
          $.ajax({
            url: '{{ route('review.get.programs') }}',
            type: 'GET',
            data: {
              university_id: universityId,
            },
            success: function(data) {
              $.each(data, function(id, program) {
                programDropdown.append('<option value="' + id + '">' + program + '</option>');
              });
            },
            error: function() {
              alert('Failed to fetch programs. Please try again later.');
            }
          });
        }
      });
    });
  </script>
@endsection
