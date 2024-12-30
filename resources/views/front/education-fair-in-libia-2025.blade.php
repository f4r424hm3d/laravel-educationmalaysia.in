@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
  <section class="banner-section">
    <div class="container">
      <div class="row">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            @php
              $i = 1;
            @endphp
            @foreach ($pageDetail->banners as $row)
              <div class="carousel-item {{ $i == '1' ? 'active' : '' }}">
                <img src="{{ asset($row->file_path) }}" class="img-fluid" alt="{{ $row->alt_text }}">
              </div>
              @php
                $i++;
              @endphp
            @endforeach;
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>

  </section>

  <section class="Sureworks">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4 ">
          <div class="flex flex-col all-flexx gap-3 items-center text-center h-100">
            <img src="{{ url('/') }}/assets/web/images/png1.png" alt="">
            <h2 class="text-xl font-bold">Courses</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
              labore et dolore magna aliqua.</p>
          </div>
        </div>
        <div class="col-lg-4 mb-4 ">
          <div class="flex flex-col all-flexx gap-3 h-100 items-center text-center">
            <img src="{{ url('/') }}/assets/web/images/png2.png" alt="">
            <h2 class="text-xl font-bold">Institutions</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
              labore et dolore magna aliqua.

            </p>
          </div>
        </div>

        <div class="col-lg-4 mb-4 ">
          <div class="flex flex-col all-flexx gap-3 h-100 items-center text-center">
            <img src="{{ url('/') }}/assets/web/images/png3.png" alt="">
            <h2 class="text-xl font-bold">Scholarships</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
              labore et dolore magna aliqua.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="registrationss">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h2 class="fairs">
            International Education Fair

          </h2>
          <p class="all-fair">{{ $pageDetail->date_and_address }}</p>

          <a href="#register" class="new-registor">Register now to get your free invitation!</a>

        </div>
        <div class="col-lg-6">
          <img src="{{ asset($pageDetail->date_and_address_image) }}" class="img-fluid"
            alt="{{ $pageDetail->page_name }}">
        </div>
      </div>
    </div>
  </section>

  <section class="studaies-abroad">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="abroad-imags">
            <img src="{{ url('/') }}/assets/web/images/studies.jpg" class="studysimage" alt="">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="abroad-students">
            <h2>Want to study abroad?</h2>
            <p class="mb-3">Nam libero tempore, cum soluta nobis est eligendi</p>
            <p class="mb-3">Nam libero tempore, cum soluta nobis est eligendi</p>
            <p class="mb-3">Nam libero tempore, cum soluta nobis est eligendi</p>
            <p class="mb-3">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
              minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor
              repellendus.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="registrations-fomrs" id="register">
    <div class="container">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">

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
                        <select name="nationality" class="form-control" required>
                          <option value="">Select Nationality</option>
                          <option value="Libian" {{ old('nationality') == 'Libian' ? 'selected' : '' }}>Libian</option>
                          <option value="Non-Libian" {{ old('nationality') == 'Non-Libian' ? 'selected' : '' }}>
                            Non-Libian</option>
                        </select>
                        @error('nationality')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-6 col-sm-12">
                      <div class="form-group">
                        <select name="university" class="form-control" id="ef_university" required>
                          <option value="">Select Interested University</option>
                          @foreach ($pageDetail->universities as $row)
                            <option value="{{ $row->university_id }}"
                              {{ old('university') == $row->university_id ? 'selected' : '' }}>
                              {{ $row->university->name }}
                            </option>
                          @endforeach
                        </select>
                        @error('university')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-6 col-sm-12">
                      <div class="form-group">
                        <select name="program" class="form-control" id="ef_program">
                          <option value="">Select Interested Program (Optional)</option>
                          @if ($programs != null)
                            @foreach ($programs as $row)
                              <option value="{{ $row->course_name }}"
                                {{ old('program') == $row->course_name ? 'selected' : '' }}>
                                {{ $row->course_name }}
                              </option>
                            @endforeach
                          @endif
                        </select>
                        @error('program')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-icon">
                            <span id="password_icon_show" class="ti-eye" onclick="showPassword('password')"></span>
                            <span id="password_icon_hide" class="ti-eye hide-this"
                              onclick="hidePassword('password')"></span>
                          </div>
                          <input name="password" id="password" type="password" class="form-control bg-white b-0 b-l"
                            placeholder="Password">
                        </div>
                        <span class="text-danger">
                          @error('password')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-icon">
                            <span id="confirm_password_icon_show" class="ti-eye"
                              onclick="showPassword('confirm_password')"></span>
                            <span id="confirm_password_icon_hide" class="ti-eye hide-this"
                              onclick="hidePassword('confirm_password')"></span>
                          </div>
                          <input name="confirm_password" id="confirm_password" type="password"
                            class="form-control bg-white b-0 b-l" placeholder="Confirm Password">
                        </div>
                        <span class="text-danger">
                          @error('confirm_password')
                            {{ $message }}
                          @enderror
                        </span>
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
                        <input type="text" id="captcha" placeholder="Enter the Captcha Value"
                          class="form-control" name="captcha_answer" required>
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <p>
                        <label for="test5">By clicking on register I agree to the
                          <a href="{{ url('terms-and-conditions') }}" target="_blank">terms & conditions</a>
                        </label>
                      </p>
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
            <div class="col-md-6">
              <div class="p-5">
                <img src="{{ url('/') }}/assets/web/images/registrations.png" alt="" class="img-fluid">
              </div>
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
          <div class="tab-pane active" id="one" role="tabpanel" aria-labelledby="one-tab">

            <div class="row">
              <div class="col-12 col-sm-8"></div>
              <div class="col-12 col-sm-4"></div>
            </div>
            <div class="flex flex-col divide-y">
              <div
                class=" px-2 py-3 align-items-center gap-3 my-0 justify-content-between d-flex border-top border-bottom ">
                <span class="grow"><label>EXHIBITOR</label></span>
                <div class="d-flex justify-content-between spacebx">
                  <span class="shrink"><label>BOOTH</label></span>

                  <span class="shrink"><label>Send Application
                    </label></span>
                </div>
              </div>
            </div>
            <?php foreach ($pageDetail->universities as $row): ?>
            <div class="px-2 py-3 align-items-center gap-3 my-0 justify-content-between d-flex border-top border-bottom">
              <div class="grow">
                <a href="<?php echo url('university/' . $row->university_slug); ?>" target="_blank">
                  <span class=""><?php echo $row->university->name; ?></span>
                </a>
              </div>
              <div class="d-flex justify-content-between spacebx">
                <div class="numbers">
                  1.
                </div>
                <div class="shrink">
                  <button class="all-apply" data-id="<?php echo $row->university_id; ?>">Apply Now</button>
                </div>
              </div>
            </div>

            <?php endforeach; ?>

          </div>
        </div>

      </div>
    </div>

    </div>
  </section>

  <section class="fair-about">

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
  </section>
  <section class="applyisss">
    <div class="applyingsstart">
      <h2 class="applyings">Applying for Scholarships in Malaysia? Here’s a Quick Guide
    </div>
    </h2>
    <div class="container">
      <div class="row">
        <div class="col-12">
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
        </div>
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

            <h2 class="titles-malaysia">The Ministry of Education (MOE)
              Malaysia</h2>

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
    <div class="faq"></div>
    <div class=" faq-details">
      Frequently Ask Question
    </div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="accordion mainacc" id="accordionExample">
            @foreach ($pageDetail->faqs as $row)
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne{{ $row->id }}">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse{{ $row->id }}" aria-expanded="false"
                    aria-controls="collapse{{ $row->id }}">
                    {{ $row->question }}
                  </button>
                </h2>
                <div id="collapse{{ $row->id }}" class="accordion-collapse collapse"
                  aria-labelledby="headingOne{{ $row->id }}" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    {{ $row->answer }}
                  </div>
                </div>
              </div>
            @endforeach

          </div>
        </div>
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
