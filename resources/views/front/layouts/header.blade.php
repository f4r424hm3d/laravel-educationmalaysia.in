<!DOCTYPE html>
<html lang="en">

<head>
  <!--Meta Tag Seo-->
  @stack('seo_meta_tag')
  @stack('pagination_tag')

  <!-- CSS -->
  <!-- slick slider  -->
  <link rel="stylesheet" href= "{{ cdn('front/assets/css/slick.css') }}">
  <link rel="stylesheet" href="{{ cdn('front/assets/css/slick-theme.css') }}">
  <!-- slick slider end  -->

  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="{{ cdn('front/assets/css/owl.carousel.min.css') }}">
  <!-- font-awesome  -->
  <link href="{{ cdn('front/assets/css/font-awesome.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ cdn('front/assets/css/styles.css') }}">

  <link rel="preload" href="{{ cdn('front/assets/css/colors.css') }}" as="style"
    onload="this.onload=null;this.rel='stylesheet'">

  <script src="{{ cdn('front/assets/js/jquery.min.js') }}"></script>
  <script src="{{ cdn('front/assets/js/sweetalert2@11.js') }}"></script>

  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-WP578P4K');
  </script>
  <!-- End Google Tag Manager -->
  <style>
    .hide-this {
      display: none;
    }
  </style>

  <!-- Favicons-->
  @stack('breadcrumb_schema')
  <style>
    .hide-this {
      display: none;
    }

    .sItems ul li a,
    .sItems ul li.active {
      padding: 8px 15px;
      display: block
    }

    .sItems {
      width: 100%;
      height: 118px;
      overflow: auto;
      top: 0
    }

    .sItems ul li {
      border-bottom: 1px solid #eee
    }

    .sItems ul li.active {
      font-size: 15px;
      text-align: left;
      background: #ff57221c;
      color: #000000;
      text-transform: uppercase;
      font-weight: 600
    }

    .sItems ul li a:hover {
      background: #000000;
      color: #ffffff
    }
  </style>
</head>

