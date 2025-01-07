@php
  use App\Models\StudentApplication;
@endphp
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
        "name": "University",
        "item": "{{ route('university.overview',['university_slug'=>$university->uname]) }}"
      }, {
        "@type": "ListItem",
        "position": 3,
        "name": "University Courses",
        "item": "{{ url()->current() }}"
      }]
    }
  </script>
  <!-- breadcrumb schema Code End -->
@endpush
@push('pagination_tag')
  @if ($npu)
    <link rel="next" href="{{ $npu }}" />
  @endif
  @if ($ppu)
    <link rel="prev" href="{{ $ppu }}" />
  @endif
@endpush
@section('main-section')
  <!-- Top header-->
  @include('front.university-profile')
  <!-- Breadcrumb -->
  <!-- Menu -->
  @include('front.university-profile-menu')
  <!-- Menu -->
  <section class="bg-light pt-4 pb-4">
    <div class="container">
      <div class="row">
        <!-- Desktop Filter -->
        <div class="col-lg-3 col-md-3 col-sm-12">
          @include('front.filter-university-profile-course-list', ['type' => 'W'])
        </div>
        <!-- Desktop Filter -->
        <div class="col-lg-9 col-md-12 col-12">
          <div class="dn db-991 mt30 mb0 show-23 mb-3">
            <div id="main2"><a href="javascript:void(0)" class="btn btn-theme filter_open" onClick="openNav()"
                id="open2">Show Filter<span class="ml-2"><i class="ti-arrow-right"></i></span></a></div>
          </div>
          <!-- all universities -->
          <div class="filter-block">
            <h4 class="mb-0"><span class="theme-cl">{{ $total }}</span> Programme offered by <span
                class="theme-cl">{{ $university->name }}</span></h4>
            <div class="portal-filter">
              <div class="heading">Filters Applied</div>
              <ul>
                @if (session()->has('UCF_level'))
                  <li><a onclick="removeFilter('UCF_level')" href="javascript:void(0)">{{ $filter_level }}<span
                        class="cross">×</span></a></li>
                @endif
                @if (session()->has('UCF_course_category'))
                  <li><a onclick="removeFilter('UCF_course_category')"
                      href="javascript:void(0)">{{ $filter_category->name }}<span class="cross">×</span></a>
                  </li>
                @endif
                @if (session()->has('UCF_specialization'))
                  <li><a onclick="removeFilter('UCF_specialization')"
                      href="javascript:void(0)">{{ $filter_specialization->name }}<span class="cross">×</span></a></li>
                @endif
                @if (session()->has('UCF_study_mode'))
                  <li><a onclick="removeFilter('UCF_study_mode')"
                      href="javascript:void(0)">{{ session()->get('UCF_study_mode') }}<span class="cross">×</span></a>
                  </li>
                @endif
              </ul>
              @if (session()->has('UCF_level') ||
                      session()->has('UCF_course_category') ||
                      session()->has('UCF_specialization') ||
                      session()->has('UCF_study_mode'))
                <a onclick="removeAllFilter()" href="javascript:void(0)" class="clearAll">Clear All</a>
              @endif
            </div>

            <h4 class="mt-3 mb-2">Showing courses based on your selection</h4>

          </div>

          <div class="dashboard_container">
            <div class="dashboard_container_body">

              @foreach ($rows as $row)
                @php
                  $study_modes = $row->study_mode != null ? json_decode($row->study_mode) : '';
                  $study_modes = $study_modes != null ? implode(', ', $study_modes) : '';
                  $exams = $row->exam_accepted != null ? json_decode($row->exam_accepted) : '';
                  $exams = $exams != null ? implode(', ', $exams) : '';
                  if (session()->has('studentLoggedIn')) {
                      $where = ['prog_id' => $row->id, 'stdid' => session()->get('student_id')];
                      $check = StudentApplication::where($where)->first();
                  }
                @endphp

                <!-- Single University -->
                <div class="dashboard_single_course pl-4 pr-4">
                  <div class="dashboard_single_course_caption pl-0 mt-0">

                    <div class="dashboard_single_course_head">
                      <div class="dashboard_single_course_head_flex">
                        <h4 class="dashboard_course_title">{{ $row->course_name }}

                          @if (session()->has('studentLoggedIn'))
                            <div id="shortlisted_mark{{ $row->id }}"
                              class="woo_buttons float-right {{ $check ? '' : 'hide-this' }}">
                              <a href="javascript:void(0)" class="btn woo_btn_light" data-toggle="tooltip"
                                data-placement="top" title="Shortlisted">
                                <i style="background-color: red" class="ti-heart"></i>
                              </a>
                            </div>

                            <div id="add_to_shortlist_mark{{ $row->id }}"
                              class="woo_buttons float-right {{ $check ? 'hide-this' : '' }}">
                              <a href="javascript:void(0)" onclick="shortlistProgram('{{ $row->id }}')"
                                class="btn woo_btn_light" data-toggle="tooltip" data-placement="top"
                                title="Add To Shortlist">
                                <i class="ti-heart"></i>
                              </a>
                            </div>
                          @endif

                        </h4>
                      </div>
                    </div>

                    <div class="row align-items-center">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-3 col-6 mt-1 mb-1"><span class="theme-cl">Study
                              Mode:</span><br>{{ $row->study_mode != '' ? $row->study_mode : 'N/A' }}</div>
                          <div class="col-md-3 col-6 mt-1 mb-1"><span class="theme-cl">App
                              deadline:</span><br>{{ $row->application_deadline != '' ? $row->application_deadline : 'N/A' }}
                          </div>
                          <div class="col-md-3 col-6 mt-1 mb-1"><span
                              class="theme-cl">Intakes:</span><br>{{ $row->intake != '' ? $row->intake : 'N/A' }}
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3 align-items-center">
                      <div class="col-md-12">
                        <a href="{{ route('university.course.details', ['university_slug' => $university->slug, 'course_slug' => $row->slug]) }}"
                          class="card-btn2">
                          View Details
                        </a>
                        @if (!session()->has('studentLoggedIn'))
                          <span class="btn btn-modern2" onclick="ApplyNow()"><span>Apply Now</span></span>
                        @else
                          @if ($check)
                            @if ($check->status == 0)
                              <span class="btn btn-modern2"
                                onClick="window.location.href = '<?php echo url('CourseController/directApply/' . $row->id); ?>';"><span>Apply
                                  Now</span></span>
                            @endif
                            @if ($check->status == 1)
                              <button style="background-color:green!important" type="button" class="shortList"><span><i
                                    class="fa fa-check"></i> Applied</span></button>
                            @endif
                          @else
                            <span class="btn btn-modern2"
                              onClick="window.location.href = '<?php echo url('CourseController/directApply/' . $row->id); ?>';"><span>Apply
                                Now</span></span>
                            </a>
                          @endif
                        @endif
                      </div>
                    </div>

                  </div>
                </div>
              @endforeach
              {!! $rows->links('pagination::bootstrap-4') !!}
            </div>
          </div>
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
        <form class="form-inline addons mb-3">
          <input class="form-control" type="search" placeholder="Search Courses" aria-label="Search">
          <button class="btn my-2 my-sm-0" type="submit"><i class="ti-search"></i></button>
        </form>
        <div id="accordionExample" class="accordion shadow circullum full-width">
          <div class="card mb-2">
            <div id="headingFive2" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
              <h6 class="mb-0 accordion_title size-xs"><a href="#" data-toggle="collapse"
                  data-target="#collapseFive2" aria-expanded="true" aria-controls="collapseFive2"
                  class="d-block position-relative text-dark collapsible-link py-2">Study Level</a></h6>
            </div>
            <div id="collapseFive2" aria-labelledby="headingFive2" data-parent="#accordionExample"
              class="collapse show">
              <div class="scrlbar">
                <div class="card-body pl-4 pr-4 pb-2">
                  <ul class="no-ul-list mb-3">
                    @foreach ($levels as $row)
                      <li>
                        <input id="level{{ $row->level }}" class="checkbox-custom" name="institute_type"
                          type="checkbox"
                          onclick="{{ session()->get('UCF_level') == $row->level ? 'removeFilter(`UCF_level`)' : 'ApplyLevelFilter(`' . $row->level . '`)' }}"
                          {{ session()->get('UCF_level') == $row->level ? 'checked' : '' }}>
                        <label for="level{{ $row->level }}"
                          class="checkbox-custom-label">{{ $row->level }}</label>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-2">
            <div id="headingSix" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
              <h6 class="mb-0 accordion_title size-xs"><a href="#" data-toggle="collapse"
                  data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix"
                  class="d-block position-relative text-dark collapsible-link py-2">Course Category</a></h6>
            </div>
            <div id="collapseSix" aria-labelledby="headingSix" data-parent="#accordionExample" class="collapse show">
              <div class="scrlbar">
                <div class="card-body pl-4 pr-4 pb-2">
                  <ul class="no-ul-list mb-3">
                    @foreach ($categories as $row)
                      <li>
                        <input id="category{{ $row->category->id }}" class="checkbox-custom" name="institute_type"
                          type="checkbox"
                          onclick="{{ session()->get('UCF_course_category') == $row->category->id ? 'removeFilter(`UCF_course_category`)' : 'ApplyCategoryFilter(`' . $row->category->id . '`)' }}"
                          {{ session()->get('UCF_course_category') == $row->category->id ? 'checked' : '' }}>
                        <label for="category{{ $row->category->id }}"
                          class="checkbox-custom-label">{{ $row->category->name }}</label>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-2">
            <div id="headingSeven" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
              <h6 class="mb-0 accordion_title size-xs"><a href="#" data-toggle="collapse"
                  data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven"
                  class="d-block position-relative text-dark collapsible-link py-2">Stream</a></h6>
            </div>
            <div id="collapseSeven" aria-labelledby="headingSeven" data-parent="#accordionExample"
              class="collapse show">
              <div class="scrlbar">
                <div class="card-body pl-4 pr-4 pb-2">
                  <ul class="no-ul-list mb-3">
                    @foreach ($specializations as $row)
                      <li>
                        <input id="spc{{ $row->getSpecialization->id }}" class="checkbox-custom" name="institute_type"
                          type="checkbox" onclick="<?php echo session()->get('UCF_specialization') == $row->getSpecialization->id ? "removeFilter('UCF_specialization')" : "ApplySpecializationFilter('" . $row->getSpecialization->id . "')";
                          ?>"
                          {{ session()->get('UCF_specialization') == $row->getSpecialization->id ? 'checked' : '' }}>
                        <label for="spc{{ $row->getSpecialization->id }}"
                          class="checkbox-custom-label">{{ $row->getSpecialization->name }}</label>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-2 hide-this">
            <div id="headingEight" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
              <h6 class="mb-0 accordion_title size-xs"><a href="#" data-toggle="collapse"
                  data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight"
                  class="d-block position-relative text-dark collapsible-link py-2">Intakes</a></h6>
            </div>
            <div id="collapseEight" aria-labelledby="headingEight" data-parent="#accordionExample"
              class="collapse show">
              <div class="scrlbar">
                <div class="card-body pl-4 pr-4 pb-2">
                  <ul class="no-ul-list mb-3">
                    <li>
                      <input id="23" class="checkbox-custom" name="23" type="checkbox">
                      <label for="23" class="checkbox-custom-label">January</label>
                    </li>
                    <li>
                      <input id="24" class="checkbox-custom" name="24" type="checkbox">
                      <label for="24" class="checkbox-custom-label">Feburary</label>
                    </li>
                    <li>
                      <input id="25" class="checkbox-custom" name="25" type="checkbox">
                      <label for="25" class="checkbox-custom-label">March</label>
                    </li>
                    <li>
                      <input id="26" class="checkbox-custom" name="26" type="checkbox">
                      <label for="26" class="checkbox-custom-label">April</label>
                    </li>
                    <li>
                      <input id="27" class="checkbox-custom" name="27" type="checkbox">
                      <label for="27" class="checkbox-custom-label">May</label>
                    </li>
                    <li>
                      <input id="28" class="checkbox-custom" name="28" type="checkbox">
                      <label for="28" class="checkbox-custom-label">June</label>
                    </li>
                    <li>
                      <input id="29" class="checkbox-custom" name="29" type="checkbox">
                      <label for="29" class="checkbox-custom-label">July</label>
                    </li>
                    <li>
                      <input id="30" class="checkbox-custom" name="30" type="checkbox">
                      <label for="30" class="checkbox-custom-label">August</label>
                    </li>
                    <li>
                      <input id="31" class="checkbox-custom" name="31" type="checkbox">
                      <label for="31" class="checkbox-custom-label">September</label>
                    </li>
                    <li>
                      <input id="32" class="checkbox-custom" name="32" type="checkbox">
                      <label for="32" class="checkbox-custom-label">October</label>
                    </li>
                    <li>
                      <input id="33" class="checkbox-custom" name="33" type="checkbox">
                      <label for="33" class="checkbox-custom-label">November</label>
                    </li>
                    <li>
                      <input id="34" class="checkbox-custom" name="34" type="checkbox">
                      <label for="34" class="checkbox-custom-label">December</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-2">
            <div id="headingNine" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
              <h6 class="mb-0 accordion_title size-xs"><a href="#" data-toggle="collapse"
                  data-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine"
                  class="d-block position-relative text-dark collapsible-link py-2">Study Mode</a></h6>
            </div>
            <div id="collapseNine" aria-labelledby="headingNine" data-parent="#accordionExample"
              class="collapse show">
              <div class="scrlbar">
                <div class="card-body pl-4 pr-4 pb-2">
                  <ul class="no-ul-list mb-3">
                    @foreach ($studyModes as $row)
                      <li>
                        <input id="sm{{ $row->id }}" class="checkbox-custom" name="institute_type"
                          type="checkbox" onclick="<?php echo session()->get('UCF_study_mode') == $row->study_mode ? " removeFilter('UCF_study_mode')" : "ApplyFilter('UCF_study_mode','" . $row->study_mode . "')"; ?>"
                          {{ session()->get('UCF_study_mode') == $row->study_mode ? 'checked' : '' }}>
                        <label for="sm{{ $row->id }}"
                          class="checkbox-custom-label">{{ $row->study_mode }}</label>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
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
  <script>
    function ApplyLevelFilter(val) {
      //alert(val);
      $.ajax({
        url: "{{ url('university-course-list/level') }}",
        method: "GET",
        data: {
          level: val
        },
        success: function(result) {
          //alert(result);
          location.reload(true);
          //window.open("{{ url('university/' . $university->slug) }}" + "/" + result, '_SELF');
        }
      })
    }

    function ApplyCategoryFilter(val) {
      //alert(val);
      $.ajax({
        url: "{{ url('university-course-list/category') }}",
        method: "GET",
        data: {
          course_category_id: val
        },
        success: function(result) {
          //alert(result);
          location.reload(true);
          //window.open("{{ url($university->slug . '/') }}" + "/" + result, '_SELF');
        }
      })
    }

    function ApplySpecializationFilter(val) {
      //alert(val);
      $.ajax({
        url: "{{ url('university-course-list/specialization') }}",
        method: "GET",
        data: {
          specialization_id: val
        },
        success: function(result) {
          //alert(result);
          location.reload(true);
          //window.open("{{ url($university->slug . '/') }}" + "/" + result, '_SELF');
        }
      })
    }

    function ApplyFilter(col, val) {
      //alert(`${col} , ${val}`);
      $.ajax({
        url: "{{ url('university-course-list/apply-filter') }}",
        method: "GET",
        data: {
          col: col,
          val: val,
        },
        success: function(result) {
          //alert(result);
          //window.open("{{ url($university->slug . '/') }}"+ "/courses", '_SELF');
          location.reload(true);
        }
      })
    }


    function removeFilter(a) {
      //alert(a);
      if (a != "") {
        $.ajax({
          url: "{{ url('university-course-list/remove-filter') }}",
          method: "GET",
          data: {
            value: a
          },
          success: function(b) {
            window.open("{{ url('university/' . $university->slug . '/courses/') }}", '_SELF');
          }
        })
      }
    }

    function removeAllFilter() {
      $.ajax({
        url: "{{ url('university-course-list/remove-all-filter') }}",
        method: "GET",
        success: function(b) {
          window.open("{{ url('university/' . $university->slug . '/courses/') }}", '_SELF');
        }
      })
    }

    function applyProgram(program_id, btn_id) {
      //alert(id);
      return new Promise(function(resolve, reject) {
        $("#" + btn_id).text('Applying...');
        $.ajax({
          url: "{{ url('/student/apply-program') }}",
          method: "GET",
          data: {
            program_id: program_id,
          },
          success: function(data) {
            //alert(data);
            $("#" + btn_id).attr('class', 'btn btn-success');
            $("#" + btn_id).text('Applied');
          }
        }).fail(err => {
          $("#" + btn_id).attr('class', 'btn btn-danger');
          $("#" + btn_id).text('Failed');
        });
      });
    }

    function shortlistProgram(program_id) {
      //alert(id);
      return new Promise(function(resolve, reject) {
        //$("#" + btn_id).text('Applying...');
        $.ajax({
          url: "{{ url('/student/shortlist-program') }}",
          method: "GET",
          data: {
            program_id: program_id,
          },
          success: function(data) {
            //alert(data);
            $("#shortlisted_mark" + program_id).show();
            $("#add_to_shortlist_mark" + program_id).hide();
          }
        }).fail(err => {
          // $("#" + btn_id).attr('class', 'btn btn-danger');
          // $("#" + btn_id).text('Failed');
        });
      });
    }
  </script>
@endsection
