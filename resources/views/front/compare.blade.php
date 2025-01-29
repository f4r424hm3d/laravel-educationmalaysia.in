@php
  use App\Models\StudentApplication;
  use App\Helpers\UniversityProgramListButton;
@endphp
@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@section('main-section')
  <!-- Content -->
  <link rel='stylesheet' id='wb-table-grid-public-css-css'
    href='{{ url('/') }}/front/assets/compare/wb-table-grid-public.css' type='text/css' media='all' />
  <link rel='stylesheet' id='style-responsive-css' href='{{ url('/') }}/front/assets/compare/style-responsive.css'
    type='text/css' media='all' />
  <link rel='stylesheet' id='style-custom-css' href='{{ url('/') }}/front/assets/compare/style-custom.css'
    type='text/css' media='all' />

  <link rel='stylesheet' id='searchwp-live-search-css' href='{{ url('/') }}/front/assets/compare/style.css'
    type='text/css' media='all' />
  <link rel='stylesheet' id='tablepress-default-css'
    href='{{ url('/') }}/front/assets/compare/tablepress-combined.min.css' type='text/css' media='all' />
  <script type='text/javascript' src='{{ url('/') }}/front/assets/compare/jquery.js'></script>
  <script type='text/javascript' src='{{ url('/') }}/front/assets/compare/jquery-migrate.min.js'></script>
  <script type='text/javascript' src='{{ url('/') }}/front/assets/compare/wb-table-grid-public.js'></script>
  <div class="gdlr-content">
    <div class="image-cover ed_detail_head lg"
      style="background:url(https://educationmalaysia.in/front/assets/img/ub.jpg);" data-overlay="8">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12 col-md-12">
            <div class="ed_detail_wrap light">
              <div class="compare-header">
                <div class="container">
                  <form method="get">
                    <h2>Discover the best Universities in the Malaysia</h2>
                    <div class="row">
                      <div class="col-md-4">
                        <select id="level" name="level" required>
                          <option value="">Select Level</option>
                          @foreach ($levels as $row)
                            <option value="{{ $row->level }}">{{ $row->level }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-4">
                        <select id="course_category" name="course_category" required>
                          <option value="">Select Course Category</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <select id="specialization" name="specialization" required>
                          <option value="">Select Specialization</option>
                        </select>
                      </div>
                    </div>
                    <span class="text-danger" id="errDiv" style="display:none;">Please select all fields.</span>
                    <center class="mt-4">
                      <button type="submit" class="btn btn-modern-compare float-none">
                        Compare University <span><i class="ti-reload mr-0"></i></span>
                      </button>
                    </center>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="main-content-container container gdlr-item-start-content">
      <div class="gdlr-item gdlr-main-content text-center">
        <h1>Find & Compare Courses in Malaysia</h1>
        <h3 style="font-weight: normal;">
          Gain practical & industry-specific knowledge in the field of Accounting through a course. Learn more about each
          institution’s and find out which college / university suits you best.
        </h3>
        <div class="clear"></div>
        <div class="gdlr-space"></div>
        @if ($programs != null)
          <div>

            <div class="WBGridPublic-table">
              <div class="WBGridPublic-arrow">
                <button class="WBGridArrow-preview"><i class="ti-arrow-left"></i></button>
              </div>

              <div class="WBGridPublic-content">
                <div class="WBGridContent-table">
                  <div class="WBGridSidebar">
                    <ul>
                      <div class="WBGridTable-topRow">

                        <li class="WBGridTable-data toprow column1-row1">
                          <div class="WBGridTable-middle"><span></span></div>
                        </li>
                        <li class="WBGridTable-data toprow column1-row2">
                          <div class="WBGridTable-middle"><span></span></div>
                        </li>
                        <li class="WBGridTable-data toprow column1-row3">
                          <div class="WBGridTable-middle"><span></span></div>
                        </li>
                      </div>

                      <li class="column1-row4">
                        <div class="WBGridTable-middle">
                          <span><strong>Qualification</strong></span>
                        </div>
                      </li>
                      <li class="column1-row5">
                        <div class="WBGridTable-middle">
                          <span><strong>Campus</strong></span>
                        </div>
                      </li>
                      <li class="column1-row6">
                        <div class="WBGridTable-middle">
                          <span><strong>Intakes</strong></span>
                        </div>
                      </li>
                      <li class="column1-row7">
                        <div class="WBGridTable-middle">
                          <span><strong>Course Duration</strong></span>
                        </div>
                      </li>
                      <li class="column1-row8">
                        <div class="WBGridTable-middle">
                          <span><strong>Entry Requirements</strong></span>
                        </div>
                      </li>
                      <li class="column1-row9">
                        <div class="WBGridTable-middle">
                          <span><strong>Total Estimated Fees</strong></span>
                        </div>
                      </li>
                      <li class="column1-row10">
                        <div class="WBGridTable-middle">
                          <span><strong>Exam Required</strong></span>
                        </div>
                      </li>
                      <li class="column1-row11">
                        <div class="WBGridTable-middle">
                          <span><strong>Study Mode</strong></span>
                        </div>
                      </li>
                      <li class="column1-row12">
                        <div class="WBGridTable-middle">
                          <span><strong>Mode Of Instruction</strong></span>
                        </div>
                      </li>
                      <li class="column1-row13">
                        <div class="WBGridTable-middle">
                          <span><strong>Scholarships</strong></span>
                        </div>
                      </li>
                      <li class="column1-row11">
                        <div class="WBGridTable-middle"><span></span>
                        </div>

                      </li>
                    </ul>
                  </div>

                  <div class="WBGridContent">
                    <div class="WBGridContent-hidden">
                      <div class="WBGridContent-hiddenWidth">

                        @foreach ($programs as $row)
                          <ul class="WBGridContent-cell">

                            <div class="WBGridTable-topRow">
                              <li class="WBGridTable-data toprow column2-row1">
                                <div class="WBGridTable-middle">
                                  <span>
                                    <div class="WBGridTable-content">
                                      <a href="{{ url('university/' . $row->university->uname) }}" target="_blank">
                                        <img data-src="{{ asset($row->university->logo_path) }}" alt="Logo" />
                                      </a>
                                    </div>
                                  </span>
                                </div>
                              </li>
                              <li class="WBGridTable-data toprow column2-row2">
                                <div class="WBGridTable-middle">
                                  <span>
                                    <div class="WBGridTable-content">
                                      <div style="margin:8px;">
                                        <strong>{{ $row->university->name }}</strong>
                                      </div>
                                    </div>
                                  </span>
                                </div>
                              </li>
                              <li class="WBGridTable-data toprow column2-row3">
                                <div class="WBGridTable-middle">
                                  <span>
                                    <div class="WBGridTable-content wbGrids-button">
                                      {!! UniversityProgramListButton::getApplyButton($row->id, 'gdlr-button small') !!}
                                    </div>
                                  </span>
                                </div>
                              </li>
                            </div>

                            <li class="WBGridTable-data column2-row4">
                              <div class="WBGridTable-middle">
                                <span>
                                  <div class="WBGridTable-title">
                                    <strong>Qualification</strong>
                                  </div>
                                  <div class="WBGridTable-content">{{ $row->program_name }}</div>
                                </span>
                              </div>
                            </li>
                            <li class="WBGridTable-data column2-row5">
                              <div class="WBGridTable-middle">
                                <span>
                                  <div class="WBGridTable-title">
                                    <strong>Campus</strong>
                                  </div>
                                  <div class="WBGridTable-content">{{ $row->university->city }},
                                    {{ $row->university->state }}</div>
                                </span>
                              </div>
                            </li>
                            <li class="highlight column2-row6">
                              <div class="WBGridTable-middle">
                                <span>
                                  <div class="WBGridTable-title">
                                    <strong>Intakes</strong>
                                  </div>
                                  <div class="WBGridTable-content">{{ json_to_string($row->intake) ?? 'N/A' }}</div>
                                </span>
                              </div>
                            </li>
                            <li class="WBGridTable-data column2-row7">
                              <div class="WBGridTable-middle">
                                <span>
                                  <div class="WBGridTable-title">
                                    <strong>Course Duration</strong>
                                  </div>
                                  <div class="WBGridTable-content">{{ $row->duration }}</div>
                                </span>
                              </div>
                            </li>
                            <li class="WBGridTable-data column2-row8">
                              <div class="WBGridTable-middle">
                                <span>
                                  <div class="WBGridTable-title">
                                    <strong>Entry Requirements</strong>
                                  </div>
                                  <div class="WBGridTable-content">
                                    N/A</div>
                                </span>
                              </div>
                            </li>
                            <li class="highlight column2-row9">
                              <div class="WBGridTable-middle">
                                <span>
                                  <div class="WBGridTable-title">
                                    <strong>Total Estimated Fees</strong>
                                  </div>
                                  <div class="WBGridTable-content">
                                    0</div>
                                </span>
                              </div>
                            </li>
                            <li class="WBGridTable-data column2-row10">
                              <div class="WBGridTable-middle">
                                <span>
                                  <div class="WBGridTable-title">
                                    <strong>Exam Required</strong>
                                  </div>
                                  <div class="WBGridTable-content">{{ json_to_string($row->exam_accepted) ?? 'N/A' }}
                                  </div>
                                </span>
                              </div>
                            </li>
                            <li class="WBGridTable-data column2-row11">
                              <div class="WBGridTable-middle">
                                <span>
                                  <div class="WBGridTable-title">
                                    <strong>Study Mode</strong>
                                  </div>
                                  <div class="WBGridTable-content">{{ $row->study_mode }}</div>
                                </span>
                              </div>
                            </li>
                            <li class="WBGridTable-data column2-row12">
                              <div class="WBGridTable-middle">
                                <span>
                                  <div class="WBGridTable-title">
                                    <strong>Mode Of Instruction</strong>
                                  </div>
                                  <div class="WBGridTable-content">
                                    N/A</div>
                                </span>
                              </div>
                            </li>
                            <li class="WBGridTable-data column2-row13">
                              <div class="WBGridTable-middle">
                                <span>
                                  <div class="WBGridTable-title">
                                    <strong>Scholarships</strong>
                                  </div>
                                  <div class="WBGridTable-content">
                                    N/A</div>
                                </span>
                              </div>
                            </li>
                            <li class="WBGridTable-data column2-row14">
                              <div class="WBGridTable-middle">
                                <span>
                                  <div class="WBGridTable-content wbGrids-button">
                                    {!! UniversityProgramListButton::getApplyButton($row->id, 'gdlr-button small') !!}
                                  </div>
                                </span>
                              </div>
                            </li>
                            <li class="WBGrid-lessMoreButton">
                              <button>MORE</button>
                            </li>
                          </ul>
                        @endforeach

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="WBGridPublic-arrow">
                <button class="WBGridArrow-next"><i class="fa fa-angle-right"></i></button>
              </div>
            </div>
          </div>
          <div class="clear"></div>
        @endif
      </div>
    </div>
  </div>
  <!-- Content -->
  <script>
    function applyProgram(program_id) {
      //alert(id);
      return new Promise(function(resolve, reject) {
        $(".apply-btn" + program_id).text('Applying...');
        $.ajax({
          url: "{{ url('/student/apply-program') }}",
          method: "GET",
          data: {
            program_id: program_id,
          },
          success: function(data) {
            //alert(data);
            $(".apply-btn" + program_id).text('Applied');
          }
        }).fail(err => {
          // $(".apply-btn" + program_id).text('Failed');
        });
      });
    }

    $(document).ready(function() {
      $('#level').on('change', function(event) {
        var level = $('#level').val();
        //alert(level);
        $.ajax({
          url: "{{ url('compare/get-category-by-level') }}",
          method: "GET",
          data: {
            level: level
          },
          success: function(result) {
            //alert(result);
            $('#course_category').html(result);
          }
        })
      });
      $('#course_category').on('change', function(event) {
        var course_category = $('#course_category').val();
        var level = $('#level').val();
        $.ajax({
          url: "{{ url('compare/get-spc-by-level-and-category') }}",
          method: "GET",
          data: {
            course_category_id: course_category,
            level: level
          },
          success: function(result) {
            //alert(result);
            $('#specialization').html(result);
          }
        })
      });
    });
  </script>
@endsection
