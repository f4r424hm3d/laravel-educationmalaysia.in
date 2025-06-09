@php
  use App\Models\StudentApplication;
  use App\Helpers\UniversityProgramListButton;
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
        "name": "Select University",
        "item": "{{ route('select.university') }}"
      }, {
        "@type": "ListItem",
        "position": 3,
        "name": "University",
        "item": "{{ route('university.overview',['university_slug'=>$university->uname]) }}"
      }, {
        "@type": "ListItem",
        "position": 4,
        "name": "University Courses",
        "item": "{{ route('university.courses',['university_slug'=>$university->uname]) }}"
      }, {
        "@type": "ListItem",
        "position": 5,
        "name": "Courses",
        "item": "{{ url()->current() }}"
      }]
    }
  </script>
  <!-- breadcrumb schema Code End -->
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  @include('front.university-profile')
  <!-- Breadcrumb -->
  <!-- Menu -->
  @include('front.university-profile-menu')
  <!-- Menu -->
  <!-- Content -->
  <section class="bg-light py-5 program-profiledd ">
    <div class="container">
      <div class="row">

        <div class="col-lg-8 col-md-12">
          <x-FrontResultNotification></x-FrontResultNotification>
          <!-- Course details -->

          <div class="edu_wraper">

            <h2 class="course-new-title">{{ $program->course_name }} Fees Structure, Admission, Intake, Deadline</h2>

            <div class="row align-items-center mx-auto">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
                    <div class="row">
                      <div class="col-lg-3 col-md-12 col-sm-12 col-12 course-icon-new mb-3"><i class="ti-flag-alt"></i>
                      </div>
                      <div class="col-lg-9 col-md-12 col-sm-12 col-12 mb-3"><span class="theme-cl">Study Mode:</span><span
                          class="course-new-sc">{{ ucwords($program->study_mode) }}</span></div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
                    <div class="row">
                      <div class="col-lg-3 col-md-12 col-sm-12 col-12 course-icon-new mb-3"><i class="ti-time"></i></div>
                      <div class="col-lg-9 col-md-12 col-sm-12 col-12 mb-3"><span class="theme-cl">Duration:</span><span
                          class="course-new-sc">{{ $program->duration }}</span></div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
                    <div class="row">
                      <div class="col-lg-3 col-md-12 col-sm-12 col-12 course-icon-new mb-3"><i class="ti-files"></i></div>
                      <div class="col-lg-9 col-md-12 col-sm-12 col-12 mb-3"><span class="theme-cl">Level:</span><span
                          class="course-new-sc">{{ $program->level }}</span></div>
                    </div>
                  </div>

                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
                    <div class="row">
                      <div class="col-lg-3 col-md-12 col-sm-12 col-12 course-icon-new mb-3"><i class="ti-medall-alt"></i>
                      </div>
                      <div class="col-lg-9 col-md-12 col-sm-12 col-12 mb-3"><span class="theme-cl">Exam
                          Accepted:</span><span class="course-new-sc">{{ j2s($program->exam_accepted ?? null) }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
                    <div class="row">
                      <div class="col-lg-3 col-md-12 col-sm-12 col-12 course-icon-new mb-3"><i class="ti-calendar"></i>
                      </div>
                      <div class="col-lg-9 col-md-12 col-sm-12 col-12 mb-3"><span class="theme-cl">Intake:</span><span
                          class="course-new-sc">{{ $program->intake }}</span></div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
                    <div class="row">
                      <div class="col-lg-3 col-md-12 col-sm-12 col-12 course-icon-new mb-3"><i class="ti-money"></i></div>
                      <div class="col-lg-9 col-md-12 col-sm-12 col-12 mb-3"><span class="theme-cl">Tuition
                          Fees:</span><span class="course-new-sc">{{ $program->tution_fees ?? 'N/A' }}</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          @if ($program->intake != null)
            @php
              $intakeArr = explode(',', $program->intake);
              $appDeadlineArr = explode(',', $program->application_deadline);
            @endphp

            @if (count($intakeArr) == count($appDeadlineArr))
              @php
                $finalIntake = array_combine($intakeArr, $appDeadlineArr);
              @endphp
              <table class="table table-sm">
                <tr>
                  <td>
                    <table>
                      <tr>
                        <th>Intake</th>
                        <th>Deadline</th>
                      </tr>
                      @foreach ($finalIntake as $key => $value)
                        <tr>
                          <td>{{ $key != null ? $key : 'N/A' }}</td>
                          <td>{{ $value != null ? $value : 'N/A' }}</td>
                        </tr>
                      @endforeach
                    </table>
                  </td>
                </tr>
              </table>
            @endif

            @if ($program->overview != null)
              <!-- Overview -->
              <div class="edu_wraper">
                <div class="show-more-box">
                  <div class="text show-more-height">
                    <h2 class="edu_title">Course Overview</h2>
                    {!! $program->overview !!}
                  </div>
                  <div class="show-more">(Show More)</div>
                </div>
              </div>
            @endif
          @endif
          <div class="edu_wraper p-3">
            <!-- Call to action -->
            <div class="justify-content-center align-content-center text-center font-weight-bold">
              {!! UniversityProgramListButton::getApplyButton($program->id, 'btn btn-theme-2 ml-2 rounded rounded-circle') !!}
              <a href="{{ route('university.courses', ['university_slug' => $university->uname]) }}"
                class="btn btn-theme-2 ml-2 rounded rounded-circle" style="border:0px">View all courses</a>
            </div>
          </div>

          @if ($program->intake != null)
            <div class="edu_wraper">
              <h2 class="course-new-title pl-3 mb-0">Course Intake</h2>
              <div class="row">
                <div class="col-md-12 col-12">
                  <div class="course-intake">
                    @php
                      // Convert comma-separated string into an array and trim any whitespace
                      $intakeArray = array_map('strtolower', array_map('trim', explode(',', $program->intake)));
                    @endphp
                    @foreach ($months as $row)
                      @php
                        // Check for matches in both short and full month names
                        $shortNameMatch = in_array(strtolower($row->month_short_name), $intakeArray);
                        $fullNameMatch = in_array(strtolower($row->month_full_name), $intakeArray);
                      @endphp
                      <span class="{{ $shortNameMatch || $fullNameMatch ? 'active' : '' }}">
                        {{ $row->month_short_name }}
                      </span>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          @endif

          @if ($program->overview != null)
            <div class="edu_wraper">
              <h2 class="course-new-title mb-2">Course Overview</h2>
              <div class="row align-items-center">
                <div class="col-md-12">
                  <div class="course-new-sc">
                    {!! $program->overview !!}
                  </div>
                </div>
              </div>
            </div>
          @endif

          <div id="accordionExample" class="accordion shadow circullum mt-3 program-accordian ">
            @if ($program->contents->count() > 0)
              @foreach ($program->contents as $ucc)
                <div class="card">
                  <div id="headingFive{{ $ucc->id }}" class="card-header bg-white shadow-sm border-0">
                    <h6 class="mb-0 accordion_title title-accord"><a href="#" data-toggle="collapse"
                        data-target="#collapseFive{{ $ucc->id }}" aria-expanded="false"
                        aria-controls="collapseFive{{ $ucc->id }}"
                        class="d-block position-relative collapsed text-dark collapsible-link py-2">{{ $ucc->tab_title }}</a>
                    </h6>
                  </div>
                  <div id="collapseFive{{ $ucc->id }}" aria-labelledby="headingFive{{ $ucc->id }}"
                    data-parent="#accordionExample" class="collapse show">
                    <div class="card-body pl-4 pr-4 ">
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                          <!-- <div class="arrow_slide two_slide-dots arrow_middle">   -->
                          <div class="singles_items">
                            <div class="boxcontent">
                              <h3>
                                {{ $ucc->tab_title }} of {{ $program->course_name }} in {{ $university->name }}
                                Malaysia
                              </h3>
                              {!! $ucc->description !!}
                            </div>
                          </div>
                          <!-- </div> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>

          <div id="accordionExample" class="accordion shadow circullum mt-4 program-accordian  newprogramss">
            @if ($similarPrograms->count() > 0)
              <div class="card">
                <div id="headingFive" class="card-header bg-white shadow-sm border-0">
                  <h6 class="mb-0 accordion_title title-accord">
                    <a href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
                      aria-controls="collapseFive"
                      class="d-block position-relative collapsed text-dark collapsible-link py-2 removed-icon">
                      Similar Programs
                    </a>
                  </h6>
                </div>
                <div id="collapseFive" aria-labelledby="headingFive" data-parent="#accordionExample"
                  class="collapse show">
                  <div class="card-body pt-3">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                        <!-- <div class="arrow_slide two_slide-dots arrow_middle"> -->
                        @foreach ($similarPrograms as $tu)
                          <div class="singles_items">
                            <div class="education_block_grid style_2 mb-3 all-programss">
                              <div class="education_block_body mb-0">
                                <div class="row align-items-center mx-auto ">
                                  <div class="col-12 col-sm-12 col-md-3 mb-3">
                                    <div class="path-img">
                                      <img data-src="{{ asset($tu->university->imgpath) }}" class="img-fluid rounded"
                                        alt="">
                                    </div>
                                  </div>
                                  <div class="col-12 col-sm-12 col-md-9 mb-3">
                                    <h6 class="mb-1">{{ $tu->university->name }}</h6>
                                    <ul class="loc-rating">
                                      <li class="loc ">
                                        <i class="ti-location-pin mr-2"></i>{{ $tu->university->city }}
                                      </li>
                                      <li class="loc">
                                        <i class="ti-location-pin mr-2"></i>{{ $tu->university->state }}
                                      </li>
                                      <li class="loc">
                                        <i class="ti-eye mr-2"></i>{{ $tu->university->instituteType->type ?? 'N/A' }}
                                      </li>
                                    </ul>

                                  </div>
                                </div>
                              </div>

                              <div class="education_block_fo ">
                                <div class="row mx-auto align-items-center">
                                  <div class="col-12 col-sm-12 col-md-7 col-lg-7 mb-4">
                                    <h3 class="h3-progrmsn mb-2">
                                      <a
                                        href="{{ url('university/' . $tu->university->uname . '/course/' . $tu->slug) }}">
                                        {{ $tu->course_name }}
                                      </a>
                                    </h3>
                                    <div class="aminities">
                                      <?php echo $tu->duration; ?>
                                      <span></span>
                                      <?php echo $tu->study_mode; ?>
                                      <span></span>
                                      <?php echo $tu->intake; ?>
                                    </div>
                                  </div>
                                  <div class="col-12 col-sm-12 col-md-5 col-lg-5 mb-4">
                                    <div class="d-flex align-items-center set-gap justify-content-end ">
                                      <a href="{{ route('university.course.details', ['university_slug' => $tu->university->uname, 'course_slug' => $tu->slug]) }}"
                                        class="btn btn-primary">View
                                        detials</a>
                                      <a href="{{ route('university.courses', ['university_slug' => $tu->university->uname]) }}"
                                        class="btn btn-primary">View
                                        courses</a>
                                    </div>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        @endforeach
                        <!-- </div> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          </div>

          <div class="multi-streams">
            <div class="card">
              <div class="card-header">
                <h3>{{ $university->name }} Popular Courses</h3>
              </div>
              <div class="card-body">
                <div class="row ">
                  <div class="col-12 col-sm-12 col-md-2 mb-4 ">
                    <h2 class="top-streams">
                      Top Streams:
                    </h2>
                  </div>
                  <div class=" col-12 col-sm-12 col-md-10 mb-4">
                    <div class="multi-options">
                      <ul>

                        @foreach ($universtySpecializationsForCourses as $row)
                          <li><span class="spanstream"
                              onclick="goToUniPrograms('{{ $university->uname }}', '{{ $row->id }}')">
                              {{ $row->name }}
                            </span></li>
                        @endforeach
                        <li> <a target="_blank" href="{{ url('university/' . $university->uname . '/courses') }}"
                            class="btn btn-sm btn-primary span-linames">View All</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3>Malaysia Popular Courses</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-sm-12 col-md-2 mb-4 ">
                    <h2 class="top-streams">
                      Top Streams:
                    </h2>
                  </div>
                  <div class=" col-12 col-sm-12 col-md-10 mb-4">
                    <div class="multi-options">
                      <ul>
                        @foreach ($randomSpecializations as $row)
                          <li>
                            <a class="spanstream" target="_blank"
                              href="{{ url($row->slug . '-courses') }}">{{ $row->name }}</a>
                          </li>
                        @endforeach
                        <li>
                          <a target="_blank" href="{{ url('courses-in-malaysia') }}"
                            class="btn btn-sm btn-primary span-linames">View
                            All</a>
                        </li>
                      </ul>

                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3>Top Courses to Study in Malaysia</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-sm-12  col-md-2 mb-3 ">
                    <h2 class="top-streams">
                      Top Streams:
                    </h2>
                  </div>
                  <div class="col-12 col-sm-12 col-md-10 mb-3">
                    <div class="multi-options">
                      <ul>
                        @foreach ($specializationsWithContents as $row)
                          <li>
                            <a class="spanstream" target="_blank"
                              href="{{ route('specialization.detail', ['slug' => $row->slug]) }}">{{ $row->name }}</a>
                          </li>
                        @endforeach
                        <li>

                          <a target="_blank" href="{{ url('specialization') }}"
                            class="btn btn-sm btn-primary span-linames">View
                            All</a>
                        </li>
                      </ul>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 col-md-12">
          @include('front.forms.university-side-form')
          @if ($trendingUniversity->count() > 0)
            <div class="ed_view_box style_2">
              <div class="ed_author">
                <div class="ed_author_box">
                  <h4>Featured Universities</h4>
                </div>
              </div>

              @foreach ($trendingUniversity as $uni)
                <div class="learnup-list">
                  <div class="learnup-list-thumb">
                    <a href="{{ route('university.overview', ['university_slug' => $uni->slug]) }}">
                      <img data-src="{{ asset($uni->imgpath) }}" class="img-fluid" alt="{{ $uni->name }}">
                    </a>
                  </div>
                  <div class="learnup-list-caption">
                    <h6><a
                        href="{{ route('university.overview', ['university_slug' => $uni->slug]) }}">{{ $uni->name }}</a>
                    </h6>
                    <p class="mb-0"><i class="ti-location-pin"></i> {{ $uni->city }}, {{ $uni->state }}</p>
                    <div class="learnup-info">
                      <span class="mr-3">
                        <a href="{{ route('university.overview', ['university_slug' => $uni->slug]) }}"><i
                            class="fa fa-edit"></i> Admission</a>
                      </span>
                      <span>
                        <a href="{{ route('university.courses', ['university_slug' => $uni->slug]) }}"><i
                            class="fa fa-graduation-cap"></i> Programme</a>
                      </span>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @endif
          <div class="ed_view_box style_2">
            <div class="ed_author">
              <div class="ed_author_box">
                <h4>Find Universities Courses</h4>
              </div>
            </div>

            <a class="learnup-list" href="{{ url('courses/pre-university') }}">
              <div class="learnup-list-thumb">

                <img data-src="{{ cdn('assets') }}/web/images/fuc-icons/pre-university.png" class="img-fluid"
                  alt="Pre University">

              </div>
              <div class="learnup-list-caption">
                <h6>
                  <p>Certificate Course in Malaysia </p>
                </h6>
              </div>
            </a>
            <a href="{{ url('courses/diploma') }}" class="learnup-list">
              <div class="learnup-list-thumb">

                <img data-src="{{ cdn('assets') }}/web/images/fuc-icons/diploma.png" class="img-fluid"
                  alt="Pre University">

              </div>
              <div class="learnup-list-caption">
                <h6>
                  <p>Diploma Course in Malaysia </p>
                </h6>
              </div>
            </a>
            <a class="learnup-list" href="{{ url('courses/under-graduate') }}">
              <div class="learnup-list-thumb">

                <img data-src="{{ cdn('assets') }}/web/images/fuc-icons/under-graduate.png" class="img-fluid"
                  alt="Pre University">

              </div>
              <div class="learnup-list-caption">
                <h6>
                  <p>Bachelor Course in Malaysia </p>
                </h6>
              </div>
            </a>
            <a class="learnup-list" href="{{ url('courses/post-graduate') }}">
              <div class="learnup-list-thumb">

                <img data-src="{{ cdn('assets') }}/web/images/fuc-icons/post-graduate.png" class="img-fluid"
                  alt="Pre University">

              </div>
              <div class="learnup-list-caption">
                <h6>
                  <p>Master Degree in Malaysia </p>
                </h6>
              </div>
            </a>
            <a class="learnup-list" href="{{ url('courses/phd') }}">
              <div class="learnup-list-thumb">

                <img data-src="{{ cdn('assets') }}/web/images/fuc-icons/phd.png" class="img-fluid"
                  alt="Pre University">

              </div>
              <div class="learnup-list-caption">
                <h6>
                  <p>PHD Courses in Malaysia </p>
                </h6>
              </div>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- Content -->
  <script>
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

    function goToUniPrograms(uname, specializationId) {
      if (specializationId != '') {
        $.ajax({
          url: "{{ url('university-course-list/specialization') }}",
          method: "GET",
          data: {
            specialization_id: specializationId
          },
          success: function(data) {
            window.open("{{ url('university/') }}/" + uname + "/courses", "_blank");
          }
        });
      }
    }
  </script>
@endsection
