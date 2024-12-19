@extends('front.layouts.main')
@push('seo_meta_tag')
@include('front.layouts.dynamic_page_meta_tag')
@endpush
@section('main-section')
<!-- Top header-->
@include('front.university-profile')
<!-- Breadcrumb -->
<!-- Menu -->
@include('front.university-profile-menu')
<!-- Menu -->
<!-- Content -->
<br>
<section class="bg-light pt-0 pb-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12">
        <form class="form-inline addons hide-23 mb-2">
          <input class="form-control img-fluid" type="search" placeholder="Search Courses" aria-label="Search">
          <button class="btn my-2 my-sm-0" type="submit"><i class="ti-search"></i></button>
        </form>
        <div id="accordionExample" class="accordion shadow circullum hide-23 full-width">
          <div class="card mb-2">
            <div id="headingOne" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
              <h6 class="mb-0 accordion_title size-xs"><a href="#" data-toggle="collapse" data-target="#collapseOne"
                  aria-expanded="true" aria-controls="collapseOne"
                  class="d-block position-relative text-dark collapsible-link py-2">Study Level</a></h6>
            </div>
            <div id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample" class="collapse show">
              <div class="scrlbar">
                <div class="card-body pl-4 pr-4 pb-2">
                  <ul class="no-ul-list mb-3">
                    @foreach($levels as $row)
                    <li>
                      <input id="level{{ $row->getLevel->id }}" class="checkbox-custom" name="institute_type"
                        type="checkbox" onclick="<?php echo  session()->get('USF_level')==$row->getLevel->id ? "
                        removeFilter('USF_level')":"ApplyLevelFilter('".$row->getLevel->id."')" ?>" {{
                      session()->get('USF_level')==$row->getLevel->id?'checked':'' }} >
                      <label for="level{{ $row->getLevel->id }}" class="checkbox-custom-label">{{ $row->getLevel->level
                        }}</label>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-9 col-md-12 col-12">
        <div class="dn db-991 mt30 mb0 show-23 mb-3">
          <div id="main2"><a href="javascript:void(0)" class="btn btn-theme filter_open" onClick="openNav()"
              id="open2">Show Filter<span class="ml-2"><i class="ti-arrow-right"></i></span></a></div>
        </div>
        <!-- all universities -->
        <div class="filter-block">
          <h4 class="mb-0"><span class="theme-cl">{{ $total }}</span> Scholarship offered by <span class="theme-cl">
              {{ $university->name }}
            </span></h4>
          <div class="portal-filter">
            <div class="heading">Filters Applied</div>
            <ul>
              @if (session()->has('USF_level'))
              <li><a onclick="removeFilter('USF_level')" href="javascript:void(0)">{{ $filter_level->level }}<span
                    class="cross">×</span></a></li>
              @endif
            </ul>
            @if (session()->has('USF_level') || session()->has('USF_course_category')
            ||session()->has('USF_specialization') || session()->has('USF_study_mode'))
            <a onclick="removeAllFilter()" href="javascript:void(0)" class="clearAll">Clear All</a>
            @endif
          </div>
        </div>
        <div class="dashboard_container">
          <div class="dashboard_container_body">
            <div class="dashboard_single_course align-items-center pt-3 pb-2">
              <h4 class="mb-0">Showing Scholarship based on your selection</h4>
            </div>

            @foreach ($rows as $row)
            <!-- Single University -->
            <div class="dashboard_single_course pl-4 pr-4">
              <div class="dashboard_single_course_caption pl-0">
                <div class="dashboard_single_course_head">
                  <div class="dashboard_single_course_head_flex">
                    <h4 class="dashboard_course_title"><a
                        href="{{ url($university->slug.'/scholarship/'.$row->scholarship_slug) }}">{{
                        $row->scholarship_name
                        }}</a>
                    </h4>
                  </div>
                </div>
                <div class="row align-items-center">
                  <div class="col-md-9">
                    <div class="row">
                      <div class="col-md-3 col-6 mt-1 mb-1">Amount:<br><strong>{{ $row->amount }}</strong></div>
                      <div class="col-md-3 col-6 mt-1 mb-1">Level:<br><strong>{{ $row->getLevel->level }}</strong></div>
                      <div class="col-md-3 col-6 mt-1 mb-1">No of Scholarship:<br><strong>
                          {{ $row->number_of_scholarship }}
                        </strong></div>
                      <div class="col-md-3 col-6 mt-1 mb-1">international Student Eligible:<br>
                        <strong>{{ $row->international_student_eligible }}</strong>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <a href="{{ url($university->slug.'/scholarship/'.$row->scholarship_slug) }}"
                      class="btn btn-modern">View
                      Details<span><i class="ti-arrow-right"></i></span></a>
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
      <!-- Search Form -->
      <form class="form-inline addons mb-3">
        <input class="form-control" type="search" placeholder="Search Courses" aria-label="Search">
        <button class="btn my-2 my-sm-0" type="submit"><i class="ti-search"></i></button>
        <div id="accordionExample" class="accordion shadow circullum full-width">
          <div class="card mb-2">
            <div id="headingFive2" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
              <h6 class="mb-0 accordion_title size-xs"><a href="#" data-toggle="collapse" data-target="#collapseFive2"
                  aria-expanded="true" aria-controls="collapseFive2"
                  class="d-block position-relative text-dark collapsible-link py-2">Study Level</a></h6>
            </div>
            <div id="collapseFive2" aria-labelledby="headingFive2" data-parent="#accordionExample"
              class="collapse show">
              <div class="scrlbar">
                <div class="card-body pl-4 pr-4 pb-2">
                  <ul class="no-ul-list mb-3">
                    <li>
                      <input id="1" class="checkbox-custom" name="1" type="checkbox">
                      <label for="1" class="checkbox-custom-label">Certificate</label>
                    </li>
                    <li>
                      <input id="2" class="checkbox-custom" name="2" type="checkbox">
                      <label for="2" class="checkbox-custom-label">Pre University</label>
                    </li>
                    <li>
                      <input id="3" class="checkbox-custom" name="3" type="checkbox">
                      <label for="3" class="checkbox-custom-label">Diploma</label>
                    </li>
                    <li>
                      <input id="4" class="checkbox-custom" name="4" type="checkbox">
                      <label for="4" class="checkbox-custom-label">Under Graduate</label>
                    </li>
                    <li>
                      <input id="5" class="checkbox-custom" name="5" type="checkbox">
                      <label for="5" class="checkbox-custom-label">Post Graduate</label>
                    </li>
                    <li>
                      <input id="6" class="checkbox-custom" name="5" type="checkbox">
                      <label for="6" class="checkbox-custom-label">P.hd</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-2">
            <div id="headingSix" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
              <h6 class="mb-0 accordion_title size-xs"><a href="#" data-toggle="collapse" data-target="#collapseSix"
                  aria-expanded="true" aria-controls="collapseSix"
                  class="d-block position-relative text-dark collapsible-link py-2">Course Category</a></h6>
            </div>
            <div id="collapseSix" aria-labelledby="headingSix" data-parent="#accordionExample" class="collapse show">
              <div class="scrlbar">
                <div class="card-body pl-4 pr-4 pb-2">
                  <ul class="no-ul-list mb-3">
                    <li>
                      <input id="7" class="checkbox-custom" name="7" type="checkbox">
                      <label for="7" class="checkbox-custom-label">Applied and Pure Sciences</label>
                    </li>
                    <li>
                      <input id="8" class="checkbox-custom" name="8" type="checkbox">
                      <label for="8" class="checkbox-custom-label">Business and Management</label>
                    </li>
                    <li>
                      <input id="9" class="checkbox-custom" name="9" type="checkbox">
                      <label for="9" class="checkbox-custom-label">Certificate</label>
                    </li>
                    <li>
                      <input id="10" class="checkbox-custom" name="10" type="checkbox">
                      <label for="10" class="checkbox-custom-label">Engineering</label>
                    </li>
                    <li>
                      <input id="11" class="checkbox-custom" name="11" type="checkbox">
                      <label for="11" class="checkbox-custom-label">Foundation</label>
                    </li>
                    <li>
                      <input id="12" class="checkbox-custom" name="12" type="checkbox">
                      <label for="12" class="checkbox-custom-label">Health and Medicine</label>
                    </li>
                    <li>
                      <input id="13" class="checkbox-custom" name="13" type="checkbox">
                      <label for="13" class="checkbox-custom-label">MBA</label>
                    </li>
                    <li>
                      <input id="14" class="checkbox-custom" name="14" type="checkbox">
                      <label for="14" class="checkbox-custom-label">NEWFOUNDLAND & LABRADOR- [3]</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-2">
            <div id="headingSeven" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
              <h6 class="mb-0 accordion_title size-xs"><a href="#" data-toggle="collapse" data-target="#collapseSeven"
                  aria-expanded="true" aria-controls="collapseSeven"
                  class="d-block position-relative text-dark collapsible-link py-2">Stream</a></h6>
            </div>
            <div id="collapseSeven" aria-labelledby="headingSeven" data-parent="#accordionExample"
              class="collapse show">
              <div class="scrlbar">
                <div class="card-body pl-4 pr-4 pb-2">
                  <ul class="no-ul-list mb-3">
                    <li>
                      <input id="15" class="checkbox-custom" name="15" type="checkbox">
                      <label for="15" class="checkbox-custom-label">Accounting & Finance</label>
                    </li>
                    <li>
                      <input id="16" class="checkbox-custom" name="16" type="checkbox">
                      <label for="16" class="checkbox-custom-label">Anatomy</label>
                    </li>
                    <li>
                      <input id="17" class="checkbox-custom" name="17" type="checkbox">
                      <label for="17" class="checkbox-custom-label">Biochemistry</label>
                    </li>
                    <li>
                      <input id="18" class="checkbox-custom" name="18" type="checkbox">
                      <label for="18" class="checkbox-custom-label">Bioinformatics</label>
                    </li>
                    <li>
                      <input id="19" class="checkbox-custom" name="19" type="checkbox">
                      <label for="19" class="checkbox-custom-label">Biomedical Sciences</label>
                    </li>
                    <li>
                      <input id="20" class="checkbox-custom" name="20" type="checkbox">
                      <label for="20" class="checkbox-custom-label">Biotechnology</label>
                    </li>
                    <li>
                      <input id="21" class="checkbox-custom" name="21" type="checkbox">
                      <label for="21" class="checkbox-custom-label">Business</label>
                    </li>
                    <li>
                      <input id="22" class="checkbox-custom" name="22" type="checkbox">
                      <label for="22" class="checkbox-custom-label">Dentistry</label>
                    </li>
                    <li>
                      <input id="23" class="checkbox-custom" name="23" type="checkbox">
                      <label for="23" class="checkbox-custom-label">Electrical & E. Engineering</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-2">
            <div id="headingEight" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
              <h6 class="mb-0 accordion_title size-xs"><a href="#" data-toggle="collapse" data-target="#collapseEight"
                  aria-expanded="true" aria-controls="collapseEight"
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
              <h6 class="mb-0 accordion_title size-xs"><a href="#" data-toggle="collapse" data-target="#collapseNine"
                  aria-expanded="true" aria-controls="collapseNine"
                  class="d-block position-relative text-dark collapsible-link py-2">Study Mode</a></h6>
            </div>
            <div id="collapseNine" aria-labelledby="headingNine" data-parent="#accordionExample" class="collapse show">
              <div class="scrlbar">
                <div class="card-body pl-4 pr-4 pb-2">
                  <ul class="no-ul-list mb-3">
                    <li>
                      <input id="35" class="checkbox-custom" name="35" type="checkbox">
                      <label for="35" class="checkbox-custom-label">Full Time</label>
                    </li>
                    <li>
                      <input id="36" class="checkbox-custom" name="36" type="checkbox">
                      <label for="36" class="checkbox-custom-label">Part Time</label>
                    </li>
                    <li>
                      <input id="36" class="checkbox-custom" name="36" type="checkbox">
                      <label for="36" class="checkbox-custom-label">By Research Work</label>
                    </li>
                    <li>
                      <input id="37" class="checkbox-custom" name="37" type="checkbox">
                      <label for="37" class="checkbox-custom-label">By Course Work</label>
                    </li>
                    <li>
                      <input id="38" class="checkbox-custom" name="38" type="checkbox">
                      <label for="38" class="checkbox-custom-label">Mix Mode</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
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
<script>
  function ApplyLevelFilter(val) {
    //alert(val);
    $.ajax({
      url: "{{ url('university-scholarship-list/level') }}",
      method: "GET",
      data: {
        level_id: val
      },
      success: function(result) {
        //alert(result);
        location.reload(true);
        //window.open("{{ url($university->slug.'/') }}"+ "/" + result, '_SELF');
      }
    })
  }
  function ApplyCategoryFilter(val) {
    //alert(val);
    $.ajax({
      url: "{{ url('university-scholarship-list/category') }}",
      method: "GET",
      data: {
        course_category_id: val
      },
      success: function(result) {
        //alert(result);
        window.open("{{ url($university->slug.'/') }}"+ "/" + result, '_SELF');
      }
    })
  }
  function ApplySpecializationFilter(val) {
    //alert(val);
    $.ajax({
      url: "{{ url('university-scholarship-list/specialization') }}",
      method: "GET",
      data: {
        specialization_id: val
      },
      success: function(result) {
        //alert(result);
        window.open("{{ url($university->slug.'/') }}"+ "/" + result, '_SELF');
      }
    })
  }

  function ApplyFilter(col,val) {
    //alert(`${col} , ${val}`);
    $.ajax({
      url: "{{ url('university-scholarship-list/apply-filter') }}",
      method: "GET",
      data: {
        col: col,
        val: val,
      },
      success: function(result) {
        //alert(result);
        //window.open("{{ url($university->slug.'/') }}"+ "/courses", '_SELF');
        location.reload(true);
      }
    })
  }


  function removeFilter(a) {
    //alert(a);
    if (a != "") {
      $.ajax({
        url: "{{ url('university-scholarship-list/remove-filter') }}",
        method: "GET",
        data: {
          value: a
        },
        success: function(b) {
          window.open("{{ url($university->slug.'/scholarship/') }}", '_SELF');
        }
      })
    }
  }
  function removeAllFilter() {
    $.ajax({
      url: "{{ url('university-scholarship-list/remove-all-filter') }}",
      method: "GET",
      success: function(b) {
        window.open("{{ url($university->slug.'/scholarship/') }}", '_SELF');
      }
    })
  }
</script>
@endsection