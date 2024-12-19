@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="image-cover ed_detail_head lg" style="background:url({{ url('/front/') }}/assets/img/ub.jpg);"
    data-overlay="8">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-2 col-md-2 col-6"><img data-src="{{ url('front/') }}/assets/img/u-logo.jpeg"
            class="img-fluid circle" alt=""></div>
        <div class="col-lg-7 col-md-7">
          <div class="ed_detail_wrap light">
            <!--ul class="cources_facts_list">
  <li class="facts-1"><a href="#">Study In Canada</a></li>
  <li class="facts-1"><a href="#">Universities In Canada</a></li>
  <li class="facts-1"><a href="#">U Of T</a></li>
  <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
  </ul-->
            <div class="ed_header_caption">
              <h1 class="ed_title">University of Toronto</h1>
              <ul class="b-b pb-2 mb-3">
                <li><i class="ti-location-pin"></i><span>Location:</span> Toronto, Ontario</li>
                <!--li><i class="fa fa-building"></i><span>Founded:</span> 1827</li>
  <li><i class="fa fa-globe"></i><span>World Rank:</span> 114</li-->
              </ul>
            </div>
            <!--a href="{{ url('/sign-up/?return_to=') }}" class="btn btn-white-t-theme mr-3"><i class="ti-download mr-1"></i> Download Brochure</a>
  <a href="{{ url('/sign-up/?return_to=') }}" class="btn btn-white-theme mr-3"><i class="ti-user mr-1"></i> Get free counselling</a-->
            <a href="write-a-review.html" class="btn btn-white-t-theme"><i class="ti-pencil-alt mr-1"></i> Write a
              review</a>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-12">
          <div class="rating-overview-box b-0 w-100 text-white">
            <span class="rating-overview-box-total-small">5/5</span>
            <span class="rating-overview-box-percent">Based on 1 Student Reviews</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->

  <!-- Menu -->
  <div class="container">
    <div class="new-links">
      <ul class="vertically-scrollbar">
        <li><a href="university-profile.html">Overview</a></li>
        <li><a href="all-programs.html">Courses & Fees</a></li>
        <li><a href="#">Admission</a></li>
        <li><a href="#">Ranking</a></li>
        <li><a href="#">Gallery</a></li>
        <li><a href="#">Scholarship</a></li>
        <li><a href="#">Placements</a></li>
        <li><a href="#">Accommodation</a></li>
        <li class="active"><a href="reviews.html">Reviews</a></li>
      </ul>
    </div>
  </div>
  <!-- Menu -->

  <!-- Content -->
  <section class="bg-light pt-4 pb-4">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="rating-overview mt-0 mb-0 row align-items-center justify-content-center">

            <div class="col-lg-2 col-md-2 col-12">
              <div class="rating-overview-box w-100 mr-0">
                <span class="rating-overview-box-total">5/5</span>
                <span class="rating-overview-box-percent">Based on 1 Review</span>
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
                    <span class="rating-bars-rating-inner" style="width:100%;"></span>
                  </span>
                  <strong>5/5</strong>
                </span>
              </div>
              <div class="rating-bars-item">
                <span class="rating-bars-name">Faculty</span>
                <span class="rating-bars-inner">
                  <span class="rating-bars-rating good" data-rating="5">
                    <span class="rating-bars-rating-inner" style="width:100%;"></span>
                  </span>
                  <strong>5/5</strong>
                </span>
              </div>
              <div class="rating-bars-item">
                <span class="rating-bars-name">Placement</span>
                <span class="rating-bars-inner">
                  <span class="rating-bars-rating mid" data-rating="5">
                    <span class="rating-bars-rating-inner" style="width:100%;"></span>
                  </span>
                  <strong>5/5</strong>
                </span>
              </div>
              <div class="rating-bars-item">
                <span class="rating-bars-name">Hostel Life</span>
                <span class="rating-bars-inner">
                  <span class="rating-bars-rating poor" data-rating="5">
                    <span class="rating-bars-rating-inner" style="width:100%;"></span>
                  </span>
                  <strong>5/5</strong>
                </span>
              </div>
            </div>

            <div class="col-lg-2 col-md-2 col-12">
              <span class="rating-overview-box-percent text-center"><strong>100% Reviewer</strong><br>Recommends this
                college</span>
            </div>

          </div>
        </div>
      </div>

      <div class="row align-items-center mt-4">
        <div class="col-lg-6 col-md-6 col-sm-6 col-8">Showing 10 Reviews</div>
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

      <div class="edu_wraper mt-3">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="show-more-box-country">
              <div class="text show-more-height">
                <div class="author pt-0">
                  <div class="img-div"><img data-src="{{ url('front/') }}/assets/img/user-3.jpg" alt=""><i
                      class="fa fa-check-circle"></i></div>
                  <div class="cont-div">
                    <h5 class="mb-0">Student Abdul</h5>
                    <div data-rating="5">
                      <i class="ti-star green"></i><i class="ti-star green"></i><i class="ti-star green"></i><i
                        class="ti-star green"></i><i class="ti-star green"></i>
                      <span class="d-inline-block"><i class="ti-check-box theme-cl ml-2"></i> Verified Review</span><br>
                      <span class="d-inline-block">Post on - Jan 5, 2023 &nbsp;<b class="d-inline-block fw-600">by
                          (Abdul) Mohd Abdul Rafay</b></span>
                    </div>
                  </div>

                  <div class="rating-right">5</div>

                </div>

                <!--h4 class="mb-1">Student Wafa</h4>
  <div class="star-rating  green" data-rating="5"><i class="ti-star"></i><i class="ti-star"></i><i class="ti-star"></i><i class="ti-star"></i><i class="ti-star"></i>
  </div> <span class=" theme-cl"><i class="ti-check-box ml-2"></i> Verified Review</span>
  <p>Post on - Jan 5, 2023 <span class="fw-600">by (Wafa) Sayyeda Fatima Naurizadeh</span></p>
  <p class="fw-600">Batch of 2022 | Bechlor of Information Technology (Hons) Data Analytics</p-->

                <h5 class="mt-4 mb-0">College Infrastructure</h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                  into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                  release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                  software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                <h5 class="mt-4 mb-0">Faculty</h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.</p>

                <h5 class="mt-4 mb-0">Placement</h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                  into electronic typesetting, remaining essentially unchanged.</p>

                <h5 class="mt-4 mb-0">Hostel Life</h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                  into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                  release of Letraset sheets containing Lorem Ipsum passages.</p>

                <h5 class="mt-4 mb-0">Enything Else</h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                  into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                  release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                  software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                <div class="row">
                  <div class="col-md-3 col-6">
                    <p class="mb-0 fw-600">Infrastructure</p>
                    <div class="star-rating  green" data-rating="5"><i class="ti-star"></i><i class="ti-star"></i><i
                        class="ti-star"></i><i class="ti-star"></i><i class="ti-star"></i>
                    </div>
                  </div>
                  <div class="col-md-3 col-6">
                    <p class="mb-0 fw-600">Faculty</p>
                    <div class="star-rating  green" data-rating="5"><i class="ti-star"></i><i class="ti-star"></i><i
                        class="ti-star"></i><i class="ti-star"></i><i class="ti-star"></i>
                    </div>
                  </div>
                  <div class="col-md-3 col-6">
                    <p class="mb-0 fw-600">Placement</p>
                    <div class="star-rating  green" data-rating="5"><i class="ti-star"></i><i class="ti-star"></i><i
                        class="ti-star"></i><i class="ti-star"></i><i class="ti-star"></i>
                    </div>
                  </div>
                  <div class="col-md-3 col-6">
                    <p class="mb-0 fw-600">Hostel Life</p>
                    <div class="star-rating  green" data-rating="5"><i class="ti-star"></i><i class="ti-star"></i><i
                        class="ti-star"></i><i class="ti-star"></i><i class="ti-star"></i>
                    </div>
                  </div>
                </div>

                <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                  has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                  of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
                  the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s
                  with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                  publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

              </div>
              <div class="show-more">(Show More)</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- Content -->
@endsection
