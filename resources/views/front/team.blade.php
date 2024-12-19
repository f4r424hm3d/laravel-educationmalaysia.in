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
              <li class="facts-1"><a href="index.html">Home</a></li>
              <li class="facts-1"><a href="#">Team</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="edu_cat_2 cat-3 pb-0 mb-0">
    <div class="container">
      <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="custom-tab customize-tab tabs_creative">
            <ul class="nav nav-tabs pb-2 b-0 mt-4 mb-4" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                  aria-controls="home" aria-selected="true">All</a>
              </li>
              @foreach ($rows as $row)
                <li class="nav-item">
                  <a class="nav-link" id="{{ slugify($row->department) }}-tab" data-toggle="tab"
                    href="#{{ slugify($row->department) }}" role="tab" aria-controls="{{ slugify($row->department) }}"
                    aria-selected="false">{{ $row->department }}</a>
                </li>
              @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">

              <!-- Classess -->
              <div class="tab-pane fade show active p-2" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  @foreach ($all as $row)
                    <div class="col-lg-3 col-md-4">
                      <!-- Single Slide -->
                      <div class="singles_items">
                        <div class="instructor_wrap">
                          <div class="instructor_thumb">
                            <img src="{{ asset($row->profile_picture) }}" class="img-fluid"
                              alt="{{ $row->name }} education counsellor">
                          </div>
                          <div class="instructor_caption">
                            <h4>{{ $row->name }}</h4>
                            @if ($row->working_status != null)
                              <span class="badge bg-{{ $row->ws->class }}">{{ $row->ws->status }}</span>
                            @endif
                            <ul class="instructor_info">
                              <li><i class="ti-tag"></i> {{ $row->designation }}</li>
                              <li><i class="ti-user"></i> {{ $row->experience_short }}</li>
                            </ul>
                            <a href="{{ url('team/' . $row->slug . '-' . $row->id) }}" class="btn btn-outline-theme">View
                              Details <i class="ti-arrow-right"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>

              @foreach ($rows as $dr)
                <!-- Education -->
                <div class="tab-pane fade" id="{{ slugify($dr->department) }}" role="tabpanel"
                  aria-labelledby="{{ slugify($dr->department) }}-tab">
                  <div class="row">
                    <!-- Single Video -->
                    @foreach ($dr->empByDepartment as $row)
                      <div class="col-lg-3 col-md-4">
                        <!-- Single Slide -->
                        <div class="singles_items">
                          <div class="instructor_wrap">
                            <div class="instructor_thumb">
                              <img src="{{ asset($row->profile_picture) }}" class="img-fluid"
                                alt="{{ $row->name }} education counsellor">
                            </div>
                            <div class="instructor_caption">
                              <h4>{{ $row->name }}</h4>
                              @if ($row->working_status != null)
                                <span class="badge bg-{{ $row->ws->class }}">{{ $row->ws->status }}</span>
                              @endif
                              <ul class="instructor_info">
                                <li><i class="ti-tag"></i> {{ $row->designation }}</li>
                                <li><i class="ti-user"></i> {{ $row->experience_short }}</li>
                              </ul>
                              <a href="{{ url('team/' . $row->slug . '-' . $row->id) }}"
                                class="btn btn-outline-theme">View
                                Details <i class="ti-arrow-right"></i></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endforeach

            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
