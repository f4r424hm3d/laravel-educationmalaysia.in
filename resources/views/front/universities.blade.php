@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.dynamic_page_meta_tag')
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
        "position": 2,
        "name": "Universities in Malaysia",
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
              <li class="facts-1">Universities in Malaysia</li>
            </ul>
            <div class="ed_header_caption mb-0">
              <h2 class="ed_title mb-0"><span><?php echo $total; ?></span> <?php echo $currentInstituteType; ?> In <span>Malaysia</span></h2>
              <p>Find a list of top <?php echo $currentInstituteType; ?> in malaysia. Get details such as institution type, campus
                location, courses offered, World rating and other pertinent information about all the top
                <?php echo $currentInstituteType; ?> in malaysia. Fill out an online request form to get the complete information about any
                top <?php echo $currentInstituteType; ?> in malaysia you're interested in.</p>
            </div>
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
            @include('front.filter-universities')
          </div>
        </div>
        <div class="col-lg-9 col-md-12 col-12">
          <div class="row align-items-center mb-3">
            <div class="col-lg-12 col-md-12 col-sm-12">
              Found <strong>{{ $total }}</strong> Universities
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 ordering">
              <div class="filter_wraps">
                <div class="dn db-991 mt30 mb0 show-23">
                  <div id="main2"><a href="javascript:void(0)" class="btn btn-theme filter_open" onClick="openNav()"
                      id="open2">Show Filter<span class="ml-2"><i class="ti-arrow-right"></i></span></a></div>
                </div>
              </div>
              @if (session()->has('FilterInstituteType') || session()->has('FilterState'))
                <div class="portal-filter">
                  <ul>
                    @if (session()->has('FilterInstituteType'))
                      <li><a onclick="removeFilter('FilterInstituteType')"
                          href="javascript:void(0)">{{ $currentInstituteType }}<span class="cross">×</span></a>
                      </li>
                    @endif
                    @if (session()->has('FilterState'))
                      <li><a onclick="removeFilter('FilterState')"
                          href="javascript:void(0)">{{ unslugify(session()->get('FilterState')) }}<span
                            class="cross">×</span></a>
                      </li>
                    @endif
                  </ul>
                  @if (session()->has('FilterInstituteType') || session()->has('FilterState'))
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
                        <img data-src="{{ asset($row->imgpatg) }}" class="w-100" alt="{{ $row->name }} Logo">
                      </div>

                      <div class="dashboard_single_course_caption col-lg-11 col-12">
                        <div class="dashboard_single_course_head">
                          <div class="dashboard_single_course_head_flex mt-0">
                            <h4 class="dashboard_course_title mb-1" style="font-size:20px">
                              <a href="{{ url($row->slug) }}">
                                {{ $row->name }}
                              </a>
                            </h4>
                            <div class="row">
                              <div class="col-md-12">
                                <i class="ti-location-pin"></i>
                                {{ formatLocation($row->city, $row->state, $row->country) }}
                              </div>
                            </div>
                          </div>
                          <div class="dc_head_right">
                            <div class="dropdown">
                              <a href="{{ url('book-demo') }}" class="btn btn-modern2 univ-btn reviews-btn">Apply Now</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2 mb-1">
                      <div class="col-md-3 col-6"><span class="theme-cl">Founded:</span>
                        {{ $row->founded }}
                      </div>
                      <div class="col-md-3 col-6"><span class="theme-cl">Course:</span>
                        {{ $row->programs->count() ?? 'N/A' }}</div>
                      <div class="col-md-3 col-6"><span class="theme-cl">Type:</span>
                        {{ $row->getInstType->type ?? 'N/A' }}
                      </div>
                      <div class="col-md-3 col-6"><span class="theme-cl">Scholarship:</span> Yes</div>
                    </div>
                    <hr>
                    <div class="row mt-1 p-2">
                      <div class="col-md-12 mb-2">
                        <div class="row">
                          <div class="col-lg-8 col-md-8 col-sm-6">
                            <h6 style="display: inline-block">
                              <a href="{{ url($row->slug . '/course/' . $row->program_slug) }}" contenteditable="false"
                                style="cursor: pointer;"><i class="fa fa-hand-point-right mr-1 theme-cl"></i>
                                {{ $row->program_name }}</a>
                            </h6>

                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="checkbox-col">
                              <label class="check-box"> Add To Compare
                                <input type="checkbox">
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                        </div>

                        <div class="row align-items-center">
                          <div class="col-lg-7 col-md-7">
                            <div class="row">
                              <div class="col-md-3 col-4 mt-1 mb-1"><span class="theme-cl">
                                  Mode:</span><br>{{ jsonToTextByLimit($row->study_mode, '2') }}</div>
                              <div class="col-md-3 col-4 mt-1 mb-1"><span
                                  class="theme-cl">Duration:</span><br>{{ $row->duration }}
                              </div>
                              <div class="col-md-4 col-4 mt-1 mb-1"><span class="theme-cl">Intakes:</span><br>
                                {{ jsonToTextByLimit($row->intake, '3') }}</div>
                            </div>
                          </div>
                          <div class="col-lg-5 col-md-5  mt-1">
                            @if ($row->programs->count() > 0)
                              <a href="{{ url($row->slug . '/courses') }}" class="new-rbtn">
                                <i class="fa fa-graduation-cap"></i> All Programs
                              </a>
                            @endif
                            @if ($row->reviews->count() > 0)
                              <a href="{{ url($row->slug . '/reviews') }}" class="new-rbtn"><i class="fa fa-star"></i>
                                Reviews</a>
                            @endif
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
    $(document).ready(function() {
      $('#filter_country').change(function() {
        //alert('hello');
        var selectedCountry = $(this).val();
        var baseUrl = "{{ url('/') }}";
        if (selectedCountry) {
          $.ajax({
            url: "{{ url('course-list/remove-all-filter') }}",
            method: "GET",
            success: function(b) {
              var redirectUrl = baseUrl + '/' + selectedCountry + '/' + selectedCountry + '-universities';
              window.location.href = redirectUrl;
            }
          });
        }
      });
      $('#mbl_filter_country').change(function() {
        //alert('hello');
        var selectedCountry = $(this).val();
        var baseUrl = "{{ url('/') }}";
        if (selectedCountry) {
          $.ajax({
            url: "{{ url('course-list/remove-all-filter') }}",
            method: "GET",
            success: function(b) {
              var redirectUrl = baseUrl + '/' + selectedCountry + '/' + selectedCountry + '-universities';
              window.location.href = redirectUrl;
            }
          });
        }
      });
    });

    function applyFilter(col, val) {
      //alert(col+' '+val);
      if (val != '') {
        $.ajax({
          url: "{{ route('university.list.apply.filter') }}",
          method: "GET",
          data: {
            col: col,
            val: val
          },
          success: function(data) {
            //alert(data);
            window.location.replace(data);
          }
        });
      }
    }

    function removeFilter(value) {
      //alert(value);
      if (value != "") {
        $.ajax({
          url: "{{ route('university.list.remove.filter') }}",
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
        url: "{{ route('university.list.remove.all.filter') }}",
        method: "GET",
        success: function(b) {
          window.open("{{ url('universities-in-malaysia') }}", '_SELF');
        }
      })
    }
  </script>
@endsection
