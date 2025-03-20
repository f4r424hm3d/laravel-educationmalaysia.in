@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="image-cover ed_detail_head lg" style="background:url({{ url('/front/') }}/assets/img/ub.jpg);"
    data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1"><a href="#">Contact</a></li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">Contact Britannica</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  <!-- Content -->
  <section class="bg-light contactusz ">
    <div class="container">

      <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-12 mb-4 ">
          <div class="prc_wrap">
            <div class="prc_wrap_header">
              <h4 class="property_block_title">Contacts info & Details</h4>
            </div>
            <div class="prc_wrap-body">
              <div class="contact-info">
                <p>We at Britannica Education have not only been taking care of students but also understand their needs.
                  We consult the students as well as their family to take the right decision for a bright and happy
                  future.</p>

                <div class="cn-info-detail">
                  <div class="cn-info-content">
                    <h4 class="cn-info-title"><i class="ti-home mr-1 theme-cl"></i> Location:</h4>
                    B-16 Ground Floor, Mayfield Garden, Sector 50, Gurugram, Haryana, India 122002
                  </div>
                </div>

                <div class="cn-info-detail">
                  <div class="cn-info-content">
                    <h4 class="cn-info-title"><i class="ti-email mr-1 theme-cl"></i> Drop A Mail</h4>
                    info@educationmalaysia.in<br>
                    sales@educationmalaysia.in
                  </div>
                </div>

                <div class="cn-info-detail mb-2">
                  <div class="cn-info-content">
                    <h4 class="cn-info-title"><i class="ti-mobile mr-1 theme-cl"></i> Call Us</h4>
                    (+91) 9818560331<br>
                    (+91) 8130798532
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-8 col-md-7 col-sm-12 mb-4">
          <div class="prc_wrap">
            <div class="prc_wrap_header">
              <h4 class="property_block_title">Get in Touch</h4>
            </div>
            @if (session()->has('smsg'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span id="smsg">{{ session()->get('smsg') }}</span>
              </div>
            @endif
            @if (session()->has('emsg'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span id="emsg">{{ session()->get('emsg') }}</span>
              </div>
            @endif
            @error('g-recaptcha-response')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="prc_wrap-body">
              <form action="{{ url('contact') }}" method="post">
                @csrf
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                <input type="hidden" name="source" value="contact-us">
                <input type="hidden" name="source_path" value="{{ URL::full() }}">
                <div class="row">
                  <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" placeholder="Write your name" name="name" id="name"
                        value="{{ old('name') }}" class="form-control simple">
                      @error('name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" placeholder="example@gmail.com" name="email" id="email"
                        value="{{ old('email') }}" class="form-control simple">
                      @error('email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Message</label>
                  <textarea id="message" name="message" placeholder="Write Your Message" id="message" class="form-control simple">{{ old('message') }}</textarea>
                  @error('message')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">

                  <div class="input-group">
                    <div class="input-icon"><span class="ti-captcha_answer">
                        <label for="captcha_question">{{ $captcha['text'] }}</label>
                      </span></div>
                    <input type="number" name="captcha_answer" class="form-control" placeholder="Enter Captcha Value"
                      required="">
                  </div>
                  @error('captcha_answer')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group mb-0"><button class="btn btn-theme" type="submit">Submit Request</button></div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <section class="min-sec">
    <div class="container">

      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
          <div class="sec-heading">
            <h2>Our <span class="theme-cl1">Locations</span></h2>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 p-0">

          <div class="container">

            <div class="custom-tab customize-tab tabs_creative">
              <ul class="nav nav-tabs pb-2 b-0 vertically-scrollbar" id="myTab" role="tablist">
                @php $i = 1; @endphp
                @foreach ($allCountries as $country)
                  <li class="nav-item">
                    <a class="nav-link {{ $i == 1 ? 'active' : '' }}" id="{{ $country->country }}-tab"
                      data-toggle="tab" href="#{{ $country->country }}" role="tab" aria-selected="true"
                      aria-expanded="true">
                      {{ ucwords($country->country) }}
                    </a>
                  </li>
                  @php $i++; @endphp
                @endforeach
              </ul>

              <div class="tab-content" id="myTabContent">
                @php $j = 1; @endphp
                @foreach ($addressesByCountry as $country => $addresses)
                  <div class="tab-pane fade {{ $j == 1 ? 'active' : '' }} show bg-light pt-4 pr-2 pb-4 pl-2"
                    id="{{ $country }}" role="tabpanel" aria-labelledby="{{ $country }}-tab"
                    aria-expanded="true">
                    <div class="container">
                      <div class="row">
                        @foreach ($addresses as $address)
                          <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                            <div class="card mb-0 h-100">
                              <div class="card-body">
                                <h5>{{ $address->city }}</h5>
                                <h4 class="cn-info-title"><i class="ti-home mr-1 theme-cl"></i> Location:</h4>
                                <p class="card-text">{{ $address->address }}</p>
                                <p class="cn-info-title theme-cl"><i class="ti-mobile mr-1 theme-cl"></i> Contact: <a
                                    href="tel:{{ $address->mobile }}">{{ $address->mobile }}</a></p>
                                <p class="cn-info-title theme-cl"><i class="ti-email mr-1 theme-cl"></i> Email: <a
                                    href="mailto:{{ $address->email }}">{{ $address->email }}</a></p>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  @php $j++; @endphp
                @endforeach
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
          <div class="sec-heading">
            <h2>View in <span class="theme-cl">Google map</span></h2>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 p-0">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14035.267462665315!2d77.0567231!3d28.4247823!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdff990e03def313c!2sBritannica%20Overseas%20Education!5e0!3m2!1sen!2sin!4v1673527931145!5m2!1sen!2sin"
              width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Content -->
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
@endsection
