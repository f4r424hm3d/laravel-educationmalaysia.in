@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <div class="image-cover ed_detail_head lg" style="background:url(assets/img/ub.jpg);" data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1"><a href="{{ url('team') }}">Team</a></li>
              <li class="facts-1">{{ $user->name }}</li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">{{ $user->name }}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content -->
  <section class="bg-light pb-3">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
          <!-- all universities -->
          <div class="dashboard_container bg-transparent shadow-0">
            <div class="dashboard_container_body">
              <div id="accordionExample" class="accordion shadow circullum">
                <div class="card mb-3 p-4">
                  <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div>
                        <div class="dashboard_container_body p-4 bg-light">
                          <div class="viewer_detail_wraps">
                            <div class="viewer_detail_thumb">
                              <img src="{{ asset($user->profile_picture) }}" class="img-fluid w-100 circle"
                                alt="">
                              @if ($user->working_status != null)
                                <div class="viewer_status badge bg-{{ $user->ws->class }}">{{ $user->ws->status }}</div>
                              @endif
                            </div>
                            <div class="caption">
                              <div class="viewer_package_status"><strong>Experience :
                                  {{ $user->experience_short }}</strong></div>
                              <div class="viewer_header">
                                <h4>{{ $user->name }}</h4>
                                <span class="viewer_location"><strong>Designation :</strong>
                                  {{ $user->designation }}</span>
                                <span class="viewer_location"><strong>Branch Name : </strong> {{ $user->branch }}</span>
                              </div>

                              @if ($user->ws->status != null)
                                <div class="alert alert-{{ $user->ws->class }} alert-dismissible fade show"
                                  role="alert">
                                  {{ $user->ws->status }} : <span id="smsg">{{ $user->ws->shortnote }}</span>
                                </div>
                              @endif

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <h4 class="b-b pb-2 pt-4 theme-cl1">About {{ $user->name }}</h4>
                      <p class="font-size-16">
                        {!! $user->shortnote !!}
                      </p>
                    </div>
                    <div class="col-lg-6 mt-3 mb-3">
                      <h4 class="b-b pb-2 theme-cl1">Highlights</h4>
                      {!! $user->highlights !!}
                    </div>
                    <div class="col-lg-6 mt-3 mb-3">
                      <h4 class="b-b pb-2 theme-cl1">Education</h4>
                      {!! $user->education !!}
                    </div>
                    <div class="col-md-12">
                      {{-- <h4 class="b-b pb-2 theme-cl1 mt-4">Skills</h4>
                      <div class="rating-bars">
                        <div class="rating-bars-item">
                          <span class="rating-bars-name">HTML</span>
                          <span class="rating-bars-inner">
                            <span class="rating-bars-rating high" data-rating="4.7">
                              <span class="rating-bars-rating-inner" style="width: 85%;"></span>
                            </span>
                            <strong>85%</strong>
                          </span>
                        </div>
                        <div class="rating-bars-item">
                          <span class="rating-bars-name">CSS</span>
                          <span class="rating-bars-inner">
                            <span class="rating-bars-rating good" data-rating="3.9">
                              <span class="rating-bars-rating-inner" style="width: 75%;"></span>
                            </span>
                            <strong>75%</strong>
                          </span>
                        </div>
                        <div class="rating-bars-item">
                          <span class="rating-bars-name">SEO</span>
                          <span class="rating-bars-inner">
                            <span class="rating-bars-rating mid" data-rating="3.2">
                              <span class="rating-bars-rating-inner" style="width: 52.2%;"></span>
                            </span>
                            <strong>53%</strong>
                          </span>
                        </div>
                        <div class="rating-bars-item">
                          <span class="rating-bars-name">PHP</span>
                          <span class="rating-bars-inner">
                            <span class="rating-bars-rating poor" data-rating="2.0">
                              <span class="rating-bars-rating-inner" style="width:20%;"></span>
                            </span>
                            <strong>20%</strong>
                          </span>
                        </div>
                      </div> --}}
                      <h4 class="b-b pb-2 theme-cl1 mt-4">Experience</h4>
                      {!! $user->experience_description !!}
                      <h4 class="b-b pb-2 theme-cl1 mt-4">Language</h4>
                      @if ($user->languages != null)
                        <ul class="list-btn">
                          @php
                            $lang = explode(',', $user->languages);
                          @endphp
                          @foreach ($lang as $l)
                            <li><span>{{ $l }}</span></li>
                          @endforeach
                        </ul>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    </div>
  </section>

  <style type="text/css">
    .list-btn {
      padding: 0px;
    }

    .list-btn li {
      padding: 0px 10px 0px;
      margin: 15px 0px 15px;
      display: inline-flex;
    }

    .list-btn li span {
      padding: 13px 18px 13px;
      background: #f4f8fa;
      border-radius: 18px;
      font-weight: 600;
    }

    .list-btn li :hover {
      background: rgba(218, 11, 78, 0.2);
    }

    .btn.btn_apply.w-100 {
      background: #da0b4e;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 4px;
      color: #ffffff;
    }

    .viewer_location {
      display: block;
    }

    .customize-tab.tabs_creative .nav-link {
      font-weight: 600;
      display: block;
      background: #edf0f5;
      border-radius: 4px;
      border: 1px solid #edf0f5 !important;
      margin-right: 0.5rem;
      padding: 8px 30px 8px;
    }

    .viewer_detail_thumb {
      width: 170px;
      height: 170px;
      border-radius: 50%;
      position: relative;
      margin-right: 1rem;
      display: flex;
    }
  </style>
@endsection
