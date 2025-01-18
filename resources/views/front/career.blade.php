@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="image-cover ed_detail_head lg" style="background:url(assets/img/ub.jpg);" data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1">Career</li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">Career</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->

  <!-- Content -->
  <section class="bg-light">
    <div class="container">
      @if (session()->has('smsg'))
        <div>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span id="smsg">{{ session()->get('smsg') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      @endif
      <div class="sec-heading center">
        <h2>Job Openings in <span class="theme-cl1">Education Malaysia</span></h2>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div id="accordionExample" class="accordion shadow circullum">

            @foreach ($jobs as $row)
              <div class="card mb-3">
                <div id="headingOne{{ $row->id }}" class="card-header bg-white shadow-sm border-0">
                  <h6 class="mb-0 accordion_title">
                    <a href="#" data-toggle="collapse" data-target="#collapseOne{{ $row->id }}"
                      aria-expanded="false" aria-controls="collapseOne{{ $row->id }}"
                      class="d-block position-relative collapsed text-dark collapsible-link py-2">
                      {{ $row->designation }}
                    </a>
                  </h6>
                </div>
                <div id="collapseOne{{ $row->id }}" aria-labelledby="headingOne{{ $row->id }}"
                  data-parent="#accordionExample" class="collapse">
                  <div class="card-body pl-4 pr-4">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                        <div class="bg-light rounded p-4">
                          <p>
                            <strong>No. of Position :</strong> {{ $row->no_of_position }} &nbsp; &nbsp; &nbsp;
                            <strong>Experience :</strong> {{ $row->experience }}
                          </p>
                          <p>
                            <strong>Location :</strong> {{ $row->location }} &nbsp; &nbsp; &nbsp;
                            <strong>Job Type :</strong> {{ $row->job_type }}
                          </p>

                          {!! $row->description !!}

                          <a href="#apply" class="btn btn-modern float-none">Apply Now <span><i
                                class="fa fa-angle-right"></i></span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

          </div>
        </div>

      </div>
    </div>
  </section>

  <section id="apply">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-7">
          <div class="prc_wrap bg-light">
            <div class="prc_wrap-body">
              @error('g-recaptcha-response')
                <span class="text-danger">{{ $message }}</span>
              @enderror
              <form action="{{ url('career/apply') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                      <label>Your Name</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-user"></span></div>
                        <input type="text" class="form-control  b-0 pl-0" placeholder="Write your name" name="name"
                          id="name" value="{{ old('name') }}">
                        @error('name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                      <label>Your Email</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-email"></span></div>
                        <input type="email" class="form-control  b-0 pl-0" placeholder="example@gmail.com"
                          name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                      <label>Contact No.</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-mobile"></span></div>
                        <input type="text" class="form-control  b-0 pl-0" placeholder="+66 555 666 888 22"
                          name="mobile" id="mobile" value="{{ old('mobile') }}">
                        @error('mobile')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                      <label>Experience</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-briefcase"></span></div>
                        <select name="experience" id="experience" class="form-control b-0 pl-0 bg-white"
                          style="color:#647b9c; height:48px">
                          <option value="">Select your experience</option>
                          @foreach ($experienceList as $exp)
                            <option value="{{ $exp }}" {{ old('experience') == $exp ? 'Selected' : '' }}>
                              {{ $exp }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                      <label>Apply for Position</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-vector"></span></div>
                        <select name="position" class="form-control b-0 pl-0 bg-white"
                          style="color:#647b9c; height:48px">
                          <option value="">Select position</option>
                          @foreach ($jobs as $row)
                            <option value="{{ $row->id }}" {{ old('position') == $row->id ? 'Selected' : '' }}>
                              {{ $row->designation }}</option>
                          @endforeach
                        </select>
                        @error('position')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>Upload your CV/Resume</label>
                      <div class="input-group input-group-merge">
                        <div class="input-icon"><span class="ti-upload color-primary"></span></div>
                        <input name="resume" type="file" class="form-control  b-0 pl-0"
                          placeholder="Upload you file max 1MB" style="padding-top:12px">
                        @error('resume')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <span class="text-danger"></span>
                    </div>
                  </div>
                  <div class=" col-12 col-md-12">
                    <div class="form-group">
                      <label>Your Message</label>
                      <div class="input-group input-group-merge">
                        <div class="input-icon align-items-start pt-3"><span class="ti-pencil-alt color-primary"></span>
                        </div>
                        <textarea name="message" id="message" type="text" class="form-control  b-0 pl-0"
                          placeholder="Enter your message here" style="height:100px; padding-top:17px">{{ old('message') }}</textarea>
                        @error('message')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class=" col-12 col-md-12">
                    <div class="form-group">
                      <label for="captcha_question">{{ $question['text'] }}</label>
                      <div class="input-group">
                        <div class="input-icon"><span class="ti-captcha_answer"></span></div>
                        <input type="number" name="captcha_answer" class="form-control b-0 pl-0"
                          placeholder="Enter Captcha Value" required="">
                      </div>
                      @error('captcha_answer')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group mb-0">
                  <button class="btn btn-modern float-none" type="submit">
                    Submit Request <span><i class="fa fa-angle-right"></i></span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-5">
          <div class="prc_wrap">
            <div class="prc_wrap_header">
              <h4 class="property_block_title theme-cl1">We are Hiring!</h4>
            </div>
            <div class="prc_wrap-body">
              <div class="contact-info">
                <p>Lead your professional career with Education Malaysia. Drop us a email.</p>

                <div class="cn-info-detail">
                  <div class="cn-info-content">
                    <h4 class="cn-info-title"><i class="ti-email mr-1 theme-cl1"></i> career@educationmalaysia.in
                    </h4>
                  </div>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 585.025">
                  <g id="Group_1844" data-name="Group 1844" transform="translate(-84.016 -101.471)">
                    <path id="Path_1527" data-name="Path 1527"
                      d="M152.849,238.149l35.407,16.443L176.922,326.1l-30.658-3.288,6.586-8.631Z"
                      transform="translate(142.422 312.717)" fill="#ffb07d" />
                    <path id="Path_1528" data-name="Path 1528"
                      d="M141.676,237.148l28.77,25.482-30,63.7-26.3-4.521,8.22-9.042Z"
                      transform="translate(68.92 310.429)" fill="#ffb07d" />
                    <rect id="Rectangle_341" data-name="Rectangle 341" width="312.36" height="124.944"
                      transform="translate(134.16 278.45)" fill="#eff4f7" />
                    <path id="Path_1529" data-name="Path 1529"
                      d="M187.623,211.284c10.41-22.467-4.682-32.729-5.343-47.676-.549-12.33,11.232-28.221,25.482-28.494l6.027-.549c18.834,0,37.812,10.137,35.346,36.99-1.21,13.188-11.235,13.974,20.928,44.746,8.9,8.513,3.387,44.829-8.457,44.829l-56.534-36.2c-3.673,2.535-32.452,72.484-35.122,68.551C142,252.384,179.814,227.724,187.623,211.284Z"
                      transform="translate(173.4 75.719)" fill="#3d3b78" />
                    <path id="Path_1530" data-name="Path 1530"
                      d="M167.844,221.861c0,37.223,28.629,80.556,63.952,80.556,35.3,0,75.936-42.3,63.8-87.3-13.037-48.366-58.559-41.3-65.546-68.841C194.73,146.273,167.844,184.644,167.844,221.861Z"
                      transform="translate(191.798 102.507)" fill="#3d3b78" />
                    <g id="Group_1662" data-name="Group 1662" transform="translate(134.01 101.471)">
                      <g id="Group_1660" data-name="Group 1660" transform="translate(41.349 26.637)">
                        <path id="Rectangle_342" data-name="Rectangle 342"
                          d="M11.85,0h112.3A11.85,11.85,0,0,1,136,11.85V91.137a11.851,11.851,0,0,1-11.851,11.851H11.849A11.849,11.849,0,0,1,0,91.139V11.85A11.85,11.85,0,0,1,11.85,0Z"
                          fill="#dce8ed" />
                        <path id="Path_1531" data-name="Path 1531" d="M172.888,133.309l23.08,26.635L142.7,158.168Z"
                          transform="translate(-41.086 -55.264)" fill="#dce8ed" />
                        <path id="Path_1532" data-name="Path 1532"
                          d="M139.333,129.958a7.99,7.99,0,1,0,7.993-7.99A8,8,0,0,0,139.333,129.958Z"
                          transform="translate(-48.794 -81.211)" fill="#8bb3c4" />
                        <path id="Path_1533" data-name="Path 1533"
                          d="M130.3,129.958a7.99,7.99,0,1,0,7.99-7.99A7.995,7.995,0,0,0,130.3,129.958Z"
                          transform="translate(-69.462 -81.211)" fill="#8bb3c4" />
                        <path id="Path_1534" data-name="Path 1534"
                          d="M121.66,129.958a7.99,7.99,0,1,0,7.99-7.99A7.993,7.993,0,0,0,121.66,129.958Z"
                          transform="translate(-89.23 -81.211)" fill="#8bb3c4" />
                      </g>
                      <g id="Group_1661" data-name="Group 1661">
                        <path id="Path_1535" data-name="Path 1535"
                          d="M174.921,139.322a37.85,37.85,0,1,1-37.851-37.851A37.852,37.852,0,0,1,174.921,139.322Z"
                          transform="translate(-99.221 -101.471)" fill="#ff5475" />
                        <path id="Path_1536" data-name="Path 1536"
                          d="M123.227,143.583l-18.63-17.2,7.225-7.828,10.031,9.26,15.066-19.766,8.477,6.459Z"
                          transform="translate(-86.919 -86.423)" fill="#fff" />
                      </g>
                    </g>
                    <path id="Path_1537" data-name="Path 1537"
                      d="M302.294,259.108l-175.352,6.576s.056-19.162.648-25.071c2.466-24.66,23.838-24.66,23.838-24.66l144.448-11.935Z"
                      transform="translate(98.214 234.627)" fill="#8f5fcd" />
                    <path id="Path_1538" data-name="Path 1538"
                      d="M241.286,188.971a26.854,26.854,0,0,1-.654-53.7l.681-.01a26.854,26.854,0,0,1,.654,53.7Zm.026-43.845-.437.007a16.99,16.99,0,0,0,.411,33.975l.437-.007a16.99,16.99,0,0,0,16.562-17.41A17.086,17.086,0,0,0,241.312,145.126Z"
                      transform="translate(298.427 77.314)" fill="#dae5ec" />
                    <g id="Group_1663" data-name="Group 1663" transform="translate(644.586 473.916)">
                      <rect id="Rectangle_343" data-name="Rectangle 343" width="9.864" height="34.473"
                        transform="translate(12.311)" fill="#dae5ec" />
                      <rect id="Rectangle_344" data-name="Rectangle 344" width="34.479" height="9.864"
                        transform="translate(0 12.304)" fill="#dae5ec" />
                    </g>
                    <path id="Path_1539" data-name="Path 1539"
                      d="M265.825,161.965l-38.634-.335s-20.55.059-31.647,25.541c-8.177,18.771-28.77,57.54-28.77,57.54s-25.327,5.119-16.45,20.632c5.784,10.107,17.068,10.341,17.068,10.341l15.368,1.575,1.1,53.7,114.534-7.671-2.154-44.056,12.33-.822s11.205,4.676,4.11-22.194c-7.234-27.363-.737-58.181-6.619-69.929C297.294,163.823,277.606,162.238,265.825,161.965Z"
                      transform="translate(147.395 137.644)" fill="#fff" />
                    <path id="Path_1540" data-name="Path 1540"
                      d="M145.426,355.193l53.157-116.505L149.67,213.4,117.889,347.8Z" transform="translate(77.5 256.09)"
                      fill="#8f5fcd" />
                    <path id="Path_1541" data-name="Path 1541"
                      d="M108.058,283.664,84.016,259.625l24.042-24.039L132.1,259.625ZM97.97,259.625l10.088,10.091,10.084-10.091-10.084-10.091Z"
                      transform="translate(0 306.857)" fill="#dae5ec" />
                    <rect id="Rectangle_345" data-name="Rectangle 345" width="95.718" height="9.864"
                      transform="translate(100.037 452.707)" fill="#e8eff3" />
                    <rect id="Rectangle_346" data-name="Rectangle 346" width="27.126" height="9.864"
                      transform="translate(384.885 356.81)" fill="#e8eff3" />
                    <path id="Path_1542" data-name="Path 1542"
                      d="M343.159,234.067H250.369A30.908,30.908,0,0,1,219.5,203.189v-.72a30.907,30.907,0,0,1,30.871-30.874h92.791a30.912,30.912,0,0,1,30.874,30.874v.72A30.913,30.913,0,0,1,343.159,234.067Zm-92.791-52.608a21.031,21.031,0,0,0-21.007,21.01v.72A21.032,21.032,0,0,0,250.369,224.2h92.791a21.037,21.037,0,0,0,21.01-21.014v-.72a21.036,21.036,0,0,0-21.01-21.01Z"
                      transform="translate(309.982 160.443)" fill="#e8eff3" />
                    <path id="Path_1543" data-name="Path 1543"
                      d="M206.759,163.963l7.51,42.349H195.363l-9.555-.016V193.065s-10.268-.671-14.753-9c-3.012-5.6-2.578-22.408-2.578-22.408l15.292-19.534S184.92,162.236,206.759,163.963Z"
                      transform="translate(193.197 93.021)" fill="#ffb07d" />
                    <path id="Path_1544" data-name="Path 1544"
                      d="M197.443,194.058,173.332,254.34l-20.277-16.989L184.291,169.4Z"
                      transform="translate(157.96 155.418)" fill="#ffb07d" />
                    <g id="Group_1664" data-name="Group 1664" transform="translate(85.553 332.028)">
                      <rect id="Rectangle_347" data-name="Rectangle 347" width="105.216" height="85.488"
                        fill="#36def6" />
                      <path id="Path_1545" data-name="Path 1545" d="M96.483,216.857V179.029l35.307,17.654Z"
                        transform="translate(-57.027 -154.575)" fill="#fff" />
                    </g>
                    <path id="Path_1546" data-name="Path 1546"
                      d="M138.273,267.474l-17.262-5.138-8.162,5.975-1.085,5.533,33.291.205,1.233-6.576Z"
                      transform="translate(63.486 368.058)" fill="#3d3b78" />
                    <path id="Path_1547" data-name="Path 1547"
                      d="M180.235,268.756l-13-1.644-14.786-4.8-6.12,6.3-1.436,6.923,34.961.2Z"
                      transform="translate(139.276 368.009)" fill="#3d3b78" />
                    <rect id="Rectangle_348" data-name="Rectangle 348" width="241.668" height="150.15"
                      transform="translate(338.016 493.268)" fill="#ff5475" />
                    <path id="Path_1548" data-name="Path 1548" d="M171.889,259.4l3.288,65.76,69.048-59.184Z"
                      transform="translate(201.052 361.337)" fill="#ff5475" />
                    <rect id="Rectangle_349" data-name="Rectangle 349" width="158.681" height="9.864"
                      transform="translate(379.902 528.338)" fill="#fff" />
                    <rect id="Rectangle_350" data-name="Rectangle 350" width="158.681" height="9.864"
                      transform="translate(379.902 561.218)" fill="#fff" />
                    <rect id="Rectangle_351" data-name="Rectangle 351" width="158.681" height="9.864"
                      transform="translate(379.902 594.098)" fill="#fff" />
                    <path id="Path_1549" data-name="Path 1549"
                      d="M290.2,249.765c1.489-6.813-3.834-41.1-3.834-41.1l-120.936-5.892-3.288,20.55-5.08,7.457,14.8,35.349,94.231.625S286.367,267.3,290.2,249.765Z"
                      transform="translate(167.131 231.778)" fill="#664ac7" />
                    <path id="Path_1550" data-name="Path 1550" d="M218.917,214.453H166.309v-9.864l52.608,3.288Z"
                      transform="translate(188.285 235.933)" fill="#3d3b78" />
                    <path id="Path_1551" data-name="Path 1551"
                      d="M233.318,188.638l30.414-18.906s13.606,62.163,15.207,83.43c.911,12.146-10.275,16.029-10.275,16.029l-77.965,9-4.482,8.881-18.3-1.309s.457-8.065,3.344-12.425a20.712,20.712,0,0,1,15.138-9.016l62.952-18.554Z"
                      transform="translate(191.956 156.181)" fill="#ffb07d" />
                    <path id="Path_1552" data-name="Path 1552"
                      d="M266.06,268.459l-19.112-87.334-121.672-.048,19.1,87.328Z" transform="translate(94.403 182.136)"
                      fill="#3d3b78" />
                    <path id="Path_1553" data-name="Path 1553"
                      d="M155.531,197.08a6.195,6.195,0,1,1-6.195-6.2A6.193,6.193,0,0,1,155.531,197.08Z"
                      transform="translate(135.28 204.572)" fill="#fff" />
                    <path id="Path_1554" data-name="Path 1554"
                      d="M177.892,368.959l31.1-160.974s-32.058-.822-43.293.549c-14.8,5.2-15.618,23.414-15.618,31.782,0,15.934-2.19,124.533-2.19,124.533Z"
                      transform="translate(146.141 243.145)" fill="#664ac7" />
                  </g>
                </svg>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <script>
    grecaptcha.ready(function() {
      grecaptcha.execute('{{ gr_site_key() }}', {
          action: 'contact_us'
        })
        .then(function(token) {
          // Set the reCAPTCHA token in the hidden input field
          document.getElementById('g-recaptcha-response').value = token;
        });
    });
  </script>
  <!-- Content -->
@endsection
