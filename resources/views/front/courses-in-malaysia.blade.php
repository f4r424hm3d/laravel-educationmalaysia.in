@php
  use App\Models\StudentApplication;
@endphp
@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.dynamic_page_meta_tag')
@endpush
@push('pagination_tag')
  @if ($npu)
    <link rel="next" href="{{ $npu }}" />
  @endif
  @if ($ppu)
    <link rel="prev" href="{{ $ppu }}" />
  @endif
@endpush
@push('breadcrumb_schema')
  <!-- breadcrumb schema Code -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "BreadcrumbList",
      "name": "{{ ucwords($meta_title) }}",
      "description": "{{ $meta_description }}",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "{{ url('/') }}"
      }, {
        "@type": "ListItem",
        "position": 3,
        "name": "Courses in Malaysia",
        "item": "{{ url()->current() }}"
      }
      ]
    }
  </script>
  <!-- breadcrumb schema Code End -->
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="ed_detail_head" data-overlay="10">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1">Courses in Malaysia</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->

  <!-- Content -->
  <section class="bg-light pt-4 pb-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div id="accordionExample" class="accordion shadow circullum hide-23 full-width">
            @include('front.filter-courses-in-malaysia')
          </div>
        </div>
        <div class="col-lg-9 col-md-12 col-12">
          <div class="row align-items-center mb-3">
            <div class="col-lg-12 col-md-12 col-sm-12">
              Found <strong>{{ $total }}</strong> programs
              <p>{!! $page_contents !!}</p>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 ordering">
              <div class="filter_wraps">
                <div class="dn db-991 mt30 mb0 show-23">
                  <div id="main2"><a href="javascript:void(0)" class="btn btn-theme filter_open" onClick="openNav()"
                      id="open2">Show Filter<span class="ml-2"><i class="ti-arrow-right"></i></span></a></div>
                </div>
              </div>
              @if (session()->has('CFilterLevel') ||
                      session()->has('CFilterCategory') ||
                      session()->has('CFilterSpecialization') ||
                      isset($_GET['study_mode']) ||
                      isset($_GET['intake']))
                <div class="portal-filter">
                  <ul>
                    @if (session()->has('CFilterLevel'))
                      <li><a onclick="removeFilter('CFilterLevel')" href="javascript:void(0)">{{ $curLevel->level }}<span
                            class="cross">×</span></a>
                      </li>
                    @endif
                    @if (session()->has('CFilterCategory'))
                      <li><a onclick="removeFilter('CFilterCategory')" href="javascript:void(0)">{{ $curCat->name }}<span
                            class="cross">×</span></a>
                      </li>
                    @endif
                    @if (session()->has('CFilterSpecialization'))
                      <li><a onclick="removeFilter('CFilterSpecialization')"
                          href="javascript:void(0)">{{ $curSpc->name }}<span class="cross">×</span></a>
                      </li>
                    @endif
                    @if (isset($_GET['study_mode']))
                      <li><a onclick="removeStaticFilter('study_mode')"
                          href="javascript:void(0)">{{ $_GET['study_mode'] }}<span class="cross">×</span></a>
                      </li>
                    @endif
                    @if (isset($_GET['intake']))
                      <li><a onclick="removeStaticFilter('intake')" href="javascript:void(0)">{{ $_GET['intake'] }}<span
                            class="cross">×</span></a>
                      </li>
                    @endif

                  </ul>
                  @if (session()->has('CFilterLevel') ||
                          session()->has('CFilterCategory') ||
                          session()->has('CFilterSpecialization') ||
                          isset($_GET['study_mode']) ||
                          isset($_GET['intake']))
                    <a onclick="removeAllFilter()" href="javascript:void(0)" class="clearAll">Clear All</a>
                  @endif
                </div>
              @endif
            </div>
          </div>
          <!-- all universities -->
          <div class="dashboard_container">
            <div class="dashboard_container_body">
              @if ($rows->count() > 0)
                @foreach ($rows as $row)
                  <!-- Single University -->
                  <div class="dashboard_single_course align-items-center d-block">

                    <div class="row align-items-center">
                      <div class="col-lg-1 col-12">
                        <img data-src="{{ asset($row->university->imgpath) }}" class="w-100"
                          alt="{{ $row->university->name }} Logo">
                      </div>

                      <div class="dashboard_single_course_caption col-lg-11 col-12">
                        <div class="dashboard_single_course_head">
                          <div class="dashboard_single_course_head_flex mt-0">
                            <h4 class="dashboard_course_title mb-1" style="font-size:20px">
                              <a
                                href="{{ route('university.overview', ['university_slug' => $row->university->uname]) }}">
                                {{ $row->university->name }}
                              </a>
                            </h4>
                            <div class="row">
                              <div class="col-md-12">
                                <i class="ti-location-pin"></i>
                                {{ formatLocation($row->university->city, $row->university->state, $row->university->country) }}
                              </div>
                            </div>
                          </div>
                          <div class="dc_head_right">
                            <div class="dropdown">
                              @if (session()->has('studentLoggedIn'))
                                @php
                                  $studentId = session()->get('student_id');
                                  $checkAppliedProgram = StudentApplication::where('stdid', $studentId)
                                      ->where('prog_id', $row->id)
                                      ->first();
                                @endphp
                                @if ($checkAppliedProgram)
                                  @if ($checkAppliedProgram->status == 1)
                                    <button class="btn btn-modern2 univ-btn reviews-btn">Applied</button>
                                  @else
                                    <a href="{{ route('student.apply.program', ['program_id' => $row->id]) }}"
                                      class="btn btn-modern2 univ-btn reviews-btn">Apply Now</a>
                                  @endif
                                @else
                                  <a href="{{ route('student.apply.program', ['program_id' => $row->id]) }}"
                                    class="btn btn-modern2 univ-btn reviews-btn">Apply Now</a>
                                @endif
                              @else
                                <a href="{{ url('sign-up?program_id=' . $row->id) }}"
                                  class="btn btn-modern2 univ-btn reviews-btn">Apply Now</a>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2 mb-1">
                      <div class="col-md-4 col-6">
                        <span class="theme-cl">Institute Type : </span>
                        {{ $row->university->instituteType->type }}
                      </div>
                      <div class="col-md-4 col-6">
                        <span class="theme-cl">Course : </span>
                        {{ $row->university->programs->count() ?? 'N/A' }}
                        @if ($row->university->programs->count() > 0)
                          <a href="{{ route('university.courses', ['university_slug' => $row->university->uname]) }}"
                            class="new-rbtn">
                            <i class="fa fa-graduation-cap"></i> All Programs
                          </a>
                        @endif
                      </div>
                      <div class="col-md-4 col-6">
                        <span class="theme-cl">World Ranking : </span>
                        {{ $row->university->rank ?? 'N/A' }}
                      </div>
                    </div>
                    <hr>
                    <div class="row mt-1 p-2">
                      <div class="col-md-12 mb-2">
                        <div class="row">
                          <div class="col-lg-8 col-md-8 col-sm-6">
                            <h6 style="display: inline-block">
                              <a href="{{ route('university.course.details', ['university_slug' => $row->university->uname, 'course_slug' => $row->slug]) }}"
                                contenteditable="false" style="cursor: pointer;">
                                <i class="fa fa-hand-point-right mr-1 theme-cl"></i> {{ $row->course_name }}
                              </a>
                            </h6>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="{{ route('university.course.details', ['university_slug' => $row->university->uname, 'course_slug' => $row->slug]) }}"
                              class="btn btn-modern2 univ-btn reviews-btn">View Detail</a>
                          </div>
                        </div>
                        <div class="row align-items-center">
                          <div class="col-lg-12 col-md-12">
                            <div class="row">
                              <div class="col-md-4 col-4 mt-1 mb-1"><span class="theme-cl">
                                  Mode:</span><br>{{ $row->study_mode }}</div>
                              <div class="col-md-4 col-4 mt-1 mb-1"><span
                                  class="theme-cl">Duration:</span><br>{{ $row->duration }}
                              </div>
                              <div class="col-md-4 col-4 mt-1 mb-1"><span class="theme-cl">Intakes:</span><br>
                                {{ $row->intake }}</div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              @else
                <center>No Data Found with your match</center>
              @endif
            </div>
          </div>
          {!! $rows->links('pagination::bootstrap-4') !!}
        </div>
      </div>
    </div>
  </section>
  <!-- Content -->
  <!-- Mobile Filter -->
  <div id="filter-sidebar" class="filter-sidebar">
    <div class="filt-head">
      <h4 class="filt-first">Filter</h4>
      <a href="javascript:void(0)" class="closebtn" onClick="closeNav()">Close <i class="ti-close ml-1"></i></a>
    </div>
    <div class="show-hide-sidebar">
      <div class="sidebar-widgets">
        <!-- Search Form -->

      </div>
    </div>
  </div>
  <!-- Show more -->
  <script>
    $(".show-more").click(function() {
      if ($(".text").hasClass("show-more-height")) {
        $(this).text("(Show Less)");
      } else {
        $(this).text("(Show More)");
      }
      $(".text").toggleClass("show-more-height");
    });
  </script>

  <script>
    function openNav() {
      document.getElementById("filter-sidebar").style.width = "320px";
    }

    function closeNav() {
      document.getElementById("filter-sidebar").style.width = "0";
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function ApplyFilter(slug) {
      var baseUrl = "{{ url('/') }}";
      if (slug) {
        var redirectUrl = baseUrl + '/' + slug + '-courses';
        window.location.href = redirectUrl;
      }
    }

    // function applyFilter(col, val) {
    //   if (val != '') {
    //     $.ajax({
    //       url: "{{ route('university.list.apply.filter') }}",
    //       method: "GET",
    //       data: {
    //         col: col,
    //         val: val
    //       },
    //       success: function(data) {
    //         window.location.replace(data);
    //       }
    //     });
    //   }
    // }

    function removeFilter(value) {
      //alert(value);
      if (value != "") {
        $.ajax({
          url: "{{ route('cl.remove.filter') }}",
          method: "GET",
          data: {
            value: value,
          },
          success: function(b) {
            window.location.replace(b);
          }
        })
      }
    }

    function removeAllFilter() {
      $.ajax({
        url: "{{ route('cl.remove.all.filter') }}",
        method: "GET",
        success: function(b) {
          window.open("{{ url('courses-in-malaysia') }}", '_SELF');
        }
      })
    }

    function ApplyStaticFilter(key, value) {
      let currentUrl = window.location.href;
      let url = new URL(currentUrl);

      // Replace spaces with '+' symbol manually
      value = value.replace(/ /g, '+');

      url.searchParams.set(key, value);
      window.location.href = decodeURIComponent(url);
    }

    function removeStaticFilter(key) {
      let currentUrl = window.location.href;
      let url = new URL(currentUrl);

      // Remove the specified query parameter
      url.searchParams.delete(key);
      window.location.href = decodeURIComponent(url); // Redirect to the modified URL
    }
  </script>
@endsection
