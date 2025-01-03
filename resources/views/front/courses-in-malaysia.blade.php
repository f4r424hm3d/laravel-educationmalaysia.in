@php
  use App\Models\StudentApplication;
  use App\Helpers\UniversityProgramListButton;
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
        <div class="col-xl-3 col-lg-3 col-md-12 col-12">
          <div id="accordionExample" class="accordion shadow circullum hide-23 full-width accord-mobile">
            @include('front.filter-courses-in-malaysia')
          </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-12">
          <div class="row align-items-center mb-3">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="forms-found">
              Found <strong>{{ $total }}</strong> programs
              <p>{!! $page_contents !!}</p>
              </div>
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
            <div class="text-right desktop-hide ml-auto px-3">
            <button type="button" class="btn btn-modern2 univ-btn reviews-btn rounded" data-toggle="modal" data-target="#exampleModalCenter">
  Filter show
</button>
            </div>
          </div>
          <!-- all universities -->
          <div class="dashboard_container">
            <div class="dashboard_container_body">
              @if ($rows->count() > 0)
                @foreach ($rows as $row)
                  <!-- Single University -->

                  <div class="dashboard_single_course align-items-center d-block">
                    <div class="row">
                      <div class="col-lg-10 pr-md-0">
                        <div class="row">
                          <div class="col-lg-2 col-md-3 col-sm-4 col-12 mb-4">
                            <div class="divimg">
                              <img data-src="{{ asset($row->university->imgpath) }}" class="img-fluid"
                                alt="{{ $row->university->name }} Logo">
                            </div>
                          </div>

                          <div class="col-lg-10 col-md-9 col-sm-8 col-12 mb-4">
                            <div class="dashboard_single_course_caption ">
                              <div class="dashboard_single_course_head">
                                <div class="dashboard_single_course_head_flex mt-0">
                                  <h4 class="dashboard_course_title mb-1" style="font-size:20px">
                                    <a
                                      href="{{ route('university.overview', ['university_slug' => $row->university->uname]) }}">
                                      {{ $row->university->name }}
                                    </a>
                                  </h4>
                                  <div class="d-flex setgap2 align-items-center locationsloc">
                                  <i class="ti-location-pin"></i>
                                  {{ formatLocation($row->university->city, $row->university->state, $row->university->country) }}
                                  </div>
                                </div>

                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4 col-12">
                                <div class="flex-wrap align-items-center setgap2 block-desktop">
                                <span class="theme-cl ">Institute Type : </span>
                                <span class="duratinss">{{ $row->university->instituteType->type }} </span>
                                </div>
                              </div>
                              <div class="col-md-4 col-12">
                              <div class="flex-wrap align-items-center setgap2 block-desktop">
                                <span class="theme-cl">Course : </span>
                                <span class="duratinss"> {{ $row->university->programs->count() ?? 'N/A' }}</span>

                                @if ($row->university->programs->count() > 0)
                                  <a href="{{ route('university.courses', ['university_slug' => $row->university->uname]) }}"
                                    class="new-rbtn">
                                    <i class="fa fa-graduation-cap"></i> All Programs
                                  </a>
                                @endif
                                </div>
                              </div>
                              <div class="col-md-4 col-12">
                              <div class="flex-wrap align-items-center setgap2 block-desktop">
                                <span class="theme-cl">World Ranking : </span>

                                <span class="duratinss">{{ $row->university->rank ?? 'N/A' }}</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-2">
                        <div class="dc_head_right">
                          <div class="dropdown">
                            {!! UniversityProgramListButton::getApplyButton($row->id) !!}
                          </div>
                        </div>
                      </div>
                    </div>

                    <hr>
                    <div class="row">
                      <div class="col-lg-10 col-md-9 col-sm-12">
                        <h6 class="bachlors">
                          <a class="d-flex align-items-center " href="{{ route('university.course.details', ['university_slug' => $row->university->uname, 'course_slug' => $row->slug]) }}"
                            contenteditable="false" style="cursor: pointer;">
                            <i class="fa fa-hand-point-right mr-1 theme-cl"></i> 
                            {{ $row->course_name }}
                          </a>
                        </h6>
                        <div class="row">
                          <div class="col-md-4 col-sm-4 col-12 ">
                          <div class="flex-wrap align-items-center setgap2 block-desktop">
                          <span class="theme-cl">
                          Mode:</span>{{ $row->study_mode }}
                          </div>
                          
                            </div>
                          <div class="col-md-4 col-sm-4 col-12 ">
                          <div class="flex-wrap align-items-center setgap2 block-desktop">
                          <span class="theme-cl">Duration:</span> <span
                              class="duratinss">
                              {{ $row->duration }}
                            </span>
                          </div>
  
                          
                          </div>
                          <div class="col-md-4 col-sm-4 col-12">
                          <div class="flex-wrap align-items-center setgap2 block-desktop">
                          <span class="theme-cl">Intakes:</span>

<span class="duratinss">
  {{ $row->intake }}
</span>
                          </div>
  
                          
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-3 col-sm-12">
                        <a href="{{ route('university.course.details', ['university_slug' => $row->university->uname, 'course_slug' => $row->slug]) }}"
                          class="btn btn-modern2 univ-btn reviews-btn">View Detail</a>
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

<!-- study level filter modal   -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal modal-filter-set fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Filter Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body study-filters">
      <div id="accordionExample1" class="accordion shadow circullum hide-23 full-width  ">
            @include('front.filter-courses-in-malaysia')
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
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
