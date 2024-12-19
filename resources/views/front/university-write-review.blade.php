@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.dynamic_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="ed_detail_head lg" data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1"><a href="{{ url($university->slug) }}">Reviwe {{ $university->name }}</a></li>
              <li class="facts-1">Write a Review</li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">{{ $university->name }} Reviews</h1>
            </div>
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
            </div>
          @endif
          @if (session()->has('emsg'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session()->get('emsg') }}
            </div>
          @endif

          <div class="prc_wrap">
            <div class="prc_wrap_header">
              <h4 class="property_block_title theme-cl1">Your Review of Your Institution Experience Can Help Others
              </h4>
            </div>
            <div class="prc_wrap-body">
              <div class="contact-info">
                <p>Thank you for writing a review of your experience at {{ $university->name }}. Your honest feedback can help
                  future students make the right decision about their choice of institution and course.</p> <a href="{{ url($university->slug) }}">View Full Details of {{ $university->name }}</a>
              </div>
            </div>
          </div>

          <div class="prc_wrap bg-light">
            <div class="prc_wrap-body">

              <h4 class="mt-2">Rate the {{ $university->name }} - <span class="theme-cl1">SUBMIT YOUR REVIEW</span></h4>
              <p>Your email address will not be published. Required fields are marked<span class="theme-cl1">*</span>
              </p>
              <form action="{{ url('university/write-review') }}" method="post">
                @csrf
                <input type="hidden" name="university_id" value="{{ $university->id }}">
                <div class="row">

                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Your Name</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-user"></span></div>
                        <input name="name" type="text" class="form-control b-0 pl-0" placeholder="Enter your name"
                          required="">
                      </div>
                      <span class="text-danger">
                        @error('name')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Your Email</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-email"></span></div>
                        <input name="email" type="email" class="form-control b-0 pl-0" placeholder="Enter your email"
                          required="">
                      </div>
                      <span class="text-danger">
                        @error('email')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4">
                    <label>Your Mobile No.</label>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-mobile"></span></div>
                        <input name="mobile" type="number" class="form-control b-0 pl-0"
                          placeholder="Enter your mobile no." required="">
                      </div>
                      <span class="text-danger">
                        @error('mobile')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Select Program</label>
                      <select name="program" class="form-control">
                        <option value="">Select</option>
                        @foreach ($programs as $row)
                          <option id="{{ $row->id }}">{{ $row->program_name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('program')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Passing Year</label>
                      <input name="passing_year" type="year" class="form-control b-0"
                        placeholder="Enter your passing year" required="">
                      <span class="text-danger">
                        @error('passing_year')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>

                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <label>Review Title* <i class="fa fa-info-circle theme-cl1" data-toggle="tooltip"
                          title="Give your review title"></i> <span class="pl-2 theme-cl1 font-size-13">(Title cannot be
                          less than 20 and more than 100 characters.)</span></label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-briefcase"></span></div>
                        <input name="title" type="text" class="form-control b-0 pl-0"
                          placeholder="How would you sum up your experience studying at this institution in a sentence?"
                          required="">
                      </div>
                      <span class="text-danger">
                        @error('title')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>

                  <div class="col-lg-12 col-md-12">
                    <div class="form-group mb-2">
                      <label>Write a Review* <i class="fa fa-info-circle theme-cl1" data-toggle="tooltip"
                          title="Give your review"></i> <span class="pl-2 theme-cl1 font-size-13">(Description cannot be
                          less than 150 characters.)</span></label>
                      <div class="input-group input-group-merge">
                        <div class="input-icon align-items-start pt-3"><span class="ti-pencil-alt color-primary"></span>
                        </div>
                        <textarea name="review" id="review" type="text" class="form-control b-0 pl-0"
                          placeholder="Share your experience at this institution from the time you first enrolled to its various course subjects, student lifestyle, teaching and facilities."
                          style="height:100px; padding-top:17px"></textarea>
                      </div>
                      <span class="text-danger">
                        @error('review')
                          {{ $message }}
                        @enderror
                      </span>
                      <br>
                      <div class="star-rating mt-2">
                        <input id="star-5" type="radio" name="rating" value="5" />
                        <label for="star-5" title="5 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-4" type="radio" name="rating" value="4" />
                        <label for="star-4" title="4 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-3" type="radio" name="rating" value="3" />
                        <label for="star-3" title="3 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-2" type="radio" name="rating" value="2" />
                        <label for="star-2" title="2 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-1" type="radio" name="rating" value="1" />
                        <label for="star-1" title="1 star"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                      </div>
                      <br>
                      <span class="text-danger">
                        @error('rating')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-2">
                      <label>Infrastructure* <i class="fa fa-info-circle theme-cl1" data-toggle="tooltip"
                          title="Give your review"></i> <span class="pl-2 theme-cl1 font-size-13">(Description cannot be
                          less than 150 characters.)</span></label>
                      <textarea name="infrastructure_review" id="infrastructure_review" type="text" class="form-control b-0"
                        placeholder="" style="height:80px;"></textarea>
                      <span class="text-danger">
                        @error('infrastructure_review')
                          {{ $message }}
                        @enderror
                      </span>
                      <br>
                      <div class="star-rating mt-2">
                        <input id="star-10" type="radio" name="infrastructure_rating" value="5">
                        <label for="star-10" title="5 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-9" type="radio" name="infrastructure_rating" value="4">
                        <label for="star-9" title="4 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-8" type="radio" name="infrastructure_rating" value="3">
                        <label for="star-8" title="3 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-7" type="radio" name="infrastructure_rating" value="2">
                        <label for="star-7" title="2 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-6" type="radio" name="infrastructure_rating" value="1">
                        <label for="star-6" title="1 star"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                      </div>
                      <br>
                      <span class="text-danger">
                        @error('infrastructure_rating')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-2">
                      <label>Faculty* <i class="fa fa-info-circle theme-cl1" data-toggle="tooltip"
                          title="Give your review"></i> <span class="pl-2 theme-cl1 font-size-13">(Description cannot be
                          less than 150 characters.)</span></label>
                      <textarea name="faculty_review" id="faculty_review" type="text" class="form-control b-0" placeholder=""
                        style="height:80px;"></textarea>
                      <span class="text-danger">
                        @error('faculty_review')
                          {{ $message }}
                        @enderror
                      </span>
                      <br>
                      <div class="star-rating mt-2">
                        <input id="star-15" type="radio" name="faculty_rating" value="5">
                        <label for="star-15" title="5 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-14" type="radio" name="faculty_rating" value="4">
                        <label for="star-14" title="4 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-13" type="radio" name="faculty_rating" value="3">
                        <label for="star-13" title="3 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-12" type="radio" name="faculty_rating" value="2">
                        <label for="star-12" title="2 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-11" type="radio" name="faculty_rating" value="1">
                        <label for="star-11" title="1 star"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                      </div>
                      <br>
                      <span class="text-danger">
                        @error('faculty_rating')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-2">
                      <label>Placement* <i class="fa fa-info-circle theme-cl1" data-toggle="tooltip"
                          title="Give your review"></i> <span class="pl-2 theme-cl1 font-size-13">(Description cannot be
                          less than 150 characters.)</span></label>
                      <textarea name="placement_review" id="placement_review" type="text" class="form-control b-0" placeholder=""
                        style="height:80px;"></textarea>
                      <span class="text-danger">
                        @error('placement_review')
                          {{ $message }}
                        @enderror
                      </span>
                      <br>
                      <div class="star-rating mt-2">
                        <input id="star-20" type="radio" name="placement_rating" value="5">
                        <label for="star-20" title="5 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-19" type="radio" name="placement_rating" value="4">
                        <label for="star-19" title="4 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-18" type="radio" name="placement_rating" value="3">
                        <label for="star-18" title="3 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-17" type="radio" name="placement_rating" value="2">
                        <label for="star-17" title="2 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-16" type="radio" name="placement_rating" value="1">
                        <label for="star-16" title="1 star"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                      </div>
                      <br>
                      <span class="text-danger">
                        @error('placement_rating')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-2">
                      <label>Hostel Life* <i class="fa fa-info-circle theme-cl1" data-toggle="tooltip"
                          title="Give your review"></i> <span class="pl-2 theme-cl1 font-size-13">(Description cannot be
                          less than 150 characters.)</span></label>
                      <textarea name="hostel_review" id="hostel_review" type="text" class="form-control b-0" placeholder=""
                        style="height:80px;"></textarea>
                      <span class="text-danger">
                        @error('hostel_review')
                          {{ $message }}
                        @enderror
                      </span>
                      <br>
                      <div class="star-rating mt-2">
                        <input id="star-25" type="radio" name="hostel_rating" value="5">
                        <label for="star-25" title="5 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-24" type="radio" name="hostel_rating" value="4">
                        <label for="star-24" title="4 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-23" type="radio" name="hostel_rating" value="3">
                        <label for="star-23" title="3 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-22" type="radio" name="hostel_rating" value="2">
                        <label for="star-22" title="2 stars"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                        <input id="star-21" type="radio" name="hostel_rating" value="1">
                        <label for="star-21" title="1 star"><i class="active fa fa-star"
                            aria-hidden="true"></i></label>
                      </div>
                      <br>
                      <span class="text-danger">
                        @error('hostel_rating')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>

                </div>

                <div class="form-group mb-0">
                  <button class="btn btn-modern float-none" type="submit">
                    Submit Review <span><i class="ti-arrow-right"></i></span>
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
@endsection
