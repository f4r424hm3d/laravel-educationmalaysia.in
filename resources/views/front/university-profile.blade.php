<div class="hero-banner-top">
  <img src="{{ asset($university->banner_path) }}" class="img-responsive hidden-xs initial loading"
    alt="University of Malaya (UM)">
</div>

<div class="image-cover ed_detail_head lg ">
  <div class="container">
    <div class="ed_detail_wrap light">
      <ul class="cources_facts_list">
        <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
        <li class="facts-1"><a href="{{ route('select.university') }}">University</a>
        </li>
        <li class="facts-1"><a
            href="{{ route('university.overview', ['university_slug' => $university->uname]) }}">{{ $university->name }}</a>
        </li>
        @if (Request::segment(3) != '')
          <li class="facts-1">{{ Request::segment(3) }}</li>
        @endif
        @if (Request::segment(4) != '')
          <li class="facts-1">{{ Request::segment(4) }}</li>
        @endif
      </ul>
    </div>

  </div>

  <script>
    function setSource(value) {
      //alert(value);
      $('#requestfor').val(value);
    }

    function printErrorMsg(msg) {
      $.each(msg, function(key, value) {
        $("#" + key + "-err").text(value);
      });
    }

    $(document).ready(function() {
      $('#dataForm').on('submit', function(event) {
        event.preventDefault();
        $(".errSpan").text(''); // Clear previous error messages
        $.ajax({
          url: "{{ route('brochure.inquiry') }}",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            if ($.isEmptyObject(data.error)) {
              if (data.hasOwnProperty('success')) {
                Swal.fire({
                  title: 'Success',
                  text: data.message,
                  icon: 'success',
                  confirmButtonText: 'OK'
                }).then(() => {
                  $('#dataForm')[0].reset(); // Reset the form
                  $('#exampleModalCenter').hide(); // Close the modal
                });
              }
            } else {
              printErrorMsg(data.error); // Display validation errors
            }
          },
          error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error); // Log errors for debugging
          }
        });
      });
    });
  </script>
