@php
  use App\Models\AppliedProgram;
  if (session()->has('studentLoggedIn')) {
      $where = ['program_id' => $program->id, 'student_id' => session()->get('student_id')];
      $check = AppliedProgram::where($where)->count();
  } else {
      $check = 0;
  }
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
  <section class="bg-light pt-4 pb-4">
    <div class="container">
      <div class="row">

        <div class="col-lg-8 col-md-8">
          <x-FrontResultNotification></x-FrontResultNotification>
          <!-- Course details -->

          <div class="edu_wraper">

            <h2 class="course-new-title pl-3">{{ $program->course_name }} Fees Structure, Admission, Intake, Deadline</h2>

            <div class="row align-items-center mx-auto">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4 col-12 mt-2 mb-2">
                    <div class="row">
                      <div class="col-lg-3 col-2 course-icon-new"><i class="ti-flag-alt"></i></div>
                      <div class="col-lg-9 col-10"><span class="theme-cl">Study Mode:</span><span
                          class="course-new-sc">{{ ucwords($program->study_mode) }}</span></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-12 mt-2 mb-2">
                    <div class="row">
                      <div class="col-lg-3 col-2 course-icon-new"><i class="ti-time"></i></div>
                      <div class="col-lg-9 col-10"><span class="theme-cl">Duration:</span><span
                          class="course-new-sc">{{ $program->duration }}</span></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-12 mt-2 mb-2">
                    <div class="row">
                      <div class="col-lg-3 col-2 course-icon-new"><i class="ti-files"></i></div>
                      <div class="col-lg-9 col-10"><span class="theme-cl">Level:</span><span
                          class="course-new-sc">{{ $program->level }}</span></div>
                    </div>
                  </div>

                  <div class="col-md-4 col-12 mt-2 mb-2">
                    <div class="row">
                      <div class="col-lg-3 col-2 course-icon-new"><i class="ti-medall-alt"></i></div>
                      <div class="col-lg-9 col-10"><span class="theme-cl">Exam Accepted:</span><span
                          class="course-new-sc">{{ j2s($program->exam_accepted ?? null) }}</span></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-12 mt-2 mb-2">
                    <div class="row">
                      <div class="col-lg-3 col-2 course-icon-new"><i class="ti-calendar"></i></div>
                      <div class="col-lg-9 col-10"><span class="theme-cl">Intake:</span><span
                          class="course-new-sc">{{ $program->intake }}</span></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-12 mt-2 mb-2">
                    <div class="row">
                      <div class="col-lg-3 col-2 course-icon-new"><i class="ti-money"></i></div>
                      <div class="col-lg-9 col-10"><span class="theme-cl">Tuition Fees:</span><span
                          class="course-new-sc">{{ $program->tution_fees ?? 'N/A' }}</span></div>
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
              GET DETAILS ON FEE, ADMISSION, INTAKE
              @if (session()->has('studentLoggedIn'))
                @if ($check > 0)
                  <a id="applyBtn1" href="javascript:void()"
                    class="btn btn-theme-2 ml-2 rounded rounded-circle">Applied</a>
                @else
                  <a id="applyBtn1" href="javascript:void()" onclick="applyProgram('{{ $program->id }}','applyBtn1')"
                    class="btn btn-theme-2 ml-2 rounded rounded-circle">APPLY NOW</a>
                @endif
              @else
                <a href="{{ url('/sign-in/?return_to=' . $path . '&program_id=' . $program->id) }}"
                  class="btn btn-theme-2 ml-2 rounded rounded-circle" style="border:0px">APPLY NOW</a>
              @endif
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

          <div id="accordionExample" class="accordion shadow circullum mt-4">
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
                    data-parent="#accordionExample" class="collapse">
                    <div class="card-body pl-4 pr-4">
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                          <div class="arrow_slide two_slide-dots arrow_middle">
                            <div class="singles_items">
                              <div class="box content">
                                <h3>
                                  {{ $ucc->tab_title }} of {{ $program->course_name }} in {{ $university->name }}
                                  Malaysia
                                </h3>
                                {!! $ucc->description !!}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>

          <div id="accordionExample" class="accordion shadow circullum mt-4">
            @if ($similarPrograms->count() > 0)
              <div class="card">
                <div id="headingFive" class="card-header bg-white shadow-sm border-0">
                  <h6 class="mb-0 accordion_title title-accord">
                    <a href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
                      aria-controls="collapseFive"
                      class="d-block position-relative collapsed text-dark collapsible-link py-2">
                      Similar Programs
                    </a>
                  </h6>
                </div>
                <div id="collapseFive" aria-labelledby="headingFive" data-parent="#accordionExample"
                  class="collapse show">
                  <div class="card-body pl-4 pr-4">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                        <div class="arrow_slide two_slide-dots arrow_middle">
                          @foreach ($similarPrograms as $tu)
                            <div class="singles_items">
                              <div class="education_block_grid style_2 mb-3">
                                <div class="education_block_body mb-0">
                                  <div class="row align-items-center mb-2 mx-auto mt-3">
                                    <div class="col-3">
                                      <div class="path-img border-primary border rounded p-2">
                                        <img data-src="{{ asset($tu->university->imgpath) }}" class="img-fluid rounded"
                                          alt="">
                                      </div>
                                    </div>
                                    <div class="col-9">
                                      <h6 class="mb-1">{{ $tu->university->name }}</h6>
                                      <i class="ti-location-pin mr-2"></i>{{ $tu->university->city }},
                                      {{ $tu->university->state }}<br />
                                      <i class="ti-eye mr-2"></i>{{ $tu->university->instituteType->type ?? 'N/A' }}
                                    </div>
                                  </div>
                                </div>

                                <div class="education_block_footer pl-3 pr-3">
                                  <div class="col-md-7 col-xs-12">
                                    <h3>
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

                                  <a href="{{ route('university.overview', ['university_slug' => $tu->slug]) }}"
                                    class="card-btn mr-3" style="font-size:13px">View
                                    detials</a>
                                  <a href="{{ route('university.courses', ['university_slug' => $tu->slug]) }}"
                                    class="card-btn" style="font-size:13px">View
                                    courses</a>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          </div>

          <div class="card">
            <div class="card-header">
              <h3>{{ $university->name }} Popular Courses</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-2 top-streams">Top Streams:</div>
                <div class="col-md-10">
                  @foreach ($universtySpecializationsForCourses as $row)
                    <span onclick="goToUniPrograms('{{ $university->uname }}', '{{ $row->id }}')"
                      style="display: inline-block; margin: 0px 3px 10px 0px; border: 1px solid #535353; border-radius: 20px; padding: 4px 10px; cursor: pointer;">
                      {{ $row->name }}
                    </span>
                  @endforeach
                  <a style="display: inline-block; margin: 0px 3px 10px 0px; border: 1px solid #535353; border-radius: 20px; padding: 4px 10px; cursor: pointer;"
                    target="_blank" href="{{ url('university/' . $university->uname . '/courses') }}"
                    class="btn btn-sm btn-primary">View All</a>
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
                <div class="col-md-2 top-streams">Top Streams:</div>
                <div class="col-md-10">
                  @foreach ($randomSpecializations as $row)
                    <a style="display: inline-block; margin: 0px 3px 10px 0px; border: 1px solid #535353; border-radius: 20px; padding: 4px 10px; cursor: pointer;"
                      target="_blank" href="{{ url($row->slug . '-courses') }}">{{ $row->name }}</a>
                  @endforeach
                  <a style="display: inline-block; margin: 0px 3px 10px 0px; border: 1px solid #535353; border-radius: 20px; padding: 4px 10px; cursor: pointer;"
                    target="_blank" href="{{ url('courses-in-malaysia') }}" class="btn btn-sm btn-primary">View
                    All</a>
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
                <div class="col-md-2 top-streams">Top Streams:</div>
                <div class="col-md-10">
                  @foreach ($specializationsWithContents as $row)
                    <a style="display: inline-block; margin: 0px 3px 10px 0px; border: 1px solid #535353; border-radius: 20px; padding: 4px 10px; cursor: pointer;"
                      target="_blank"
                      href="{{ route('specialization.detail', ['slug' => $row->slug]) }}">{{ $row->name }}</a>
                  @endforeach
                  <a style="display: inline-block; margin: 0px 3px 10px 0px; border: 1px solid #535353; border-radius: 20px; padding: 4px 10px; cursor: pointer;"
                    target="_blank" href="{{ url('specialization') }}" class="btn btn-sm btn-primary">View
                    All</a>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 col-md-4">
          @if ($trendingUniversity->count() > 0)
            <div class="ed_view_box style_2">
              <div class="ed_author">
                <div class="ed_author_box">
                  <h4>Affilated Colleges</h4>
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
          @include('front.forms.university-side-form')
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
  </script>
@endsection
