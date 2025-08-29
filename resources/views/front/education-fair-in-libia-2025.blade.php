@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
  <section class="banner-section">

    <div class="container">
      <h2 class="banner-titles">MALAYSIAN UNIVERSITIES EDUCATION & TRAINING FAIR
      </h2>
      <div class="row">

        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @php
              $i = 1;
            @endphp
            @foreach ($pageDetail->banners as $row)
              <div class="carousel-item {{ $i == '1' ? 'active' : '' }}">
                <img class="d-block w-100" src="{{ asset($row->file_path) }}" alt="{{ $row->alt_text }}">
              </div>
              @php
                $i++;
              @endphp
            @endforeach;
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <h2 class="bannerma">Malaysian Universities Education held in Tripoli hosted by Ministry of Higher Education and
        Scientific Research of Libya and organized by Malaysian Export Academy (MEXA).</h2>
    </div>

  </section>

  <!-- Modal -->
  <div class="modal courses-modal  fade" id="courseListModaldfdf" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> what is offered by the participating universities.?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <footer class="dark-footer skin-dark-footer pt-3 rounded">
            <div class="container-fluid">
              <div class="row">

                @foreach ($result as $data)
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                    <div class="footer-widget">
                      <span class="widget-title">{{ $data['category_name'] }}</span>
                      <ul class="footer-menu">
                        @foreach ($data['specializations'] as $specialization_name)
                          <li> <i class="ti-arrow-right"></i> {{ $specialization_name }}</li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                @endforeach

              </div>
            </div>

          </footer>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal courses-modal  fade" id="courseListModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> what is offered by the participating universities.?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <footer class="dark-footer skin-dark-footer pt-3 rounded">
            <div class="container-fluid">
              <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                  <div class="footer-widget">
                    <span class="widget-title">Top Courses</span>
                    <ul class="footer-menu">
                      <li> <i class="ti-arrow-right"></i> Accounting & Finance</li>
                      <li> <i class="ti-arrow-right"></i> Civil Engineering</li>
                      <li> <i class="ti-arrow-right"></i> Arts/Fine Arts</li>
                      <li> <i class="ti-arrow-right"></i> Hospitality</li>
                      <li> <i class="ti-arrow-right"></i> Business Management</li>
                      <li> <i class="ti-arrow-right"></i> Computer Engineering</li>
                      <li> <i class="ti-arrow-right"></i> Physiology</li>
                      <li> <i class="ti-arrow-right"></i> Medicine</li>
                      <li> <i class="ti-arrow-right"></i> Business Information Systems</li>
                    </ul>
                  </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                  <div class="footer-widget">
                    <span class="widget-title">Qualified Level</span>
                    <ul class="footer-menu">
                      <li> <i class="ti-arrow-right"></i> CERTIFICATE</li>
                      <li> <i class="ti-arrow-right"></i> PRE UNIVERSITY</li>
                      <li> <i class="ti-arrow-right"></i> DIPLOMA</li>
                      <li> <i class="ti-arrow-right"></i> UNDER GRADUATE</li>
                      <li> <i class="ti-arrow-right"></i> POST GRADUATE</li>
                      <li> <i class="ti-arrow-right"></i> PhD COURSES</li>
                    </ul>
                  </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                  <div class="footer-widget">
                    <span class="widget-title">HELP & SUPPORT</span>
                    <ul class="footer-menu">
                      <li> <i class="ti-arrow-right"></i> FAQs</li>
                      <li> <i class="ti-arrow-right"></i> What People Say</li>
                      <li> <i class="ti-arrow-right"></i> Contact us</li>
                      <li> <i class="ti-arrow-right"></i> Terms & Conditions</li>
                      <li> <i class="ti-arrow-right"></i> Articles</li>
                      <li> <i class="ti-arrow-right"></i> Privacy Policy</li>
                    </ul>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 mt-4">
                  <div class="indin-office">
                    <span class="Head-indian">India Head Office</span>
                    <p>B-16 Ground Floor, Mayfield Garden, Sector 50, Gurugram, Haryana, India 122002</p>
                    <p>Phone: +91-98185-60331</p>
                    <p>Email: info@educationmalaysia.in</p>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 mt-4">
                  <div class="indin-office">
                    <span class="Head-indian">Malaysia Office</span>
                    <p>8, Jalan Tun Sambanthan, Wilayah Persekutuan Kuala Lumpur Malaysia 50470</p>
                    <p>Phone: +60 176472057</p>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 mt-4">
                  <div class="indin-office">
                    <span class="Head-indian">Pakistan Office</span>
                    <p>#311, Garden Heights, Garden Town Lahore Pakistan 54000</p>
                    <p>Phone: +60-11-1778-4424</p>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 mt-4">
                  <div class="indin-office">
                    <span class="b">Bangladesh Office</span>
                    <p>H-16, Road-09, Sector-01, (Flat-A5/B), Uttara, Dhaka, Bangladesh 1230</p>
                    <p>Phone: +91-98185-60331</p>
                    <ul class="linksfooters">
                      <li class="lia"> <i class="fa fa-facebook" aria-hidden="true"></i> </li>
                      <li class="lia"> <i class="fa fa-twitter" aria-hidden="true"></i> </li>
                      <li class="lia"> <i class="fa fa-linkedin" aria-hidden="true"></i> </li>
                      <li class="lia"> <i class="fa fa-pinterest" aria-hidden="true"></i> </li>
                      <li class="lia"> <i class="fa fa-instagram" aria-hidden="true"></i> </li>
                      <li class="lia"> <i class="fa fa-youtube" aria-hidden="true"></i> </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </footer>
        </div>

      </div>
    </div>
  </div>

  <section class="Sureworks">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4 ">
          <a href="#" data-toggle="modal" data-target="#courseListModal">
            <div class="flex flex-col all-flexx gap-3 items-center text-center h-100 ">
              <div class="imgflx">
                <img src="{{ cdn('/') }}/assets/images/courses.png" alt="">
              </div>
              <h2 class="text-xl font-bold">Courses</h2>
              <p>Discover a diverse range of programs from undergraduate to postgraduate degrees, explore options in
                medicine, engineering, business, IT, and more.</p>
            </div>
          </a>
          {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#courseListModal">courses</button> --}}
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4 ">
          <a href="{{ url(url()->current() . '/institutions') }}">
            <div class="flex flex-col all-flexx gap-3 h-100 items-center text-center">
              <div class="imgflx">
                <img src="{{ cdn('/') }}/assets/images/institution.png" alt="">
              </div>
              <h2 class="text-xl font-bold">Institutions</h2>
              <p>Connect with globally recognized Malaysian universities and institutions renowned for academic
                excellence.
              </p>
            </div>
          </a>
          <button type="button" class="btn btn-primary" data-toggle="modal"
            data-target=".bd-example-modal-lg">Institutions</button>

        </div>
        <!-- ------------------------------------- -->

        <!-- Large modal -->

        <div class="modal institution-modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
          aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">what is offered by the participating universities.? </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row-institutes">
                  <div class="row align-items-center">
                    <div class="col-2 col-sm-12 col-md-2 mb-4">
                      <div class="institues-img">
                        <img src="/assets/images/malaysia-uni1.jpeg" class="img-fluid" alt="">
                      </div>

                    </div>
                    <div class="col-12 col-sm-12 col-md-10 mb-4 ">
                      <div class="universitynames">
                        <h2>University of Malaya (UM)</h2>
                        <p> <span>Location:</span> Kuala Lumpur</p>
                      </div>
                    </div>

                  </div>
                  <div class="c">
                    <p class=" parargraph-more">
                      UKM is located in Bangi, a township just next to Kajang. It is easy to take Commuter train, just
                      about 20
                      minutes ride to Kuala Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too.
                      Taxi
                      will cost you about RM 5.00 per trip to UKM.
                      UKM is located in Bangi, a township just next to Kajang. It is easy to take Commuter train, just
                      about 20
                      minutes ride to Kuala Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too.
                      Taxi
                      will cost you about RM 5.00 per trip to UKM.
                      UKM is located in Bangi, a township just next to Kajang. It is easy to take Commuter train, just
                      about 20
                      minutes ride to Kuala Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too.
                      Taxi
                      will cost you about RM 5.00 per trip to UKM.

                      UKM is located in Bangi, a township just next to Kajang. It is easy to take Commuter train, just
                      about 20
                      minutes ride to Kuala Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too.
                      Taxi
                      will cost you about RM 5.00 per trip to UKM.
                      UKM is located in Bangi, a township just next to Kajang. It is easy to take Commuter train, just
                      about 20
                      minutes ride to Kuala Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too.
                      Taxi
                      will cost you about RM 5.00 per trip to UKM.

                      UKM is located in Bangi, a township just next to Kajang. It is easy to take Commuter train, just
                      about 20
                      minutes ride to Kuala Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too.
                      Taxi
                      will cost you about RM 5.00 per trip to UKM.UKM is located in Bangi, a township just next to Kajang.
                      It is
                      easy to take Commuter train, just about 20 minutes ride to Kuala Lumpur, the capital of Malaysia.
                      Taxis are
                      plentiful and easy accessible too. Taxi will cost you about RM 5.00 per trip to UKM.UKM is located
                      in Bangi,
                      a township just next to Kajang. It is easy to take Commuter train, just about 20 minutes ride to
                      Kuala
                      Lumpur, the capital of Malaysia. Taxis are plentiful and easy accessible too. Taxi will cost you
                      about RM
                      5.00 per trip to UKM.
                    </p>
                    <a class="showbx" href="#">Show More <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </a>
                    <a class="showbx" href="#">Show Less <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                  </div>
                  <button class="featuresoption"> <span></span> Featured </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- -------------------------------  -->
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 ">
          <div class="flex flex-col all-flexx gap-3 h-100 items-center text-center">
            <div class="imgflx">
              <img src="{{ cdn('/') }}/assets/images/scholarship.png" alt="">
            </div>
            <h2 class="text-xl font-bold">Scholarships</h2>
            <p>Exclusive scholarship opportunities for Libyan students sponsored by the Libyan Government.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="registrations-fomrs" id="register">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-4">
          <div class="fair-details">
            <h2 class="main-faris">
              Education Fair 2025 </h2>
            <!-- <p class="all-fair mb-2">{{ $pageDetail->date_and_address }}</p> -->
            <p class="all-fair mb-2">Libyan Academy for Postgraduate Studies, Tripoli Libya. 22nd & 23rd February 2025,
              9.30am to 1.00pm & 4.00pm to 8.00pm</p>
            <h2 class="fairs">
              Malaysian Universities Education & Training Fair </h2>
            <ul class="set_uls">
              <li><b><i class="fa fa-map-pin" aria-hidden="true"></i>
                  Venue / Place</b> <span>:</span> Libyan Academy for Postgraduate Studies, Tripoli, Libya</li>
              <li><b><i class="fa fa-calendar" aria-hidden="true"></i>Date:</b> <span>:</span> 22nd & 23rd February 2025
              </li>
              <li><b><i class="fa fa-clock-o" aria-hidden="true"></i>
                  Time:</b> <span>:</span> 9:30 AM – 1:00 PM & 4:00 PM – 8:00 PM</li>
            </ul>
            <!-- <ul class="set_uls" >
                                            <li><b>Hosted by:</b>  Ministry of Higher Education and Scientific Research, Libya
                                            </li>
                                            <li><b>Organised by:</b> Malaysian Export Academy (MEXA), Malaysia
                                            </li>
                                            <li><b>Supported by:</b> NAPEI, Malaysia</li>
                                          </ul> -->
            <div class="imgsfaird">
              <img src="/assets/images/libya-malaysia.png" class="imgsfairs" alt="">
            </div>
            <!-- <a href="#register" class="new-registor">Register Now</a> -->
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-4 ">

          <div class="all-forms main-modals">
            <h2 class="new-regist">Register Now</h2>
            <form class="s12 f" action="{{ route('libia.register') }}" method="post">
              @csrf
              <input class="mt-0" type="hidden" name="source" value="Education Malaysia - Libia Landing Page">
              <input class="mt-0" type="hidden" name="source_path" value="{{ url()->current() }}">
              <input class="mt-0" type="hidden" name="return_path" value="{{ url()->current() }}">

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <input name="name" class="form-control" type="text" placeholder="Enter Full Name"
                      pattern="[a-zA-Z'-'\s]*" value="{{ old('name', '') }}" required>
                    @error('name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <input name="email" class="form-control" type="email" placeholder="Enter Email Address"
                      value="{{ old('email', '') }}" required>
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                  <div class="form-group">
                    <select name="country_code" id="countryCode" class="form-control" required>
                      <option value="">Country Code</option>
                      @foreach ($phonecodes as $row)
                        <option value="{{ $row->phonecode }}"
                          {{ $row->iso == $curCountry || old('country_code') == $row->phonecode ? 'selected' : '' }}>
                          +{{ $row->phonecode }}
                        </option>
                      @endforeach
                    </select>
                    @error('country_code')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12">
                  <div class="form-group">
                    <input name="mobile" class="form-control mt-0" required type="text" pattern="[0-9]+"
                      placeholder="Phone number" value="{{ old('mobile', '') }}">
                    @error('mobile')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-lg-12 col-md-6 col-sm-12">
                  <div class="form-group">
                    <select name="nationality" class="form-control" required>
                      <option value="">Select Nationality</option>
                      <option value="Libyan" {{ old('nationality') == 'Libyan' ? 'selected' : '' }}>Libyan</option>
                      <option value="Non-Libyan" {{ old('nationality') == 'Non-Libyan' ? 'selected' : '' }}>
                        Non-Libyan</option>
                    </select>
                    @error('nationality')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-lg-12 col-md-6 col-sm-12">
                  <div class="form-group">
                    <select name="highest_qualification" class="form-control" required>
                      <option value="">Select Highest Qualification</option>
                      @foreach ($levels as $row)
                        <option value="{{ $row->level }}"
                          {{ old('highest_qualification') == $row->level ? 'selected' : '' }}>
                          {{ $row->level }}
                        </option>
                      @endforeach
                    </select>
                    @error('highest_qualification')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-lg-12 col-md-6 col-sm-12">
                  <div class="form-group">
                    <select name="program" class="form-control" id="ef_program">
                      <option value="">Select Interested Course (Optional)</option>
                      @foreach ($categories as $row)
                        <option value="{{ $row->name }}" {{ old('program') == $row->name ? 'selected' : '' }}>
                          {{ $row->name }}
                        </option>
                      @endforeach
                    </select>
                    @error('program')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="form-group">
                    <input type="text" placeholder="Captcha: {{ $captcha['text'] }} =" class="form-control"
                      value="Captcha: {{ $captcha['text'] }} =" disabled readonly>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12  col-sm-12">
                  <div class="form-group">
                    <input type="text" id="captcha" placeholder="Enter the Captcha Value" class="form-control"
                      name="captcha_answer" required>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">

                  <div class="form-check checkbx-white pl-4">
                    <input type="checkbox" class="form-check-input" id="test5">
                    <label class="form-check-label px-0 " for="test5">By clicking on register I agree to the
                      <a href="{{ url('terms-and-conditions') }}" target="_blank">terms & conditions</a></label>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="input-field s4 d-flex justify-content-center align-items-center">
                    <button type="submit" class="blue-register mar5 w-50">Register</button>
                  </div>
                </div>
              </div>
            </form>

          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="educationfairs">
    <div class="container">
      <h2 class="set-fairs mb-4">Why Join This Education Fair?</h2>
      <div class="row align-items-center  justify-content-center  ">

        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-4 ">

          <div class="fariul">
            <div class="flspan">
              <span> <img src="/assets/images/top-universities.png " class="img-fluid" alt=""></span>

            </div>
            <div class="fair-us">
              <h2>Meet Top Universities</h2>
              <p>Connect with Malaysia’s leading institutions in one place.</p>
            </div>

          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-4 ">
          <div class="fariul">
            <div class="flspan">
              <span> <img src="/assets/images/Exclusive-Scholarship.png " class="img-fluid" alt=""></span>

            </div>
            <div class="fair-us">
              <h2>Exclusive Scholarships</h2>
              <p>Learn about scholarships for Libyan students.</p>
            </div>

          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-4 ">
          <div class="fariul">
            <div class="flspan">
              <span> <img src="/assets/images/Spot-Admissions.png " class="img-fluid" alt=""></span>

            </div>
            <div class="fair-us">
              <h2>Spot Admissions</h2>
              <p>Apply on the spot for eligible programs.</p>
            </div>

          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-4 ">
          <div class="fariul">
            <div class="flspan">
              <span> <img src="/assets/images/Visa-travel.png " class="img-fluid" alt=""></span>

            </div>
            <div class="fair-us">
              <h2>Visa & Travel Support</h2>
              <p>Get step-by-step guidance on studying in Malaysia.</p>
            </div>

          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-4 ">
          <div class="fariul">
            <div class="flspan">
              <span> <img src="/assets/images/Work-Internships.png " class="img-fluid" alt=""></span>
            </div>
            <div class="fair-us">
              <h2>Work & Internships</h2>
              <p>Explore part-time work and internship options.</p>
            </div>

          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-4 ">
          <div class="fariul">
            <div class="flspan">
              <span> <img src="/assets/images/Cultural-Insights.png " class="img-fluid" alt=""></span>

            </div>
            <div class="fair-us">
              <h2>Cultural Insights</h2>
              <p>Learn about life and student support in Malaysia.</p>
            </div>

          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-4 ">
          <div class="fariul">
            <div class="flspan">
              <span> <img src="/assets/images/save-time.png " class="img-fluid" alt=""></span>

            </div>
            <div class="fair-us">
              <h2>Save Time and Effort</h2>
              <p>Access all the information you need about studying in Malaysia.</p>
            </div>

          </div>
        </div>

      </div>

    </div>
  </section>

  <section class="particaptes-universties">
    <div class="container">
      <div class="particaptes">
        <h3 class="universties   px-2 py-3 align-items-center gap-3 my-0 justify-content-between d-flex ">
          Participates University</h3>

        <div class="tab-content" id="one-tabContent">
          <div class="tab-pane last-div active mx-2" id="one" role="tabpanel" aria-labelledby="one-tab">

            <div class="flex flex-col divide-y">
              <div
                class=" px-2 py-2 align-items-center  setparticaptes gap-3 my-0 justify-content-between d-flex border-top border-bottom ">
                <span class="grow"><label>EXHIBITOR</label></span>
                <div class="d-flex justify-content-between spacebx">
                  <span class="shrink"><label>BOOTH</label></span>

                  <span class="shrink"><label>Send Application
                    </label></span>
                </div>
              </div>
            </div>
            @foreach ($pageDetail->universities as $row)
              <div
                class="px-2 py-2 align-items-center setparticaptes gap-3 my-0 justify-content-between d-flex border-top border-bottom">
                <div class="grow">
                  <a href="{{ url('university/' . $row->university_slug) }}" target="_blank">
                    <span class="">{{ $row->university->name }}</span>
                  </a>
                </div>
                <div class="d-flex justify-content-between spacebx">
                  <div class="numbers">
                    {{ $row->booth_no }}
                  </div>
                  <div class="shrink">
                    <button class="all-apply" data-id="{{ $row->university_id }}">Apply Now</button>
                  </div>
                </div>
              </div>
            @endforeach

          </div>
        </div>

      </div>
    </div>

    </div>
  </section>

  <section class="education-fairs">
    <div class="container">
      <div class="row align-items-center ">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4 ">
          <div class="all-fairss">
            <h2> <span>Why Attend </span> the Malaysian Universities Education Fair Tripoli, Libya?</h2>
            <p>The Education Fair is a pioneering event designed to connect Libyan students with representatives from
              prestigious universities from Malaysia.
              Sponsored by the Libyan Government, this Education Fair provides students with invaluable opportunities to
              explore international academic pathways, secure scholarships, and take significant steps toward fulfilling
              their educational aspirations.
            </p>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4 ">
          <div class="all-fairss-img text-center ">
            <img src="/assets/images/group-photos.png " class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="education-special">
    <div class="container">

      <div class="all-special">
        <h2>What Makes Libya Education
          Fair Special?</h2>

      </div>
      <div class="row">

        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="cards-spec">

            <div class="special-black event-overlay">

              <h2>Government Sponsored Scholarships</h2>
              <div class="specil-p">
                <p>The Libya Education Fair offers 100% government-funded scholarships for eligible students, covering
                  tuition fees, living expenses, and more. Merit-based scholarships are available to empower deserving
                  students.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="cards-spec">
            <div class="special-black event-overlay">

              <h2>Meet University Representatives</h2>
              <div class="specil-p">
                <p>Engage directly with university delegates to learn about programs, application processes, and campus
                  life. Get your questions about courses, scholarships, visas, and more answered by experts.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="cards-spec">

            <div class="special-black event-overlay">

              <h2>On-The-Spot Offers and Admissions</h2>
              <div class="specil-p">
                <p>Bring your academic documents to secure on-the-spot offers and admission assessments from top
                  universities.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="cards-spec">
            <div class="special-black event-overlay">

              <h2>
                Scholarships and Application Fee Waivers</h2>
              <div class="specil-p">
                <p>Many universities will provide application fee waivers and exclusive scholarships to eligible
                  candidates submitting complete applications during the event.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="cards-spec">
            <div class="special-black event-overlay">

              <h2>
                Interactive Sessions</h2>
              <div class="specil-p">
                <p>Participate in interactive sessions with university delegates, alumni, and counselors to gain insights
                  into academic programs, career prospects, and student life.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="cards-spec">
            <div class="special-black event-overlay">

              <h2>
                Comprehensive Guidance</h2>
              <div class="specil-p">
                <p>The event provides personalized assistance with study abroad processes, including information on visa
                  procedures, education loans, and student accommodation.</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="applyisss">
    <div class="applyingsstart">
      <h2 class="applyings">Applying for Scholarships in Malaysia? Here’s a Quick Guide
    </div>
    </h2>
    <div class="container">
      <div class="row">
        <div class="col-12">

          <ol class="olrearsarch">
            <li>
              <h2>Research available scholarships</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>
              <h2>Check eligibility criteria</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>

              <h2>Gather required documents</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>
              <h2>Apply online or offline</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>
              <h2>Submit the application</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>
              <h2>Wait for results</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>
              <h2>Fulfil scholarship requirements</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>
            <li>
              <h2>Submit the application</h2>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                cupiditate non provident</p>
            </li>

          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="malaysia-govt">
    <div class="contanier">
      <div class="row">
        <div class="col-md-12">
          <div class="minsiter">

            <h2 class="titles-malaysia">Over a steamed Partner or sponser </h2>

            <div class="allsponser">
              <div class="slider">
                <div class="slide-track">
                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/govermentlibya.png" alt="">
                  </div>
                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/Libia-education-board-Logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/govt-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/britannica-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/Flag-of-Libya.png" alt="">
                  </div>
                  <!-- 1  -->

                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/govermentlibya.png" alt="">
                  </div>
                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/Libia-education-board-Logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/govt-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/britannica-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/Flag-of-Libya.png" alt="">
                  </div>
                  <!-- 2  -->

                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/govermentlibya.png" alt="">
                  </div>
                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/Libia-education-board-Logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/govt-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/britannica-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ cdn('/') }}/assets/web/images/Flag-of-Libya.png" alt="">
                  </div>

                </div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </div>
  </section>

  <section class="faq-sections">

    <div class="container">
      <div class=" faq-details">
        Frequently Ask <span>Question</span>
      </div>
      <div class="row align-items-center">
        <div class="col-md-12">

          <div id="accordion" class="mainacc">
            <div class="card-diff">
              <div class="row">
                @foreach ($pageDetail->faqs as $row)
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4">
                    <div class=" card mb-0">
                      <div class="card-header" id="heading{{ $row->id }}">
                        <h5 class="mb-0">
                          <button class="btn btn-link" data-toggle="collapse"
                            data-target="#collapse{{ $row->id }}" aria-expanded="true"
                            aria-controls="collapse{{ $row->id }}">
                            <div class="clickfa d-flex justify-content-between gapss align-items-center">
                              <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              <h2 class="span-accord">{{ $row->question }}</h2>

                            </div>
                          </button>
                        </h5>
                      </div>
                      <div id="collapse{{ $row->id }}" class="collapse "
                        aria-labelledby="heading{{ $row->id }}" data-parent="#accordion">
                        <div class="card-body">
                          <p class="card-anwer"> {!! $row->answer !!}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>

            </div>

          </div>

        </div>
        <!-- <div class="col-md-6">
                                                      <div class="imgfaq">
                                                        <img src="{{ cdn('/') }}/assets/web/images/faq.png" class="img-fluid" alt="">

                                                      </div>
                                                    </div> -->
      </div>
    </div>
  </section>
  <script>
    $(document).ready(function() {
      // Wrap the table in a div with class 'table-responsive'
      $('table').before('<div class="table-responsive"></div>');

      // Move the table inside the newly created div
      $('table').prev('.table-responsive').append($('table'));
    });
  </script>
  <script>
    function showPassword(id) {
      $("#" + id).attr('type', 'text');
      $("#" + id + '_icon_show').hide();
      $("#" + id + '_icon_hide').show();
    }

    function hidePassword(id) {
      $("#" + id).attr('type', 'password');
      $("#" + id + '_icon_show').show();
      $("#" + id + '_icon_hide').hide();
    }
  </script>
  <script>
    $(document).ready(function() {
      // Check if a university is already selected on page load
      // const selectedUniversityId = $('#ef_university').val();
      // if (selectedUniversityId) {
      // 	fetchPrograms(selectedUniversityId); // Call the function to fetch programs
      // }

      // Fetch programs when university dropdown changes
      $('#ef_university').change(function() {
        const universityId = $(this).val();
        if (universityId) {
          fetchPrograms(universityId); // Call the function to fetch programs
        }
      });

      // Function to fetch programs
      function fetchPrograms(universityId) {
        $.ajax({
          url: "{{ route('libia.fetch.program') }}",
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
          },
          data: {
            university_id: universityId
          },
          success: function(response) {
            $('#ef_program').html(response);
          },
          error: function() {
            alert('An error occurred while fetching programs.');
          },
        });
      }
    });

    $(document).ready(function() {
      // Handle the click event on the "Apply Now" button
      $('.all-apply').on('click', function() {
        // Get the university ID from the data-id attribute of the clicked button
        const universityId = $(this).data('id');

        // Scroll smoothly to the register section
        $('html, body').animate({
          scrollTop: $('#register').offset().top
        }, 500);

        // Set the value of the university dropdown to the selected university ID
        $('#ef_university').val(universityId);

        // Trigger change event to ensure any dependent functionality updates
        $('#ef_university').trigger('change');
      });
    });
  </script>
@endsection
