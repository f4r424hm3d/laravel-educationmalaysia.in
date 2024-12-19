@php
  use App\Models\Country;
  use App\Models\Student;

  $clt = Request::segment(3) ?? 'new';

  unset($_GET['page']);
  $url_arr = array_filter($_GET);
  $qs = http_build_query($url_arr);
@endphp
@extends('admin.layouts.main')
@push('title')
  <title>Students</title>
@endpush
@section('main-section')
  <div class="page-content">
    <div class="container-fluid">

      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Students</h4>

            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Students</li>
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
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Filter</h4>
            </div>
            <div class="card-body">
              <form action="" method="get" enctype="multipart/form-data">
                <div class="row">
                  <div class="form-group mb-3 col-md-3 col-sm-12">
                    <label>Nationality</label>
                    <select name="nationality" id="nationality" class="form-control select2">
                      <option value="">Select</option>
                      @foreach ($nat as $na)
                        <option value="{{ $na->nationality }}"
                          {{ isset($_GET['nationality']) && $_GET['nationality'] == $na->nationality ? 'Selected' : '' }}>
                          {{ $na->nationality }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group mb-3 col-md-3 col-sm-12">
                    <label>Intrested Program</label>
                    <select name="intrested_program" id="intrested_program" class="form-control select2">
                      <option value="">Select</option>
                      <option value="ielts" selected>IELTS</option>
                    </select>
                  </div>
                  <div class="form-group mb-3 col-md-3 col-sm-12">
                    <label>Program Branch</label>
                    <select name="intrested_program_branch" id="intrested_program_branch" class="form-control select2">
                      <option value="">Select</option>
                      <option value="ac"
                        {{ isset($_GET['intrested_program_branch']) && $_GET['intrested_program_branch'] == 'ac' ? 'Selected' : '' }}>
                        Academic
                        (AC)
                      </option>
                      <option value="gt"
                        {{ isset($_GET['intrested_program_branch']) && $_GET['intrested_program_branch'] == 'gt' ? 'Selected' : '' }}>
                        General
                        Training (GT)</option>
                    </select>
                  </div>
                  <div class="form-group mb-3 col-md-3 col-sm-12">
                    <label>Asigned</label>
                    <select name="asign" id="asign" class="form-control select2">
                      <option value="">Select</option>
                      @foreach ($counsellor as $row)
                        <option value="{{ $row->id }}"
                          {{ isset($_GET['asign']) && $_GET['asign'] == $row->id ? 'Selected' : '' }}>
                          {{ $row->name ?? '' }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group mb-3 col-md-3 col-sm-12">
                    <label>From</label>
                    <input type="date" name="from" id="from"
                      value="{{ isset($_GET['from']) ? $_GET['from'] : '' }}" class="form-control">
                  </div>
                  <div class="form-group mb-3 col-md-3 col-sm-12">
                    <label>To</label>
                    <input type="date" name="to" id="to"
                      value="{{ isset($_GET['to']) ? $_GET['to'] : '' }}" class="form-control">
                  </div>
                  <div class="form-group mb-3 col-md-3">
                    <label>Lead Status <span class="text-danger">*</span></label>
                    <select name="lead_status" id="f_lead_status" class="form-control select2">
                      <option value="">Select...</option>
                      @foreach ($ls as $row)
                        <option value="<?php echo $row->id; ?>"
                          {{ isset($_GET['lead_status']) && $_GET['lead_status'] == $row->id ? 'Selected' : '' }}>
                          <?php echo $row->title; ?>
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class=" form-group mb-3 col-md-3">
                    <label>Lead Sub Status</label>
                    <select name="lead_sub_status" id="f_lead_sub_status" class="form-control select2">
                      <option value="">Select...</option>
                      @if ($lss != null)
                        @foreach ($lss as $row)
                          <option value="<?php echo $row->id; ?>"
                            {{ isset($_GET['lead_sub_status']) && $_GET['lead_sub_status'] == $row->id ? 'Selected' : '' }}>
                            <?php echo $row->sub_status; ?>
                          </option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group mb-3 col-md-3 col-sm-12">
                    <button type="submit" class="btn btn-sm  btn-primary ">Apply</button>
                    &nbsp;
                    <a href="{{ url('admin/students') }}" class="btn btn-sm  btn-info ">
                      <i class="ti-trash"></i> Clear All
                    </a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              @foreach ($lt as $lt)
                @php
                  $ltc = Student::with('getLevel', 'getCourse', 'getLastFup', 'getAC');

                  if (isset($_GET['nationality']) && $_GET['nationality'] != '') {
                      $ltc = $ltc->where('nationality', $_GET['nationality']);
                  }
                  if (isset($_GET['intrested_program']) && $_GET['intrested_program'] != '') {
                      $ltc = $ltc->where('intrested_program', $_GET['intrested_program']);
                  }
                  if (isset($_GET['intrested_program_branch']) && $_GET['intrested_program_branch'] != '') {
                      $ltc = $ltc->where('intrested_program_branch', $_GET['intrested_program_branch']);
                  }
                  if (isset($_GET['asign']) && $_GET['asign'] != '') {
                      $fasign = $_GET['asign'];
                      $ltc = $ltc->whereHas('getAC', function ($query) use ($fasign) {
                          $query->where('user_id', $_GET['asign']);
                      });
                  }
                  if (isset($_GET['from']) && $_GET['from'] != '') {
                      $from = date('Y-m-d', strtotime($_GET['from'] . '-1 days'));
                      $ltc = $ltc->whereDate('created_at', '>', $from);
                  }
                  if (isset($_GET['to']) && $_GET['to'] != '') {
                      $to = date('Y-m-d', strtotime($_GET['to'] . '+1 days'));
                      $ltc = $ltc->whereDate('created_at', '<', $to);
                  }
                  if (isset($_GET['lead_status']) && $_GET['lead_status'] != '') {
                      $ltc = $ltc->where('lead_status', $_GET['lead_status']);
                  }
                  if (isset($_GET['lead_sub_status']) && $_GET['lead_sub_status'] != '') {
                      $ltc = $ltc->where('lead_sub_status', $_GET['lead_sub_status']);
                  }

                  $ltc = $ltc->where('lead_type', $lt->slug)->count();
                @endphp
                <a href="{{ url('admin/students/' . $lt->slug . '?' . $qs) }}"
                  class="btn btn-sm btn-{{ $clt == $lt->slug ? 'success' : 'outline-info' }}">
                  {{ $lt->title }} {{ $ltc }}
                </a>
              @endforeach
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <table id="datatable" class="table table-striped table-bordered dt-responsiv nowra w-100">
                <thead>
                  <tr>
                    <th>
                      <input style="opacity: 9;left:30px" type="checkbox" name="check_all" id="check_all"
                        value="" />
                    </th>
                    <th>Sr. No.</th>
                    <th>Action</th>
                    <th>Follow Up</th>
                    <th>Contact</th>
                    <th>Program</th>
                    <th>Address</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  @endphp
                  @foreach ($rows as $row)
                    @php

                    @endphp
                    <tr id="row{{ $row->id }}">
                      <td>
                        <input style="opacity: 9;left:30px" type="checkbox" name="selected_id[]" class="checkbox"
                          value="{{ $row->id }}" />
                      </td>
                      <td>
                        {{ $i }}&nbsp;&nbsp;
                        @if ($row->called == 1)
                          <span class="permCalled" title="Called" data-toggle="tooltip">
                            <i class="fa fa-phone text-success" aria-hidden="true"></i>
                          </span>
                        @endif
                        <span class="tempCalled hide-this" title="Called" data-toggle="tooltip">
                          <i class="fa fa-phone text-success" aria-hidden="true"></i>
                        </span>
                        @if ($row->wapp == 1)
                          <span class="permWapp" title="Whatsapp" data-toggle="tooltip">
                            <i class="fab fa-whatsapp text-success" aria-hidden="true"></i>
                          </span>
                        @endif
                        <span class="tempWapp hide-this" title="Whatsapp" data-toggle="tooltip">
                          <i class="fab fa-whatsapp text-success" aria-hidden="true"></i>
                        </span>
                        <br>
                        @if ($row->getAC->count() > 0)
                          @php
                            $alto = '';
                            foreach ($row->getAC as $ac) {
                                $alto .= $ac->getUser->name . ' , ';
                            }
                          @endphp
                          <span class="badge bg-primary" title="{{ $alto }}">{{ $row->getAC->count() }}
                          </span>
                        @endif
                      </td>
                      <td width="200px">
                        {{ getFormattedDate($row->created_at, 'd M Y h:i A') }}
                        <br>
                        <a href="{{ url('admin/student/' . $row->id) }}"
                          class="waves-effect waves-light btn btn-sm btn-outline btn-info">
                          <i class="fa fa-user" aria-hidden="true"></i>
                        </a>
                      </td>
                      <td>
                        <div id="followupDiv{{ $row->id }}">
                          @if ($row->lead_status != null)
                            <span>
                              <span class="text-danger"
                                title="{{ $row->getLastFup->getUser->name }}"><b>{{ Str::limit($row->getLastFup->getUser->name, 10) }}</b></span>
                              <span
                                class="f-rgt">{{ getFormattedDate($row->getLastFup->created_at, 'd M Y | h:i A') }}</span>
                            </span>
                            <hr class="chr">
                            <span class="text-info">{{ $row->getLastFup->getLS->title }} |
                              {{ $row->getLastFup->getLSS->sub_status }}</span>
                            <hr class="chr">
                            <b>{{ getFormattedDate($row->getLastFup->next_followup_date, 'd M Y') }}</b>
                            @if ($row->getLastFup->followup_type != '' && $row->getLastFup->followup_status != '')
                              <br>
                              <span class="text-info">{{ $row->getLastFup->followup_type }} |
                                {{ $row->getLastFup->followup_status }}</span>
                              <br>
                            @endif
                            <p style="width:200px">{{ $row->getLastFup->remark }}</p>
                            <hr class="chr">
                            <p style="width:200px">{{ $row->getLastFup->comment }}</p>
                            <hr class="chr">
                          @endif
                        </div>
                        <small>
                          <a data-bs-toggle="modal" data-bs-target="#changeStatusFollowUp" href="javascript:void()"
                            onclick="changeStatusModelFunc('<?php echo $row->id; ?>')"
                            class="btn btn-xs btn-info">Update</a>
                          <a data-bs-toggle="modal" data-bs-target="#followupListModel"
                            onclick="viewCompleteFollowup('<?php echo $row->id; ?>')" href="javascript:void()"
                            class="btn btn-xs btn-danger" title="Comments">View
                            All</a>
                        </small>

                      </td>
                      <td>
                        {{ $row->name }}<br>
                        {{ $row->c_code . ' ' . $row->mobile }} <br>
                        {{ $row->email }}<br>
                        {{ $row->gender }}<br>
                        {{ $row->dob }}<br>
                      </td>
                      <td>{{ $row->intrested_program }} | {{ $row->intrested_program_branch }}</td>
                      <td>
                        {{ $row->country }}
                      </td>
                    </tr>
                    @php
                      $i++;
                    @endphp
                  @endforeach
                </tbody>
              </table>
              {!! $rows->links('pagination::bootstrap-5') !!}
              <hr>
              <div class="hide-this" id="submitBtn">
                <a onclick="showLtypeBtnDiv()" href="javascript:void()" data-toggle="tooltip"
                  class="btn btn-sm btn-info" title="Move To" value="moveto">
                  Move To
                </a>
                <a onclick="showTeam()" href="javascript:void()" data-toggle="tooltip" class="btn btn-sm btn-info"
                  title="Asign" value="moveto">
                  Asign
                </a>
                <a onclick="showTeam2()" href="javascript:void()" data-toggle="tooltip" class="btn btn-sm btn-primary"
                  title="Un Asign" value="moveto">
                  Un Asign
                </a>
                <a title="Move to trash" data-toggle="tooltip" onclick="bulkSoftDelete()" href="javascript:void()"
                  class="btn btn-danger btn-sm">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
                <a title="Mark as Called" data-toggle="tooltip" onclick="ajaxBulkUpdate('called','1')"
                  href="javascript:void()" class="btn btn-success btn-sm">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                </a>
                <a title="Unmark as Called" data-toggle="tooltip" onclick="ajaxBulkUpdate('called','0')"
                  href="javascript:void()" class="btn btn-danger btn-sm">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                </a>
                <a title="Mark as whatsapp" data-toggle="tooltip" onclick="ajaxBulkUpdate('wapp','1')"
                  href="javascript:void()" class="btn btn-success btn-sm">
                  <i class="fab fa-whatsapp" aria-hidden="true"></i>
                </a>
                <a title="Unmark as whatsapp" data-toggle="tooltip" onclick="ajaxBulkUpdate('wapp','0')"
                  href="javascript:void()" class="btn btn-danger btn-sm">
                  <i class="fab fa-whatsapp-square" aria-hidden="true"></i>
                </a>
              </div>
              <div class="hide-this" id="ltypeBtnDiv">
                <hr>
                @foreach ($alt as $lt2)
                  <a onclick="ajaxBulkUpdate('lead_type','{{ $lt2->slug }}')" href="javascript:void()"
                    data-toggle="tooltip" class="btn btn-sm btn-warning btn-outline">{{ ucwords($lt2->title) }}</a>
                @endforeach
              </div>
              <div class="hide-this" id="CnslrBtnDiv">
                <hr>
                <h5>Counsellor</h5>
                @foreach ($counsellor as $row)
                  <a onclick="asignLeads('{{ $row->id }}')" href="javascript:void()" id="{{ $row->id }}"
                    class="btn btn-sm btn-warning btn-outline">
                    {{ ucwords($row->name) }}</a>
                @endforeach
              </div>
              <div class="hide-this" id="CnslrBtnDiv2">
                <hr>
                <h5>Counsellor</h5>
                @foreach ($counsellor as $row)
                  <a onclick="unAsignLeads('{{ $row->id }}')" href="javascript:void()" id="{{ $row->id }}"
                    class="btn btn-sm btn-warning btn-outline">
                    {{ ucwords($row->name) }}</a>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('common.change-status-model')
  @include('common.view-all-follow-up')
  <script>
    $(document).ready(function() {
      $('#f_lead_status').on('change', function(event) {
        var status_id = $('#f_lead_status').val();
        $.ajax({
          url: "{{ url('common/get-lead-sub-status-by-status') }}",
          method: "GET",
          data: {
            status_id: status_id
          },
          success: function(result) {
            $('#f_lead_sub_status').html(result);
          }
        })
      });
    });

    function unAsignLeads(user_id) {
      //alert(user_id);
      var deleteConfirm = confirm("Are you sure?");
      if (deleteConfirm == true) {
        var student_id = [];
        $(".checkbox:checked").each(function() {
          var userid = $(this).val();
          student_id.push(userid);
        });
        //alert(student_id);
        $.ajax({
          url: "{{ url('common/unasign-leads') }}",
          type: 'GET',
          data: {
            student_id: student_id,
            user_id: user_id,
          },
          success: function(response) {
            //alert(response);
            if (response > 0) {
              location.reload(true);
            } else {
              var h = 'Danger';
              var msg = 'No data found';
              var type = 'danger';
              showToastr(h, msg, type);
            }
          }
        });
      }
    }

    function asignLeads(user_id) {
      var users_arr = [];
      $(".checkbox:checked").each(function() {
        var userid = $(this).val();
        users_arr.push(userid);
      });
      $.ajax({
        url: "{{ url('common/asign-leads') }}",
        type: 'get',
        data: {
          ids: users_arr,
          user_id: user_id
        },
        success: function(response) {
          if (response == 0) {
            var h = 'Danger';
            var msg = 'Leads already asigned';
            var type = 'danger';
          } else if (response > 0) {
            var h = 'Success';
            var msg = response + ' leads has been asigned successfully';
            var type = 'success';
            $("#" + user_id).attr("class", "btn btn-sm btn-success");
          }
          $('#toastMsg').text(msg);
          $('#liveToast').show();
          //location.reload(true);
        }
      });
    }

    function changeStatusModelFunc(id) {
      $('#leadStatusForm')[0].reset();
      $('#csId').val(id);
      var user_id = "{{ session()->get('adminLoggedIn')['user_id'] }}";
      $('#user_id').val(user_id);
    }

    function viewCompleteFollowup(id) {
      //alert(id);
      if (id != '') {
        $.ajax({
          url: "{{ url('common/get-all-follow-up') }}",
          method: "GET",
          data: {
            student_id: id
          },
          success: function(data) {
            //alert(data);
            $('#allcommentsmodelid').html(data);
          }
        });
      }
    }

    function showTeam() {
      $('#CnslrBtnDiv').toggle();
    }

    function showTeam2() {
      $('#CnslrBtnDiv2').toggle();
    }

    function showLtypeBtnDiv() {
      $('#ltypeBtnDiv').toggle();
    }

    function ajaxBulkUpdate(col, val) {
      var tbl = 'students';
      var users_arr = [];
      $(".checkbox:checked").each(function() {
        var userid = $(this).val();
        users_arr.push(userid);
      });
      //alert(users_arr + ' , ' + col + ' , ' + val);
      $.ajax({
        url: "{{ url('common/update-bulk-field') }}",
        type: 'GET',
        data: {
          ids: users_arr,
          val: val,
          col: col,
          tbl: tbl
        },
        success: function(response) {
          //alert(response);
          if (response > '0') {
            var h = 'Success';
            var msg = response + ' rows updated successfully';
            var type = 'success';
            $('#toastMsg').text(msg);
            $('#liveToast').show();
          }
          if (col == 'called' && val == 1) {
            $('tr.selectedRow span.tempCalled').show();
            $('tr.selectedRow span.permCalled').hide();
          } else if (col == 'called' && val == 0) {
            $('tr.selectedRow span.tempCalled').hide();
            $('tr.selectedRow span.permCalled').hide();
          } else if (col == 'wapp' && val == 1) {
            $('tr.selectedRow span.tempWapp').show();
            $('tr.selectedRow span.permWapp').hide();
          } else if (col == 'wapp' && val == 0) {
            $('tr.selectedRow span.tempWapp').hide();
            $('tr.selectedRow span.permWapp').hide();
          } else {
            location.reload(true);
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

    function DeleteAjax(id) {
      //alert(id);
      var cd = confirm("Are you sure ?");
      if (cd == true) {
        $.ajax({
          url: "{{ url('admin/student/delete') }}" + "/" + id,
          success: function(data) {
            if (data == '1') {
              $('#row' + id).remove();
              var h = 'Success';
              var msg = 'Record deleted successfully';
              var type = 'success';
              showToastr(h, msg, type);
            }
          }
        });
      }
    }

    function bulkSoftDelete() {
      var deleteConfirm = confirm("Are you sure?");
      if (deleteConfirm == true) {
        var users_arr = [];
        $(".checkbox:checked").each(function() {
          var userid = $(this).val();
          users_arr.push(userid);
        });
        //alert(users_arr);
        $.ajax({
          url: "{{ url('admin/student/bulk-delete') }}",
          type: 'GET',
          data: {
            ids: users_arr
          },
          success: function(response) {
            //alert(response);
            if (response > 0) {
              location.reload(true);
            }
          }
        });
      }
    }
  </script>
@endsection
