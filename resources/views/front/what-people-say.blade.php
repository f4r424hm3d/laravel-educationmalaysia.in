@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <section class="people-testi">
    <div class="container">
      <div class="reviewss">
        <h2>What People Are Saying About Us</h2>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">

          <div id="carouselExampleControls" class="carousel slide users-collapse pb-5 " data-ride="carousel">
            <div class="carousel-inner">
              @if ($students->count() > 0)
                <div class="carousel-item active">
                  <div class="say-h2"> What our users say ?</div>
                  <div class="overflows mx-5">
                    <div class="row">
                      @foreach ($students as $row)
                        <div class="col-lg-6">
                          <div class="u-stall">
                            <div class="img-box"><img src=" {{ cdn('assets/web/images/testimonialimage.png') }}"
                                class="img-fluid" alt=""></div>
                            <p class="testimonial">{{ $row->review }}</p>
                            <p class="overview"><b>{{ $row->name }} , </b> {{ $row->country }}</p>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                </div>
              @endif
              @if ($guardians->count() > 0)
                <div class="carousel-item">
                  <div class="say-h2"> What guardian say ?</div>
                  <div class="overflows mx-5">
                    <div class="row">
                      @foreach ($guardians as $row)
                        <div class="col-lg-6">
                          <div class="u-stall">
                            <div class="img-box"><img src=" {{ cdn('assets/web/images/testimonialimage.png') }}"
                                class="img-fluid" alt=""></div>
                            <p class="testimonial">{{ $row->review }}</p>
                            <p class="overview"><b>{{ $row->name }} , </b> {{ $row->country }}</p>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                </div>
              @endif
              @if ($universities->count() > 0)
                <div class="carousel-item">
                  <div class="say-h2"> What our Universities say ?</div>
                  <div class="overflows mx-5">
                    <div class="row">
                      @foreach ($universities as $row)
                        <div class="col-lg-6">
                          <div class="u-stall">
                            <div class="img-box"><img src=" {{ cdn('assets/web/images/testimonialimage.png') }}"
                                class="img-fluid" alt=""></div>
                            <p class="testimonial">{{ $row->review }}</p>
                            <p class="overview"><b>{{ $row->name }} , </b> {{ $row->country }}</p>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                </div>
              @endif
            </div>

            <a class="carousel-control left carousel-control-prev" href="#carouselExampleControls" role="button"
              data-slide="prev">
              <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control right carousel-control-next" href="#carouselExampleControls" data-slide="next">
              <i class="fa fa-angle-right"></i>
            </a>
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="reviewss allusrs">
            <h2 class="review-write">Write Reviews </h2>
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
            <form method="post" action="{{ route('testimonial.add') }}">
              @csrf
              <div class="row">

                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                      value="{{ old('name') }}">
                    @error('name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                      placeholder="Email ID" value="{{ old('email') }}">
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <select class="form-control" id="user_type" name="user_type">
                      <option value="">What you are ?</option>
                      <option value="Student" {{ old('user_type') == $row->name ? 'Student' : '' }}>Student</option>
                      <option value="Guardian" {{ old('user_type') == $row->name ? 'Guardian' : '' }}>Guardian</option>
                      <option value="University" {{ old('user_type') == $row->name ? 'University' : '' }}>University
                      </option>
                    </select>
                    @error('user_type')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <select class="form-control" id="country" name="country">
                      <option value="">Select Country</option>
                      @foreach ($countries as $row)
                        <option value="{{ $row->name }}" {{ old('country') == $row->name ? 'selected' : '' }}>
                          {{ $row->name }}</option>
                      @endforeach
                    </select>
                    @error('country')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <textarea class="form-control" id="review" name="review" placeholder="Enter Your Review" rows="3">{{ old('review') }}</textarea>
                    @error('review')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div> <button type="submit" class="btn btn-primary w-100 ">Submit</button>
            </form>
          </div>
        </div>
      </div>

    </div>
    </div>
  </section>
@endsection