</div>
<section class="university-blade">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-xl-2 col-lg-3 col-md-3 col-12 mb-4">
        <div class="imguniersity">
          <img data-src="{{ asset($university->imgpath) }}" class="" alt="{{ $university->name }}">

        </div>
      </div>

      <div class="col-xl-10 col-lg-9 col-md-9 col-12 mb-4">
        <div class="ed_detail_wrap light">

          <div class="ed_header_caption">
            <h1 class="ed_title">
              {{ $university->name }} Rankings, Courses, Fees, Admission {{ date('Y') }} & Scholarships
            </h1>
            <ul>
              <li><i class="ti-location-pin"></i><span>Location:</span> {{ $university->city }},
                {{ $university->state }}</li>
              <li>
                <div class="dv-loc d-flex align-items-center ">
                  <span class="loc mobile">
                    <i class="fa fa-star-half-o me-1 " aria-hidden="true"></i>
                    Rating:
                  </span>

                  <div class="empty-ratings" title="<?php echo htmlspecialchars($university->rating); ?>"><span>★★★★★</span></div>

                </div>

              </li>
              <li>
                <div class="dv-loc d-flex align-items-center ">
                  <span class="loc mobile">
                    <i class="fa fa-graduation-cap me-1" aria-hidden="true"></i>

                    Schooling:
                  </span>

                  <div class="empty-ratings"><span>Yes</span></div>

                </div>

              </li>
              <li>
                <div class="dv-loc d-flex align-items-center ">
                  <span class="loc mobile">
                    <i class="fa fa-eye me-1" aria-hidden="true"></i>View:
                  </span>

                  <div class="empty-ratings"><span>{{ $university->views }}</span></div>

                </div>

              </li>
              <li><i class="fa fa-graduation-cap"></i><span>Type:</span>
                {{ $university->instituteType->type ?? 'N/A' }}
              </li>
              <li><i class="ti-user"></i><span>Courses:</span> {{ $university->programs->count() }}</li>
              <li><i class="fa fa-building"></i><span>QS World University Rankings:</span>
                {{ $university->qs_rank }}
              </li>
              <li><i class="fa fa-globe"></i><span>Times Higher Education World University
                  Rankings:</span>
                {{ $university->times_rank }}</li>
            </ul>
          </div>

          <div class="head-btns">
            <a onclick="setSource('brochure')" href="#" class="btn btn-white-t-theme btn-50L" data-toggle="modal"
              data-target="#exampleModalCenter"><i class="ti-download mr-1"></i>
              Download
              Brochure</a>
            <a onclick="setSource('fees')" href="#" class="btn btn-white-t-theme btn-50R" data-toggle="modal"
              data-target="#exampleModalCenter"><i class="ti-user mr-1"></i> Download
              Fees
              Structure</a>
            <a href="{{ route('write.review') }}" class="btn btn-white-t-theme"><i class="ti-pencil-alt mr-1"></i>
              Write a review</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal registration-modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body p-0">
        <div class="all-registration">
          <div class="row flex-column-reverse flex-md-row align-items-center">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 pr-md-0">
              <div class="all-grays">
                <h2>How New-Education-Malysia helps you in </h2>
                <div class="d-flex set-gaps gap-3 flex-wrap align-items-center">
                  <div class="border-alls">
                    <img src="/assets/images/open-book.png" alt="">
                    <h4>Brochure Details</h4>
                  </div>
                  <div class="border-alls">
                    <img src="/assets/images/open-book.png" alt="">
                    <h4>Brochure Details</h4>
                  </div>
                  <div class="border-alls">
                    <img src="/assets/images/open-book.png" alt="">
                    <h4>Brochure Details</h4>
                  </div>
                  <div class="border-alls">
                    <img src="/assets/images/open-book.png" alt="">
                    <h4>Brochure Details</h4>
                  </div>
                  <div class="border-alls">
                    <img src="/assets/images/open-book.png" alt="">
                    <h4>Brochure Details</h4>
                  </div>
                  <div class="border-alls">
                    <img src="/assets/images/open-book.png" alt="">
                    <h4>Brochure Details</h4>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-8  col-lg-8 pl-md-0">
              <div class="all-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <div class=" leadform-header">
                  <div class="lead-hdr-img"><img src="{{ asset($university->imgpath) }}" alt="">
                  </div>
                  <div class="hdr-info">
                    <h3 class="">Register Now To Download Brochure</h3>
                    <p class="all-list">{{ $university->name }}</p>
                  </div>
                </div>
                <form action="{{ route('inquiry.university.profile') }}" method="post" class="form-added"
                  id="dataForm">
                  @csrf
                  <input type="hidden" name="requestfor" id="requestfor" value="">
                  <input type="hidden" name="university_id" value="{{ $university->id }}">
                  <input type="hidden" name="source_path" value="{{ URL::full() }}">

                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <input name="name" type="text" class="form-control" placeholder="Full Name*"
                          value="{{ old('name') }}" required="">
                      </div>
                      <span class="text-danger" id="name-err"></span>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <input name="email" type="text" placeholder="Email" value="{{ old('email') }}"
                          class="form-control">
                      </div>
                      <span class="text-danger" id="email-err"></span>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <div class="d-flex align-items-center setgap3 position-relative mobile-field">
                          <select name="c_code" class="form-control call-select" required>
                            @foreach ($phonecodes as $row)
                              <option value="{{ $row->phonecode }}"
                                {{ (old('c_code') && old('c_code') == $row->phonecode) || $row->phonecode == '91' ? 'Selected' : '' }}>
                                +{{ $row->phonecode }} ({{ $row->name }})
                              </option>
                            @endforeach
                          </select>
                          <input name="mobile" type="text" class="form-control"
                            placeholder="Mobile/WhatsApp No*" value="{{ old('mobile') }}" required="">
                        </div>
                        <span class="text-danger" id="c_code-err"></span>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <select name="nationality" id="nationality" class="form-control">
                          <option value="">Nationality</option>
                          @foreach ($countries as $row)
                            <option value="{{ $row->name }}"
                              {{ old('nationality') && old('nationality') == $row->name ? 'Selected' : '' }}>
                              {{ $row->name }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger" id="nationality-err"></span>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <select name="highest_qualification" id="highest_qualification" class="form-control ">
                          <option value="">Your Highest Qualification Level</option>
                          @foreach ($levels as $row)
                            <option value="{{ $row->level }}"
                              {{ old('highest_qualification') && old('highest_qualification') == $row->level ? 'Selected' : '' }}>
                              {{ $row->level }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger" id="highest_qualification-err"></span>
                      </div>

                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <select name="intrested_subject" id="intrested_subject" class="form-control ">
                          <option value="">Intrested Course Category</option>
                          @foreach ($course_categories as $row)
                            <option value="{{ $row->name }}"
                              {{ old('intrested_subject') && old('intrested_subject') == $row->name ? 'Selected' : '' }}>
                              {{ $row->name }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger" id="intrested_subject-err"></span>
                      </div>

                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <div class="d-flex all-regi align-items-center setgap3">
                          <input type="text" placeholder="Captcha : {{ $captcha['text'] }}  ="
                            class="form-control  widthss" value="Captcha : {{ $captcha['text'] }}  =" disbaled=""
                            readonly="">
                          <input type="number" name="captcha_answer" class="form-control"
                            placeholder="Enter Captcha Value" required="">
                        </div>
                        <span class="text-danger" id="captcha_answer-err"></span>
                      </div>

                    </div>
                    <div class="col-12 text-right ">
                      <p class=" mb-3 text-left linkp">By submitting this form, you accept and
                        agree to our <a href="{{ route('tc') }}" rel="noopener" target="_blank">Terms of
                          Use.</a></p>

                      <div class="row flex-column-reverse flex-md-row align-items-center ">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                          <button type="submit" class="btn btn-primary rounded">Send
                            Message</button>
                        </div>
                      </div>

                    </div>

                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
