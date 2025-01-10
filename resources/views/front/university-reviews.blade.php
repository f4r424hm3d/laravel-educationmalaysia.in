@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.dynamic_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  @include('front.university-profile')
  <!-- Breadcrumb -->
  <!-- Menu -->
  @include('front.university-profile-menu')
  <!-- Menu -->

  <!-- Content -->
  <section class="bg-light pt-4 pb-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="rating-overvie">
<div class="row">
<div class="col-lg-12 col-md-12 col-12">
              <div class="rating-overview-box w-100 mr-0">
                <h2 class="text-center revewiws"> Rating and Reviews</h2>
                <div class="d-flex align-items-center ratingss ">
                <div class="star-rating" data-rating="5">
                  <i class="ti-star"></i>
                  <i class="ti-star"></i>
                  <i class="ti-star"></i>
                  <i class="ti-star"></i>
                  <i class="ti-star"></i>
                </div>
                <div class="ratingreview" >
                <span class="rating-overview-box-total">{{ $avrgRating }} out of 5</span>
                <span class="rating-overview-box-percent">Based on {{ $total }} Review</span>
                </div>
                </div>
                
                
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-12">
              <span class="rating-overview-box-percent text-center mt-3">
                <strong>100% Reviewer</strong><br>Recommends this college
              </span>
            </div>

</div>
           
          </div>
        </div>
      </div>

      <div class="row align-items-center mt-4">
        <div class="col-lg-6 col-md-6 col-sm-6 col-8">Showing {{ $total }} Reviews</div>

      </div>

      @foreach ($rows as $row)
        <div class="edu_wraper mt-3">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="show-more-box-country">
                <div class="text show-more-heigh">
                  <div class="author pt-0">
                    <div class="img-div"><img data-src="{{ asset('front/assets/img/user.jpg') }}"
                        alt="{{ $row->name }}"><i class="fa fa-check-circle"></i>
                    </div>
                    <div class="cont-div">
                      <h5 class="mb-0">{{ $row->name }}</h5>
                      <div data-rating="5">
                        <?php
                      $br = 5-$row->rating;
                      for ($i=1;$i<=$row->rating;$i++){
                    ?>
                        <i class="ti-star green"></i>
                        <?php } ?>
                        <?php
                      for ($i=1;$i<=$br;$i++){
                    ?>
                        <i class="ti-star yellow"></i>
                        <?php } ?>
                        <span class="d-inline-block"><i class="ti-check-box theme-cl ml-2"></i> Verified
                          Review</span><br>
                        <span class="d-inline-block">Post on - {{ getFormattedDate($row->created_at, 'M d, Y') }}
                          &nbsp;<b class="d-inline-block fw-600">by {{ $row->name }}</b></span>
                      </div>
                    </div>

                    <div class="rating-right">{{ $row->rating / 2 }}</div>

                  </div>

                  <h5 class="mt-4 mb-0">{{ $row->review_title }}</h5>
                  <p>{{ $row->description }}</p>

                  @foreach ($row->categoryReviews as $cr)
                    <h5 class="mt-4 mb-0">{{ $cr->category->name }}</h5>
                    <p>{{ $row->review }}</p>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </section>
  <!-- Content -->
@endsection
