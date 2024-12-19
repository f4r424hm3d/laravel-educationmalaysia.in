@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.dynamic_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="image-cove ed_detail_head lg" data-overlay="8">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-2 col-md-2 col-6">
          <img data-src="{{ asset($university->logo_path) }}" class="img-fluid circle" alt="{{ $university->name }}">
        </div>
        <div class="col-lg-7 col-md-7">
          <div class="ed_detail_wrap light">
            <div class="ed_header_caption">
              <h1 class="ed_title">{{ $university->name }}</h1>
              <ul class="b-b pb-2 mb-3">
                <li><i class="ti-location-pin"></i><span>Location:</span> {{ $university->city }},
                  {{ $university->state }}</li>

              </ul>
            </div>
            <a href="{{ url($university->slug . '/write-a-review') }}" class="btn btn-white-t-theme">
              <i class="ti-pencil-alt mr-1"></i> Write a review
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-12">
          <div class="rating-overview-box b-0 w-100 text-white">
            <span class="rating-overview-box-total-small">{{ $avrgRating }}/5</span>
            <span class="rating-overview-box-percent">Based on {{ $total }} Student Reviews</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- Menu -->
  @include('front.university-profile-menu')
  <!-- Menu -->

  <!-- Content -->
  <section class="bg-light pt-4 pb-4">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="rating-overview mt-0 mb-0 row align-items-center justify-content-center">

            <div class="col-lg-2 col-md-2 col-12">
              <div class="rating-overview-box w-100 mr-0">
                <span class="rating-overview-box-total">{{ $avrgRating }}/5</span>
                <span class="rating-overview-box-percent">Based on {{ $total }} Review</span>
                <div class="star-rating" data-rating="5"><i class="ti-star"></i><i class="ti-star"></i><i
                    class="ti-star"></i><i class="ti-star"></i><i class="ti-star"></i>
                </div>
              </div>
            </div>

            <div class="rating-bars col-md-8">
              <div class="rating-bars-item">
                <span class="rating-bars-name">College Infrastructure</span>
                <span class="rating-bars-inner">
                  <span class="rating-bars-rating high" data-rating="5">
                    <span class="rating-bars-rating-inner" style="width:{{ getPerc($air, '5') }}%;"></span>
                  </span>
                  <strong>{{ $air }}/5</strong>
                </span>
              </div>
              <div class="rating-bars-item">
                <span class="rating-bars-name">Faculty</span>
                <span class="rating-bars-inner">
                  <span class="rating-bars-rating good" data-rating="5">
                    <span class="rating-bars-rating-inner" style="width:{{ getPerc($afr, '5') }}%;"></span>
                  </span>
                  <strong>{{ $afr }}/5</strong>
                </span>
              </div>
              <div class="rating-bars-item">
                <span class="rating-bars-name">Placement</span>
                <span class="rating-bars-inner">
                  <span class="rating-bars-rating mid" data-rating="5">
                    <span class="rating-bars-rating-inner" style="width:{{ getPerc($apr, '5') }}%;"></span>
                  </span>
                  <strong>{{ $apr }}/5</strong>
                </span>
              </div>
              <div class="rating-bars-item">
                <span class="rating-bars-name">Hostel Life</span>
                <span class="rating-bars-inner">
                  <span class="rating-bars-rating poor" data-rating="5">
                    <span class="rating-bars-rating-inner" style="width:{{ getPerc($ahr, '5') }}%;"></span>
                  </span>
                  <strong>{{ $ahr }}/5</strong>
                </span>
              </div>
            </div>

            <div class="col-lg-2 col-md-2 col-12">
              <span class="rating-overview-box-percent text-center">
                <strong>100% Reviewer</strong><br>Recommends this college
              </span>
            </div>

          </div>
        </div>
      </div>

      <div class="row align-items-center mt-4">
        <div class="col-lg-6 col-md-6 col-sm-6 col-8">Showing {{ $total }} Reviews</div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-4 ordering">
          <div class="filter_wraps">
            <div class="dropdown">
              <a class="btn btn-custom text-white rounded dropdown-toggle" href="#" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort by</a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start">
                <a class="dropdown-item" href="#">Heighest</a>
                <a class="dropdown-item" href="#">Hight</a>
                <a class="dropdown-item" href="#">Medium</a>
                <a class="dropdown-item" href="#">Low</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      @foreach ($rows as $row)
        <div class="edu_wraper mt-3">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="show-more-box-country">
                <div class="text show-more-heigh">
                  <div class="author pt-0">
                    <div class="img-div"><img data-src="{{ asset('front/assets/img/user-3.jpg') }}"
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

                    <div class="rating-right">{{ $row->rating }}</div>

                  </div>

                  <h5 class="mt-4 mb-0">{{ $row->title }}</h5>
                  <p>{{ $row->review }}</p>

                  <h5 class="mt-4 mb-0">Infrastructure</h5>
                  <p>{{ $row->infrastructure_review }}</p>

                  <h5 class="mt-4 mb-0">Faculty</h5>
                  <p>{{ $row->faculty_review }}</p>

                  <h5 class="mt-4 mb-0">Placement</h5>
                  <p>{{ $row->placement_review }}</p>

                  <h5 class="mt-4 mb-0">Hostel</h5>
                  <p>{{ $row->hostel_review }}</p>

                  <div class="row">
                    <div class="col-md-3 col-6">
                      <p class="mb-0 fw-600">Infrastructure</p>
                      <div class="star-rating" data-rating="5">
                        <?php
                      $br = 5-$row->infrastructure_rating;
                      for ($i=1;$i<=$row->infrastructure_rating;$i++){
                    ?>
                        <i class="ti-star green"></i>
                        <?php } ?>
                        <?php
                      for ($i=1;$i<=$br;$i++){
                    ?>
                        <i class="ti-star yellow"></i>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="col-md-3 col-6">
                      <p class="mb-0 fw-600">Faculty</p>
                      <div class="star-rating" data-rating="5">
                        <?php
                      $br = 5-$row->faculty_rating;
                      for ($i=1;$i<=$row->faculty_rating;$i++){
                    ?>
                        <i class="ti-star green"></i>
                        <?php } ?>
                        <?php
                      for ($i=1;$i<=$br;$i++){
                    ?>
                        <i class="ti-star yellow"></i>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="col-md-3 col-6">
                      <p class="mb-0 fw-600">Placement</p>
                      <div class="star-rating" data-rating="5">
                        <?php
                      $br = 5-$row->placement_rating;
                      for ($i=1;$i<=$row->placement_rating;$i++){
                    ?>
                        <i class="ti-star green"></i>
                        <?php } ?>
                        <?php
                      for ($i=1;$i<=$br;$i++){
                    ?>
                        <i class="ti-star yellow"></i>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="col-md-3 col-6">
                      <p class="mb-0 fw-600">Hostel Life</p>
                      <div class="star-rating" data-rating="5">
                        <?php
                      $br = 5-$row->hostel_rating;
                      for ($i=1;$i<=$row->hostel_rating;$i++){
                    ?>
                        <i class="ti-star green"></i>
                        <?php } ?>
                        <?php
                      for ($i=1;$i<=$br;$i++){
                    ?>
                        <i class="ti-star yellow"></i>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
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
