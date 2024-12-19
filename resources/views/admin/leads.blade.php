@php

@endphp
@extends('admin.layouts.main')
@push('title')
  <title>{{ $page_title }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
  <div class="page-content">
    <div class="container-fluid">

      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $page_title }}</h4>

            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ aurl() }}">Home</a></li>
                <li class="breadcrumb-item active">{{ $page_title }}</li>
              </ol>
            </div>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <!-- NOTIFICATION FIELD START -->
          <x-ResultNotificationField></x-ResultNotificationField>
          <!-- NOTIFICATION FIELD END -->
        </div>
      </div>
      <!-- end page title -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body" id="tblCDiv">
              <form class="needs-validation" method="get" enctype="multipart/form-data" novalidate>
                <div class="row">
                  <div class="col-md-6 col-sm-12 mb-3">
                    <div class="form-group">
                      <label>Search University by Name, City, State and Country</label>
                      <input name="search" id="search" type="text" class="form-control"
                        placeholder="Search University by Name, City, State and Country"
                        value="{{ $_GET['search'] ?? '' }}" required>
                      <span class="text-danger" id="search-err">
                        @error('search')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <button class="btn btn-sm btn-primary setBtn" type="submit">Search</button>
                    <a href="{{ aurl('leads') }}" class="btn btn-sm btn-warning setBtn"><i class="ti-trash"></i>
                      Reset</a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-info setBtn" id="advSearchBtn">
                      <i class="ti-trash"></i> Advance Search
                    </a>
                  </div>
                </div>
              </form>
              <div class="{{ $filterApplied == true ? '' : 'hide-this' }}" id="advSearchForm">
                <hr>
                <form class="needs-validation" method="get" enctype="multipart/form-data" novalidate>
                  <div class="row">
                    <div class="col-md-3 col-sm-12 mb-3">
                      <div class="form-group">
                        <label>From</label>
                        <input type="date" name="from" id="from"
                          value="{{ isset($_GET['from']) && $_GET['from'] ? $_GET['from'] : '' }}" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <div class="form-group">
                        <label>To</label>
                        <input type="date" name="to" id="to"
                          value="{{ isset($_GET['to']) && $_GET['to'] ? $_GET['to'] : '' }}" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <div class="form-group">
                        <label>Nationality</label>
                        <select name="nationality" id="nationality" class="form-control js-example-basic-singl">
                          <option value="">Select</option>
                          @foreach ($filterNationality as $row)
                            <option value="{{ $row->nationality }}"
                              {{ isset($_GET['nationality']) && $_GET['nationality'] == $row->nationality ? 'selected' : '' }}>
                              {{ $row->nationality }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <div class="form-group">
                        <label>Course Category</label>
                        <select name="intrested_course_category" id="intrested_course_category"
                          class="form-control js-example-basic-singl">
                          <option value="">Select</option>
                          @foreach ($filterCC as $row)
                            <option value="{{ $row->intrested_course_category }}"
                              {{ isset($_GET['intrested_course_category']) && $_GET['intrested_course_category'] == $row->intrested_course_category ? 'selected' : '' }}>
                              {{ $row->intrested_course_category }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <div class="form-group">
                        <label>Level</label>
                        <select name="current_qualification_level" id="current_qualification_level"
                          class="form-control js-example-basic-singl">
                          <option value="">Select</option>
                          @foreach ($filterLevel as $row)
                            <option value="{{ $row->current_qualification_level }}"
                              {{ isset($_GET['current_qualification_level']) && $_GET['current_qualification_level'] == $row->current_qualification_level ? 'selected' : '' }}>
                              {{ $row->current_qualification_level }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <div class="form-group">
                        <label>Source</label>
                        <select name="source" id="source" class="form-control js-example-basic-singl">
                          <option value="">Select</option>
                          @foreach ($filterSources as $row)
                            <option value="{{ $row->source }}"
                              {{ isset($_GET['source']) && $_GET['source'] == $row->source ? 'selected' : '' }}>
                              {{ $row->source }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <button class="btn btn-sm btn-primary setBtn advSearchBtn" type="submit">Search</button>
                      <a href="{{ aurl('leads') }}" class="btn btn-sm btn-warning setBtn"><i class="ti-trash"></i>
                        Reset</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <div style="float:left;">
                <label>
                  Show
                  <select name="limit_per_page" id="limit_per_page" class="">
                    @foreach ($lpp as $lpp)
                      <option value="{{ $lpp }}" {{ $limit_per_page == $lpp ? 'selected' : '' }}>
                        {{ $lpp }}</option>
                    @endforeach
                  </select>
                  entries
                </label>
                <select name="order_by" id="order_by">
                  @foreach ($orderColumns as $key => $value)
                    <option value="{{ $value }}" <?php echo $order_by == $value ? 'selected' : ''; ?>>{{ $key }}</option>
                  @endforeach
                </select>
                <select name="order_in" id="order_in">
                  <option value="ASC" {{ $order_in == 'ASC' ? 'selected' : '' }}>ASC</option>
                  <option value="DESC" {{ $order_in == 'DESC' ? 'selected' : '' }}>DESC</option>
                </select>
              </div>
              {{-- <div style="float:right;">
                <a href="{{ aurl($page_route . '/export/') }}" class="btn btn-xs btn-success">Export</a>
              </div> --}}
            </div>
            <div class="card-body">
              <table id="datatabl" class="table table-bordered dt-responsive  nowrap w-100">
                <thead>
                  <tr>
                    <th><input type="checkbox" name="check_all" id="check_all" value="" /></th>
                    <th>S.No.</th>
                    <th>Action</th>
                    <th>Date</th>
                    <th>Contact</th>
                    <th>Qualification</th>
                    <th>Intrest</th>
                    <th>Other Details</th>
                    <th>Source</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  @endphp
                  @foreach ($rows as $row)
                    <tr id="row{{ $row->id }}">
                      <td><input type="checkbox" name="selected_id[]" class="checkbox" value="{{ $row->id }}" />
                      </td>
                      <td>{{ $i }}</td>
                      <td>
                        <a href="{{ aurl('student/profile/' . $row->id) }}"
                          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
                          <i class="fa fa-user" aria-hidden="true"></i>
                        </a>

                        <a href="javascript:void()" onclick="DeleteAjax('{{ $row->id }}')"
                          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>

                        <a href="{{ url('admin/leads/update/' . $row->id) }}"
                          class="waves-effect waves-light btn btn-xs btn-outline btn-info">
                          <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>

                        {{-- <a href="javascript:void()" onclick="editInfoModelFunc('{{ $row->id }}')"
                          data-bs-toggle="modal" data-target="#updateInfoModel" data-bs-target="#DesModalScrollable"
                          class="btn btn-xs btn-primary waves-effect waves-light" title="Edit"><i
                            data-feather="edit"></i></a> --}}
                      </td>
                      <td>{{ getFormattedDate($row->created_at, 'd M Y h:i A') }}</td>
                      <td id="contactTd{{ $row->id }}">
                        <i class="fas fa-user text-danger"></i> : {{ $row->name }} <br>
                        <i class="fas fa-mobile text-danger"></i> : {{ $row->mobile }} <br>
                        <i class="fas fa-mail-bulk text-danger"></i> : {{ $row->email }}
                      </td>
                      <td>
                        <b>Level</b> : {{ $row->current_qualification_level }} <br>
                      </td>
                      <td>
                        <b>Course Category</b> : {{ $row->intrested_course_category }} <br>
                      </td>
                      <td>
                        <b>{{ colToStr('degree_planning_to_study') }}</b> : {{ $row->degree_planning_to_study }} <br>
                        <b>{{ colToStr('year_planning_to_study') }}</b> : {{ $row->year_planning_to_study }} <br>
                        <b>{{ colToStr('intrested_in_paid_counselling') }}</b> :
                        {{ $row->intrested_in_paid_counselling }} <br>
                        <b>{{ colToStr('preferred_counselling_date') }}</b> :
                        {{ getFormattedDate($row->preferred_counselling_date, '(D), d M, Y') }}
                        <br>
                        <b>{{ colToStr('preferred_counselling_time') }}</b> :
                        {{ getFormattedDate($row->preferred_counselling_time, 'h:i A') }}
                        <br>
                        <b>{{ colToStr('study_abroad_journey_status') }}</b> : {{ $row->study_abroad_journey_status }}
                        <br>
                        <b>{{ colToStr('preferred_destination') }}</b> : {{ $row->preferred_destination }}
                        <br>
                        <b>{{ colToStr('source_path') }}</b> : {{ $row->source_path }}
                        <br>
                      </td>
                      <td>
                        <span class="badge bg-success">{{ $row->source }}</span>
                      </td>
                    </tr>
                    @php
                      $i++;
                    @endphp
                  @endforeach
                </tbody>
              </table>

              {!! $rows->links('pagination::bootstrap-5') !!}
              {{-- <select name="c_pagenum" id="c_pagenum" onchange="myfunction(this.value)">
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                <option value="<?php echo $i; ?>">
                  <?php echo $i; ?>
                </option>
                <?php } ?>
              </select> --}}
            </div>
            <hr>
            <div class="card-body">
              <div class="hide-this w100 float-left sbmtBtndiv" id="submitBtn">
                <a onclick="bulkDelete()" href="javascript:void()" data-toggle="tooltip"
                  class="btn btn-sm btn-outlin btn-danger" value="delete" title="Click to delete">Delete</a>

                {{-- <a onclick="bulkUpdate('status','1')" href="javascript:void()" data-toggle="tooltip"
                  class="btn btn-sm btn-outline btn-success" title="Active">
                  Active
                </a>

                <a onclick="bulkUpdate('status','0')" href="javascript:void()" data-toggle="tooltip"
                  class="btn btn-sm btn-outline btn-danger" title="Inactive">
                  Inactive
                </a> --}}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('admin.update-student-info')
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).ready(function() {
      $('.advSearchBtn').click(function() {
        // Remove empty fields before form submission
        $('select').each(function() {
          if ($(this).val() == '') {
            $(this).prop('disabled', true);
          }
        });
      });
    });

    // ORDER BY, LIMIT PER PAGE
    $(document).ready(function() {
      $('#limit_per_page').change(function() {
        var selectedValue = $(this).val(); // Get the selected value
        var currentUrl = new URL(window.location.href); // Get the current URL
        var searchParams = currentUrl.searchParams;
        // Update or set the 'limit_per_page' query parameter
        searchParams.set('limit_per_page', selectedValue);
        // Update the URL by replacing the existing query string
        currentUrl.search = searchParams.toString();
        // Reload the page with the updated URL
        window.location.href = currentUrl.href;
      });
      $('#order_by').change(function() {
        var selectedValue = $(this).val(); // Get the selected value
        var currentUrl = new URL(window.location.href); // Get the current URL
        var searchParams = currentUrl.searchParams;
        // Update or set the 'order_by' query parameter
        searchParams.set('order_by', selectedValue);
        // Update the URL by replacing the existing query string
        currentUrl.search = searchParams.toString();
        // Reload the page with the updated URL
        window.location.href = currentUrl.href;
      });
      $('#order_in').change(function() {
        var selectedValue = $(this).val(); // Get the selected value
        var currentUrl = new URL(window.location.href); // Get the current URL
        var searchParams = currentUrl.searchParams;
        // Update or set the 'order_in' query parameter
        searchParams.set('order_in', selectedValue);
        // Update the URL by replacing the existing query string
        currentUrl.search = searchParams.toString();
        // Reload the page with the updated URL
        window.location.href = currentUrl.href;
      });
      $('#advSearchBtn').click(function() {
        $('#advSearchForm').toggle();
      });
    });

    function myfunction(id1) {
      if (id1 != '') {
        window.open("{{ aurl('leads/?page=') }}" + id1, "_SELF");
      }
    }

    function changeStatus(id, col, val) {
      //alert(id);
      var tbl = 'universities';
      $.ajax({
        url: "{{ url('common/update-field') }}",
        method: "GET",
        data: {
          id: id,
          tbl: tbl,
          col: col,
          val: val
        },
        success: function(data) {
          if (data == '1') {
            //alert('status changed of ' + id + ' to ' + val);
            if (val == '1') {
              $('#a' + col + id).toggle();
              $('#i' + col + id).toggle();
            }
            if (val == '0') {
              $('#a' + col + id).toggle();
              $('#i' + col + id).toggle();
            }
          }
        }
      });
    }

    $("#search").keyup(function() {
      var value = this.value.toLowerCase().trim();
      $("table tr").each(function(index) {
        if (!index) return;
        $(this).find("td").each(function() {
          var id = $(this).text().toLowerCase().trim();
          var not_found = (id.indexOf(value) == -1);
          $(this).closest('tr').toggle(!not_found);
          return not_found;
        });
      });
    });

    $(document).ready(function() {
      $('#check_all').on('click', function() {
        if (this.checked) {
          $('.checkbox').each(function() {
            this.checked = true;
            $(this).closest('tr').addClass('selectedRow');
          });
        } else {
          $('.checkbox').each(function() {
            this.checked = false;
            $(this).closest('tr').removeClass('selectedRow');
          });
        }
      });
      $('.checkbox').on('click', function() {
        if ($('.checkbox:checked').length == $('.checkbox').length) {
          $('#check_all').prop('checked', true);
        } else {
          $('#check_all').prop('checked', false);
        }
      });
      $('.checkbox').on('click', function() {
        if ($('.checkbox:checked').length > 0) {
          $('#submitBtn').show();
        } else {
          $('#submitBtn').hide();
        }
      });
      $('#check_all').on('click', function() {
        if ($('.checkbox:checked').length > 0) {
          $('#submitBtn').show();
        } else {
          $('#submitBtn').hide();
        }
      });
      $('.checkbox').click(function() {
        if ($(this).is(':checked')) {
          $(this).closest('tr').addClass('selectedRow');
        } else {
          $(this).closest('tr').removeClass('selectedRow');
        }
      });
    });

    // DELETE BULK
    function bulkDelete() {
      var deleteConfirm = confirm("Are you sure?");
      if (deleteConfirm == true) {
        var tbl = 'students';
        var users_arr = [];
        $(".checkbox:checked").each(function() {
          var userid = $(this).val();
          users_arr.push(userid);
        });
        $.ajax({
          url: "{{ url('common/bulk-delete') }}",
          type: 'get',
          data: {
            ids: users_arr,
            tbl: tbl
          },
          success: function(response) {
            location.reload(true);
          }
        });
      }
    }

    function DeleteAjax(id) {
      //alert(id);
      var cd = confirm("Are you sure ?");
      if (cd == true) {
        $.ajax({
          url: "{{ url('admin/leads/delete') }}" + "/" + id,
          success: function(data) {
            if (data == '1') {
              getData();
              getTabs();
              var h = 'Success';
              var msg = 'Record deleted successfully';
              var type = 'success';
              $('#row' + id).remove();
              $('#toastMsg').text(msg);
              $('#liveToast').show();
              showToastr(h, msg, type);
            }
          }
        });
      }
    }
  </script>
@endsection