<body class="red-skin">
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WP578P4K" height="0" width="0"
      style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <div id="main-wrapper">
    <!-- Top header-->

    <nav class="navbar navbar-expand-lg navbar-light main-heddd">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }} " alt="Education Malaysia Education Logo">
          <img src="{{ cdn('front/assets/img/logo.png') }}" class="logo-max" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown all-dropdowns">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Resources

              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <div class="row mx-auto ">
                  <div class=" col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-3 ">
                    <div class="b-font"><a href="{{ route('exams') }}">Exams</a></div>
                    <ul class="li_dd">
                      @foreach ($exams as $exam)
                        <li><a
                            href="{{ route('exam.detail', ['uri' => $exam->uri]) }}">{{ ucfirst($exam->page_name) }}</a>
                        </li>
                      @endforeach

                    </ul>
                  </div>
                  <div class=" col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-3 ">
                    <div class="b-font"><a href="{{ route('services') }}">Services</a></div>
                    <ul class="li_dd">
                      @foreach ($sitePages as $page)
                        <li><a
                            href="{{ route('service.detail', ['uri' => $page->uri]) }}">{{ ucfirst($page->page_name) }}</a>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                  <div class=" col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-3 ">
                    <div class="b-font">About Us</div>
                    <ul class="li_dd">
                      <li><a href="{{ route('wwa') }}">Who we are</a></li>
                      <li><a href="{{ route('wps') }}" target="_blank">What Students Say</a></li>
                      <li><a href="{{ route('select.level') }}" target="_blank">Study Malaysia</a></li>
                      <li><a href="{{ url('why-study-in-malaysia') }}">Why Study In Malaysia?</a></li>
                    </ul>
                  </div>
                  <div class=" col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-3 ">
                    <img src="{{ cdn('assets/web/images/em-menu2.jpg') }}" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item"><a href="{{ url('courses-in-malaysia') }}" class="nav-link">Courses</a></li>
            <li class="nav-item"><a href="{{ route('select.university') }}" class="nav-link">Universities</a></li>
            <li class="nav-item"><a href="{{ route('specializations') }}" class="nav-link">Specialization</a></li>
            <li class="nav-item"><a href="{{ url('scholarships') }}" class="nav-link">Scholarship</a></li>
          </ul>
          <form class="d-flex align-items-center set-gap">
            @if (session()->has('studentLoggedIn'))
              <a href="{{ url('/student/profile/') }}" class="btn btn-outline-dark my-2 my-sm-0"
                type="submit">Profile</a>
            @else
              <a class="btn btn-primary" href="{{ url('sign-up') }}">Sign Up</a>
              <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ url('sign-in') }}">Login</a>
            @endif
          </form>
        </div>
      </div>
    </nav>

    <!-- Modal -->
    <div class="modal all-malaysia fade" id="exampleModalCenter" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-center" role="document">
        <div class="modal-content">

          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="row">
              <div class="col-12 col-sm-5 col-md-5">
                <div class="all-blues">
                  <img src=" {{ cdn('/assets/images/scholorship-malysia.webp') }}" alt="">
                </div>
              </div>
              <div class="col-12 col-sm-7 col-md-7">
                <div class="all-fieldss">
                  <form class="row" id="counsellingForm">
                    <input type="hidden" name="source_path" value="{{ url()->current() }}">
                    <input type="hidden" name="return_to" value="{{ $_GET['return_to'] ?? null }}">
                    <!-- Input Fields -->
                    <div class="col-12">
                      <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="name"
                          placeholder="Full Name">
                        <span class="text-danger error-name"></span>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email"
                          placeholder="Email Address">
                        <span class="text-danger error-email"></span>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <div class="d-flex set-phones">
                          <select name="country_code" id="country_code" class="form-control">
                            <option value="">Select</option>
                            @foreach ($phonecodesSF as $item)
                              <option value="{{ $item->phonecode }}">{{ $item->phonecode }} ({{ $item->name }})
                              </option>
                            @endforeach
                          </select>
                          <span class="text-danger error-country_code"></span>
                          <input type="tel" class="form-control" id="phone" name="mobile"
                            placeholder="9876543210">
                          <span class="text-danger error-mobile"></span>
                        </div>

                      </div>
                    </div>

                    <!-- Select Fields -->
                    <div class="col-6">
                      <div class="form-group">
                        <label for="rcountry">Country of Residence</label>
                        <select class="form-control" id="rcountry" name="country">
                          <option value="">Select Country</option>
                          @foreach ($countriesSF as $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger error-country"></span>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label for="highest_qualification">Highest Qualification</label>
                        <select class="form-control" id="highest_qualification" name="highest_qualification">
                          <option value="">Select your qualification</option>
                          @foreach ($levels as $row)
                            <option value="{{ $row->level }}">{{ $row->level }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger error-highest_qualification"></span>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label for="program">Interested Program</label>
                        <select class="form-control" id="program" name="interested_program">
                          <option value="">Select a program</option>
                          @foreach ($course_categories as $row)
                            <option value="{{ $row->name }}">{{ $row->name }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger error-interested_program"></span>
                      </div>
                    </div>

                    {{-- <div class="col-6">
                      <div class="form-group">
                        <label for="intake">Preferred Intake</label>
                        <select class="form-control" id="intake">
                          <option value="">Select intake</option>
                          <option>May 2025</option>
                          <option>September 2025</option>
                          <option>January 2026</option>
                        </select>
                        <span class="text-danger error-name"></span>
                      </div>
                    </div> --}}

                    <div class="col-12">
                      <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <script>
      function openModal() {
        $('#exampleModalCenter').modal('show');
      }

      const studentLoggedIn = {{ session()->has('studentLoggedIn') ? 'true' : 'false' }};
      const excludedPaths = [
        '/sign-in',
        '/sign-up',
      ];

      $(document).ready(function() {
        const modalKey = 'enquiry_modal_status';
        const currentPath = window.location.pathname;

        // Do not show modal on excluded pages
        if (excludedPaths.includes(currentPath)) {
          return;
        }

        let modalStatus = localStorage.getItem(modalKey);

        if (!studentLoggedIn && modalStatus !== 'submitted') {
          if (modalStatus !== 'closed') {
            openModal();
          } else {
            const lastClosed = localStorage.getItem('enquiry_modal_closed_time');
            if (lastClosed) {
              const diff = Date.now() - parseInt(lastClosed);
              if (diff > 1 * 1000) {
                openModal();
              }
            }
          }
        }

        $('#exampleModalCenter').on('hidden.bs.modal', function() {
          if (localStorage.getItem(modalKey) !== 'submitted') {
            localStorage.setItem(modalKey, 'closed');
            localStorage.setItem('enquiry_modal_closed_time', Date.now().toString());
          }
        });

        $('#counsellingForm').on('submit', function(e) {
          e.preventDefault();

          let submitBtn = $('#submitBtn');
          submitBtn.prop('disabled', true).html('Submitting...');

          $('.text-danger').text('');

          $.ajax({
            url: "{{ route('modal.submit') }}",
            method: 'POST',
            data: $(this).serialize(),
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(res) {
              if (res.success) {
                localStorage.setItem(modalKey, 'submitted');
                window.location.href = "{{ url('confirmed-email') }}" + "?" + res.seg;
              }
            },
            error: function(xhr) {
              submitBtn.prop('disabled', false).html('Submit');

              if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                $.each(errors, function(key, val) {
                  $('.error-' + key).text(val[0]);
                });
              } else {
                alert('Something went wrong. Please try again.');
              }
            }
          });
        });

      });
    </script>
