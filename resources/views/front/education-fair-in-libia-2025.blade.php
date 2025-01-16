@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
  <section class="banner-section">
    <div class="container">
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
    </div>

  </section>

  <section class="Sureworks">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4 ">
          <a href="{{ url('specialization') }}">
            <div class="flex flex-col all-flexx gap-3 items-center text-center h-100">
              <img src="{{ url('/') }}/assets/web/images/png1.png" alt="">
              <h2 class="text-xl font-bold">Courses</h2>
              <p>Discover a diverse range of programs from undergraduate to postgraduate degrees, explore options in
                medicine, engineering, business, IT, and more.</p>
            </div>
          </a>
        </div>
        <div class="col-lg-4 mb-4 ">
          <a href="{{ url(url()->current() . '/institutions') }}">
            <div class="flex flex-col all-flexx gap-3 h-100 items-center text-center">
              <img src="{{ url('/') }}/assets/web/images/png2.png" alt="">
              <h2 class="text-xl font-bold">Institutions</h2>
              <p>Connect with globally recognized Malaysian universities and institutions renowned for academic
                excellence.
              </p>
            </div>
          </a>
        </div>

        <div class="col-lg-4 mb-4 ">
          <div class="flex flex-col all-flexx gap-3 h-100 items-center text-center">
            <img src="{{ url('/') }}/assets/web/images/png3.png" alt="">
            <h2 class="text-xl font-bold">Scholarships</h2>
            <p>Exclusive scholarship opportunities for Libyan students sponsored by the Libyan Government.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- <section class="registrationss">
                                    <div class="container">
                                      <div class="row align-items-center">
                                        <div class="col-lg-9 mx-auto">

                                          <div class="fair-details">
                                            <h2 class="fairs">
                                              <span class="internationl-fa">International</span> <br> Education Fair <br>
                                              <span class="year-fair">2025</span>

                                            </h2>
                                            <p class="all-fair">{{ $pageDetail->date_and_address }}</p>

                                            <a href="#register" class="new-registor">Register Now</a>
                                          </div>

                                        </div>
                                      </div>
                                    </div>
                                  </section> -->

  <!-- <section class="studaies-abroad">
                                    <div class="container">
                                      <div class="row align-items-center">
                                        <div class="col-lg-6">
                                          <div class="abroad-students">
                                            <h2>Want to <br> study abroad?</h2>
                                            <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus pariatur autem
                                              officiis, veritatis vero consequatur natus sapiente voluptates, distinctio magni quae, hic eum quam
                                              obcaecati sunt tempora libero dolorem molestias enim! Mollitia!</p>
                                            <ul class="study-abroads">

                                              <li>No test required</li>
                                              <li>New job opportunites</li>
                                              <li>100% schollarship available</li>

                                            </ul>

                                          </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="abroad-imags">
                                            <img src="{{ url('/') }}/assets/images/study-abroad.png" class="studysimage" alt="">

                                          </div>
                                        </div>

                                      </div>
                                    </div>
                                  </section> -->

  <section class="registrations-fomrs" id="register">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="fair-details">
            <h2 class="fairs">
              <span class="internationl-fa">Education Fair 2025</span>

            </h2>
            <p class="all-fair">{{ $pageDetail->date_and_address }}</p>
            <div class="imgsfaird">
              <img src="/assets/images/libya-malaysia.png" class="imgsfairs" alt="">
            </div>
            <!-- <a href="#register" class="new-registor">Register Now</a> -->
          </div>
        </div>
        <div class="col-md-6 ">

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
                    <select name="c_code" id="countryCode" class="form-control" required>
                      <option value="">Country Code</option>
                      @foreach ($phonecodes as $row)
                        <option value="{{ $row->phonecode }}"
                          {{ $row->iso == $curCountry || old('c_code') == $row->phonecode ? 'selected' : '' }}>
                          +{{ $row->phonecode }}
                        </option>
                      @endforeach
                    </select>
                    @error('c_code')
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

                <div class="col-lg-6 col-md-4 col-sm-12">
                  <div class="form-group">
                    <input type="text" placeholder="Captcha: {{ $captcha['text'] }} =" class="form-control"
                      value="Captcha: {{ $captcha['text'] }} =" disabled readonly>
                  </div>
                </div>
                <div class="col-lg-6 col-md-8 col-sm-12">
                  <div class="form-group">
                    <input type="text" id="captcha" placeholder="Enter the Captcha Value" class="form-control"
                      name="captcha_answer" required>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                  <!-- <p>
                                                                                          <label for="test5">By clicking on register I agree to the
                                                                                            <a href="{{ url('terms-and-conditions') }}" target="_blank">terms & conditions</a>
                                                                                          </label>
                                                                                        </p> -->
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

      <div class="row align-items-center ">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
          <div class="row">
            <div class="col-12 mb-4">
              <div class="img-fari">
                <img src="/assets/images/why-join.png" class="img-fluid" alt="">

              </div>
            </div>
            <div class="col-12 mb-4">
              <h2 class="set-fairs">Why Join This Education Fair?</h2>

            </div>
            <div class="col-12 ">
              <div class="img-fari">
                <img src="/assets/images/whyjoins.png" class="imgfai" alt="">

              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 ">

          <div class="fariul">
            <span>1</span>
            <div class="fair-us">
              <h2>Meet Top Universities</h2>
              <p>Connect with Malaysia’s leading institutions in one place.</p>
            </div>

          </div>
          <div class="fariul">
            <span>2</span>
            <div class="fair-us">
              <h2>Exclusive Scholarships</h2>
              <p>Learn about scholarships for Libyan students.</p>
            </div>

          </div>
          <div class="fariul">
            <span>3</span>
            <div class="fair-us">
              <h2>Spot Admissions</h2>
              <p>Apply on the spot for eligible programs.</p>
            </div>

          </div>
          <div class="fariul">
            <span>4</span>
            <div class="fair-us">
              <h2>Visa & Travel Support</h2>
              <p>Get step-by-step guidance on studying in Malaysia.</p>
            </div>

          </div>
          <div class="fariul">
            <span>5</span>
            <div class="fair-us">
              <h2>Work & Internships</h2>
              <p>Explore part-time work and internship options.</p>
            </div>

          </div>
          <div class="fariul">
            <span>6</span>
            <div class="fair-us">
              <h2>Work & Internships</h2>
              <p>Learn about life and student support in Malaysia.</p>
            </div>

          </div>
          <div class="fariul">
            <span>7</span>
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
                class=" px-2 py-2 align-items-center gap-3 my-0 justify-content-between d-flex border-top border-bottom ">
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
                class="px-2 py-2 align-items-center gap-3 my-0 justify-content-between d-flex border-top border-bottom">
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

  <!-- <section class="fair-about">

                                    <div class="container">
                                      <h2>Join the fair to learn about:</h2>
                                      <div class="row align-items-center ">
                                        <div class="col-lg-7">
                                          <ul class="ol-joins">
                                            <li class="li-joins">
                                              <span>1</span>
                                              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni non esse veritatis.</p>
                                            </li>
                                            <li class="li-joins">
                                              <span>2</span>
                                              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni non esse veritatis.</p>
                                            </li>
                                            <li class="li-joins">
                                              <span>3</span>
                                              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni non esse veritatis.</p>
                                            </li>
                                            <li class="li-joins">
                                              <span>4</span>
                                              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni non esse veritatis.</p>
                                            </li>
                                            <li class="li-joins">
                                              <span>5</span>
                                              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni non esse veritatis.</p>
                                            </li>
                                            <li class="li-joins">
                                              <span>6</span>
                                              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni non esse veritatis.</p>
                                            </li>

                                          </ul>
                                        </div>
                                        <div class="col-lg-5">
                                          <img src="{{ url('/') }}/assets/web/images/joins.jpg" class="img-fluid" alt="">
                                        </div>
                                      </div>
                                    </div>
                                  </section> -->

  <section class="education-fairs">
    <div class="container">
      <div class="row align-items-center ">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
          <div class="all-fairss">
            <h2> <span>Why Attend</span> <br>
              the Libya Education Fair?</h2>
            <p>The Libya Education Fair, a groundbreaking initiative, offers Libyan students a unique
              opportunity to connect with representatives from over 30 top-ranked universities worldwide, with a focus on
              Malaysian universities. Sponsored by the Libyan Government, this event is designed to assist students in
              exploring academic opportunities
              abroad, applying for scholarships, and achieving their educational dreams.</p>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
          <div class="all-fairss-img">
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
      <div class="row align-items-center ">

        <div class="col-12 col-sm-12 col-md-4 mb-4">
          <div class="cards-special">
            <img src="/assets/images/govt-user.png" class="img-speacil" alt="">
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
        <div class="col-12 col-sm-12 col-md-4 mb-4">
          <div class="cards-special">
            <img src="/assets/images/meet-uni.png" class="img-speacil" alt="">
            <div class="special-black event-overlay">

              <h2>Meet University Representatives</h2>
              <div class="specil-p">
                <p>Engage directly with university delegates to learn about programs, application processes, and campus
                  life. Get your questions about courses, scholarships, visas, and more answered by experts.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 mb-4">
          <div class="cards-special">
            <img src="/assets/images/instant.png" class="img-speacil" alt="">
            <div class="special-black event-overlay">

              <h2>On-The-Spot Offers and Admissions</h2>
              <div class="specil-p">
                <p>Bring your academic documents to secure on-the-spot offers and admission assessments from top
                  universities.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 mb-4">
          <div class="cards-special">
            <img src="/assets/images/Scholarshi 1.png" class="img-speacil" alt="">
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
        <div class="col-12 col-sm-12 col-md-4 mb-4">
          <div class="cards-special">
            <img src="/assets/images/intratative 1.png" class="img-speacil" alt="">
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
        <div class="col-12 col-sm-12 col-md-4 mb-4">
          <div class="cards-special">
            <img src="/assets/images/Comprehensive 1.png" class="img-speacil" alt="">
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
        <!-- <div class="col-12">
                                          <div class="position-relative">
                                            <img src="{{ url('/') }}/assets/web/images/apply.png" class="passings" alt="">
                                            <div class="divmalaysiass">
                                              <h2 class="malaysiass">How to apply for scholarships in Malaysia?
                                              </h2>
                                              <p class="applyis">
                                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                                laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto
                                                beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut
                                                odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                                              </p>
                                            </div>
                                          </div>
                                        </div> -->
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
                    <img src="{{ url('/') }}/assets/web/images/govermentlibya.png" alt="">
                  </div>
                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/Libia-education-board-Logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/govt-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/britannica-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/Flag-of-Libya.png" alt="">
                  </div>
                  <!-- 1  -->

                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/govermentlibya.png" alt="">
                  </div>
                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/Libia-education-board-Logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/govt-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/britannica-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/Flag-of-Libya.png" alt="">
                  </div>
                  <!-- 2  -->

                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/govermentlibya.png" alt="">
                  </div>
                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/Libia-education-board-Logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/govt-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/britannica-logo.png" alt="">
                  </div>

                  <div class="slide">
                    <img src="{{ url('/') }}/assets/web/images/Flag-of-Libya.png" alt="">
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
    <div class=" faq-details">
      Frequently Ask Question
    </div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12">

          <div id="accordion" class="mainacc">
            <div class="card-diff">
              @foreach ($pageDetail->faqs as $row)
                <div class=" card">
                  <div class="card-header" id="heading{{ $row->id }}">
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $row->id }}"
                        aria-expanded="true" aria-controls="collapse{{ $row->id }}">
                        <div class="d-flex justify-content-between gapss align-items-center">

                          <h2 class="span-accord">{{ $row->question }}</h2> <i class="fa fa-arrow-down downs"
                            aria-hidden="true"></i>

                        </div>
                      </button>
                    </h5>
                  </div>
                  <div id="collapse{{ $row->id }}" class="collapse show"
                    aria-labelledby="heading{{ $row->id }}" data-parent="#accordion">
                    <div class="card-body">
                      {!! $row->answer !!}
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

          </div>

        </div>
        <!-- <div class="col-md-6">
                                          <div class="imgfaq">
                                            <img src="{{ url('/') }}/assets/web/images/faq.png" class="img-fluid" alt="">

                                          </div>
                                        </div> -->
      </div>
    </div>
  </section>
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
