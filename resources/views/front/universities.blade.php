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
        "position": 2,
        "name": "Study In {{ $destination->destination_name }}",
        "item": "{{ url($destination->destination_slug) }}"
      }
      @if ((session()->has('FilterCategory') || session()->has('FilterSpecialization') || session()->has('FilterInstituteType')) && $headTitle != null)
      , {
        "@type": "ListItem",
        "position": 3,
        "name": "{{ $destination->destination_name }} Universities",
        "item": "{{ url($destination->destination_slug . '/' . $destination->destination_slug . '-universities') }}"
      }, {
        "@type": "ListItem",
        "position": 4,
        "name": "{{ $headTitle }}",
        "item": "{{ url()->current() }}"
      }
      @else
      , {
        "@type": "ListItem",
        "position": 3,
        "name": "{{ $destination->destination_name }} Universities",
        "item": "{{ url()->current() }}"
      }
      @endif
      ]
    }
  </script>
  <!-- breadcrumb schema Code End -->
  <!-- webpage schema Code Destinations -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "webpage",
      "url": "{{ url()->current() }}",
      "name": "{{ $pageHeading }}",
      "description": "{{ $meta_description }}",
      "inLanguage": "en-US",
      "keywords": ["{{ $meta_keyword }}"]
    }
  </script>
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
              <li class="facts-1"><a href="{{ url($destination->destination_slug) }}">Study In
                  {{ $destination->destination_name }}</a></li>
              @if (
                  (session()->has('FilterCategory') ||
                      session()->has('FilterSpecialization') ||
                      session()->has('FilterInstituteType')) &&
                      $headTitle != null)
                <li class="facts-1"><a
                    href="{{ url($destination->destination_slug . '/' . $destination->destination_slug . '-universities') }}">{{ $destination->destination_name }}
                    Universities</a></li>
                <li class="facts-1">{{ $headTitle }}</li>
              @else
                <li class="facts-1">{{ $destination->destination_name }} Universities</li>
              @endif
            </ul>
            <div class="ed_header_caption mb-0">
              <h1 class="ed_title mb-0">
                {{ $pageHeading }}
              </h1>
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
          <form class="form-inline addons hide-23 mb-2">
            <select class="left-dropdown-filter" id="filter_country">
              @foreach ($destinations as $row)
                <option value="{{ $row->getDestination->destination_slug }}"
                  {{ $row->destination_id == $destination->id ? 'selected' : '' }}>
                  {{ $row->getDestination->destination_name }}
                </option>
              @endforeach
            </select>

          </form>
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
              @if (session()->has('FilterLevel') ||
                      session()->has('FilterCategory') ||
                      session()->has('FilterSpecialization') ||
                      session()->has('FilterInstituteType') ||
                      session()->has('FilterState') ||
                      session()->has('FilterCity') ||
                      isset($_GET['study_mode']) ||
                      isset($_GET['intake']))
                <div class="portal-filter">
                  <ul>
                    @if (session()->has('FilterLevel'))
                      <li><a onclick="removeFilter('FilterLevel')" href="javascript:void(0)">{{ $curLevel->level }}<span
                            class="cross">×</span></a>
                      </li>
                    @endif
                    @if (session()->has('FilterCategory'))
                      <li><a onclick="removeFilter('FilterCategory')"
                          href="javascript:void(0)">{{ $curCat->category_name }}<span class="cross">×</span></a>
                      </li>
                    @endif
                    @if (session()->has('FilterSpecialization'))
                      <li><a onclick="removeFilter('FilterSpecialization')"
                          href="javascript:void(0)">{{ $curSpc->specialization_name }}<span class="cross">×</span></a>
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
                    @if (session()->has('FilterInstituteType'))
                      <li><a onclick="removeFilter('FilterInstituteType')"
                          href="javascript:void(0)">{{ $curInstType->type }}<span class="cross">×</span></a>
                      </li>
                    @endif
                    @if (session()->has('FilterState'))
                      <li><a onclick="removeFilter('FilterState')"
                          href="javascript:void(0)">{{ unslugify(session()->get('FilterState')) }}<span
                            class="cross">×</span></a>
                      </li>
                    @endif
                    @if (session()->has('FilterCity'))
                      <li><a onclick="removeFilter('FilterCity')"
                          href="javascript:void(0)">{{ unslugify(session()->get('FilterCity')) }}<span
                            class="cross">×</span></a>
                      </li>
                    @endif
                  </ul>
                  @if (session()->has('FilterLevel') ||
                          session()->has('FilterCategory') ||
                          session()->has('FilterSpecialization') ||
                          session()->has('FilterInstituteType') ||
                          session()->has('FilterState') ||
                          session()->has('FilterCity') ||
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
                        <img data-src="{{ asset($row->getUniversity->logo_path) }}" class="w-100"
                          alt="{{ $row->getUniversity->name }} Logo">
                      </div>

                      <div class="dashboard_single_course_caption col-lg-11 col-12">
                        <div class="dashboard_single_course_head">
                          <div class="dashboard_single_course_head_flex mt-0">
                            <h4 class="dashboard_course_title mb-1" style="font-size:20px">
                              <a href="{{ url($row->getUniversity->slug) }}">
                                {{ $row->getUniversity->name }}
                              </a>
                            </h4>
                            <div class="row">
                              <div class="col-md-12">
                                <i class="ti-location-pin"></i>
                                {{ formatLocation($row->getUniversity->city, $row->getUniversity->state, $row->getUniversity->country) }}
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
                        {{ $row->getUniversity->founded }}
                      </div>
                      <div class="col-md-3 col-6"><span class="theme-cl">Course:</span>
                        {{ $row->getUniversity->getPrograms->count() ?? 'N/A' }}</div>
                      <div class="col-md-3 col-6"><span class="theme-cl">Type:</span>
                        {{ $row->getUniversity->getInstType->type ?? 'N/A' }}
                      </div>
                      <div class="col-md-3 col-6"><span class="theme-cl">Scholarship:</span> Yes</div>
                    </div>
                    <hr>
                    <div class="row mt-1 p-2">
                      <div class="col-md-12 mb-2">
                        <div class="row">
                          <div class="col-lg-8 col-md-8 col-sm-6">
                            <h6 style="display: inline-block">
                              <a href="{{ url($row->getUniversity->slug . '/course/' . $row->program_slug) }}"
                                contenteditable="false" style="cursor: pointer;"><i
                                  class="fa fa-hand-point-right mr-1 theme-cl"></i> {{ $row->program_name }}</a>
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
                            @if ($row->getUniversity->getPrograms->count() > 0)
                              <a href="{{ url($row->getUniversity->slug . '/courses') }}" class="new-rbtn">
                                <i class="fa fa-graduation-cap"></i> All Programs
                              </a>
                            @endif
                            @if ($row->getUniversity->getReviews->count() > 0)
                              <a href="{{ url($row->getUniversity->slug . '/reviews') }}" class="new-rbtn"><i
                                  class="fa fa-star"></i> Reviews</a>
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
        <form class="form-inline addons mb-3">
          <select class="left-dropdown-filter mb-2" id="mbl_filter_country">
            @foreach ($destinations as $row)
              <option value="{{ $row->getDestination->destination_slug }}"
                {{ $row->destination_id == $destination->id ? 'selected' : '' }}>
                {{ $row->getDestination->destination_name }}
              </option>
            @endforeach
          </select>
          <div id="accordionExample" class="accordion shadow circullum full-width">
            @include('front.filter-universities')
          </div>
          <a class="btn btn-theme-2 full-width mb-2 text-white">Filter Result</a>
        </form>
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

    function ApplyFilter(slug) {
      //alert(`${col} , ${val}`);
      var baseUrl = "{{ url('/') }}";
      if (slug) {
        var redirectUrl = baseUrl + '/{{ $destination->destination_slug }}/' + slug + '-universities';
        window.location.href = redirectUrl;
      }
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

    function removeFilter(value) {
      var destination_slug = '{{ $destination->destination_slug }}';
      //alert(destination_slug);
      if (value != "") {
        $.ajax({
          url: "{{ url('course-list/remove-filter') }}",
          method: "GET",
          data: {
            value: value,
            destination_slug: destination_slug,
          },
          success: function(b) {
            window.location.replace(b);
          }
        })
      }
    }

    function removeAllFilter() {
      $.ajax({
        url: "{{ url('course-list/remove-all-filter') }}",
        method: "GET",
        success: function(b) {
          window.open(
            "{{ url($destination->destination_slug . '/' . $destination->destination_slug . '-universities/') }}",
            '_SELF');
        }
      })
    }
  </script>
@endsection
