@extends('admin.layouts.main')
@push('title')
  <title>{{ $page_title }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $page_title }}</h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
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
      <div class="row">
        <div class="col-xl-12">
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
                    <a href="{{ aurl('university') }}" class="btn btn-sm btn-warning setBtn"><i class="ti-trash"></i>
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
                        <label>State</label>
                        <select name="state" id="state" class="form-control js-example-basic-singl">
                          <option value="">Select</option>
                          @foreach ($filterStates as $row)
                            <option value="{{ $row->state }}"
                              {{ isset($_GET['state']) && $_GET['state'] == $row->state ? 'selected' : '' }}>
                              {{ $row->state }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <div class="form-group">
                        <label>City</label>
                        <select name="city" id="city" class="form-control js-example-basic-singl">
                          <option value="">Select</option>
                          @foreach ($filterCities as $row)
                            <option value="{{ $row->city }}"
                              {{ isset($_GET['city']) && $_GET['city'] == $row->city ? 'selected' : '' }}>
                              {{ $row->city }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <button class="btn btn-sm btn-primary setBtn advSearchBtn" type="submit">Search</button>
                      <a href="{{ aurl('university') }}" class="btn btn-sm btn-warning setBtn"><i class="ti-trash"></i>
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
              <div style="float:right;">
                <a href="{{ aurl($page_route . '/export/') }}" class="btn btn-xs btn-success">Export</a>
              </div>
            </div>
            <div class="card-body">
              <table id="datatabl" class="table table-bordered dt-responsive nowrap w-100">
                <thead>
                  <tr>
                    <th>
                      <input type="checkbox" name="check_all" id="check_all" value=""
                        class="check-all-chkbox filled-in chk-col-primary" />
                    </th>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Rank</th>
                    <th>Logo/Banner</th>
                    <th>Permission</th>
                    <th>SEO</th>
                    <th>Profile</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rows as $row)
                    <tr id="row{{ $row->id }}">
                      <td>
                        <input type="checkbox" name="selected_id[]" id="chk{{ $row->id }}"
                          class="checkbox check-chkbox filled-in chk-col-info" value="{{ $row->id }}" />
                        <label for="chk{{ $row->id }}">&nbsp;</label>
                      </td>
                      <td>{{ $i }}</td>
                      <td>
                        <b>Id</b> : {{ $row->id }} <br>
                        <b>Name</b> : {{ $row->name }} <br>
                        <b>Inst Type</b> : {{ $row->instituteType->type ?? 'N/A' }}
                      </td>
                      <td>
                        <b>City</b> : {{ $row->city ?? 'N/A' }} <br>
                        <b>State</b> : {{ $row->state ?? 'N/A' }}
                      </td>
                      <td>
                        <b>Rank (QS Malaysia)</b> : {{ $row->rank ?? 'N/A' }} <br>
                        <b>QS Wrold Ranking</b> : {{ $row->qs_rank ?? 'N/A' }} <br>
                        <b>The Times</b> : {{ $row->times_rank ?? 'N/A' }}
                      </td>
                      <td>
                        Logo : {!! $row->logo_path != null
                            ? '<a href="' . asset($row->logo_path) . '" target="_blank"><i class="fa fa-image" aria-hidden="true"></i></a>'
                            : 'N/A' !!} <br>
                        Banner : {!! $row->banner_path != null
                            ? '<a href="' . asset($row->banner_path) . '" target="_blank"><i class="fa fa-image" aria-hidden="true"></i></a>'
                            : 'N/A' !!}
                      </td>
                      <td id="statustd{{ $row->id }}">
                        <table class="table-sm ">
                          <tbody>
                            <tr>
                              <td>Status</td>
                              <td>
                                <x-status-field :row="$row" />
                              </td>
                            </tr>
                            <tr>
                              <td>Home View</td>
                              <td>
                                <span id="ahome_view{{ $row->id }}"
                                  class="badge bg-success {{ $row->homeview == 1 ? '' : 'hide-this' }}"
                                  onclick="changeStatus('{{ $row->id }}','homeview','0')">Active</span>
                                <span id="ihome_view{{ $row->id }}"
                                  class="badge bg-danger {{ $row->homeview == 0 ? '' : 'hide-this' }}"
                                  onclick="changeStatus('{{ $row->id }}','homeview','1')">Inactive</span>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                      <td>
                        <x-seo-view-model :row="$row" />
                      </td>
                      <td>
                        Programs : @if ($row->programs->count() > 0)
                          <a href="{{ url('admin/university-programs/' . $row->id) }}"
                            class="badge bg-success">{{ $row->programs->count() }} Programs</a>
                        @else
                          <a href="{{ url('admin/university-programs/' . $row->id) }}" class="badge bg-danger">Null</a>
                        @endif
                        <br>
                        Overview : @if ($row->overviews->count() > 0)
                          <a href="{{ url('admin/university-overview/' . $row->id) }}"
                            class="badge bg-success">{{ $row->overviews->count() }} Entry</a>
                        @else
                          <a href="{{ url('admin/university-overview/' . $row->id) }}" class="badge bg-danger">Null</a>
                        @endif
                        <br>

                      </td>
                      <td>
                        Created at : <b>{{ getFormattedDate($row->created_at, 'h:i A - d-m-Y') }}</b> <br>
                        Updated at : <b>{{ getFormattedDate($row->updated_at, 'h:i A - d-m-Y') }}</b> <br>
                      </td>
                      <td>
                        <a title="Profile" href="{{ aurl('university-overview/' . $row->id) }}"
                          class="waves-effect waves-light btn btn-xs btn-outline btn-success">
                          <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                        <a href="javascript:void()" onclick="DeleteAjax('{{ $row->id }}')"
                          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                        <a href="{{ url('admin/' . $page_route . '/update/' . $row->id) }}"
                          class="waves-effect waves-light btn btn-xs btn-outline btn-info">
                          <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                      </td>
                    </tr>
                    @php
                      $i++;
                    @endphp
                  @endforeach
                </tbody>
              </table>
              {!! $rows->links('pagination::bootstrap-5') !!}
            </div>
            <hr>
            <div class="card-body">
              <div class="hide-this w100 float-left sbmtBtndiv" id="submitBtn">
                {{-- <a onclick="bulkDelete()" href="javascript:void()" data-toggle="tooltip"
                  class="btn btn-sm btn-outlin btn-primary" value="delete" title="Click to delete">Delete</a> --}}

                <a onclick="bulkUpdate('status','1')" href="javascript:void()" data-toggle="tooltip"
                  class="btn btn-sm btn-outline btn-success" title="Active">
                  Active
                </a>

                <a onclick="bulkUpdate('status','0')" href="javascript:void()" data-toggle="tooltip"
                  class="btn btn-sm btn-outline btn-danger" title="Inactive">
                  Inactive
                </a>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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

    // CHECK ALL CHECKBOX
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

    // UPDATE BULK FIELD (STATUS)
    function bulkUpdate(col, val) {
      var tbl = 'universities';
      var users_arr = [];
      $(".checkbox:checked").each(function() {
        var userid = $(this).val();
        users_arr.push(userid);
      });
      $.ajax({
        url: "{{ url('common/update-bulk-field') }}",
        type: 'get',
        data: {
          ids: users_arr,
          val: val,
          col: col,
          tbl: tbl
        },
        success: function(response) {
          //alert(response.affected_rows);
          if (response.affected_rows > '0') {
            var h = 'Success';
            var msg = response.affected_rows + ' rows updated successfully';
            var type = 'success';
          } else {
            var h = 'Danger';
            var msg = 'Not any record updated';
            var type = 'danger';
          }
          showToastr(h, msg, type);
          if (col == 'status' && val == 1) {
            $('tr.selectedRow span.active_status').show();
            $('tr.selectedRow span.inactive_status').hide();
          } else if (col == 'status' && val == 0) {
            $('tr.selectedRow span.active_status').hide();
            $('tr.selectedRow span.inactive_status').show();
          }
        }
      });

    }
    // DELETE BULK
    function bulkDelete() {
      var deleteConfirm = confirm("Are you sure?");
      if (deleteConfirm == true) {
        var tbl = 'universities';
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

    $(document).ready(function() {
      $('#course_category_id').on('change', function(event) {
        var course_category_id = $('#course_category_id').val();
        $.ajax({
          url: "{{ aurl('course-specialization/get-by-category') }}",
          method: "GET",
          data: {
            course_category_id: course_category_id
          },
          success: function(result) {
            $('#specialization_id').html(result);
          }
        })
      });
      $('#country').on('change', function(event) {
        var country = $('#country').val();
        //alert(country);
        $.ajax({
          url: "{{ aurl('get-state-by-country') }}",
          method: "GET",
          data: {
            country: country
          },
          success: function(result) {
            //alert(result);
            $('#state').html(result);
          }
        })
        $.ajax({
          url: "{{ aurl('get-city-by-state') }}",
          method: "GET",
          data: {
            country: country
          },
          success: function(result) {
            $('#city').html(result);
          }
        })
      });
      $('#state').on('change', function(event) {
        var state = $('#state').val();
        var country = $('#country').val();
        $.ajax({
          url: "{{ aurl('get-city-by-state') }}",
          method: "GET",
          data: {
            country: country,
            state: state,
          },
          success: function(result) {
            $('#city').html(result);
          }
        })
      });
    });

    function DeleteAjax(id) {
      //alert(id);
      var cd = confirm("Are you sure ?");
      if (cd == true) {
        $.ajax({
          url: "{{ url('admin/' . $page_route . '/delete') }}" + "/" + id,
          success: function(data) {
            if (data == '1') {
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

    CKEDITOR.replace("description");
  </script>
@endsection
