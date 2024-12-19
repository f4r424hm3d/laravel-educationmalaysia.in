@php
  $hva = ['Yes' => '1', 'No' => '0'];
@endphp
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
            <h4 class="mb-sm-0 font-size-18">{{ $page_title }} <span
                class="text-danger">({{ $jobpage->page_name }})</span>
            </h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/job-pages/') }}">Job Pages</a></li>
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
            <div class="card-header">
              <h4 class="card-title">
                {{ $title }} Record
                <span style="float:right;">
                  <button class="btn btn-xs btn-info tglBtn">+</button>
                  <button class="btn btn-xs btn-info tglBtn hide-this">-</button>
                </span>
              </h4>
              <div class="card-body {{ $ft == 'edit' ? '' : 'hide-thi' }}" id="tblCDiv">
                <form id="{{ $ft == 'add' ? 'dataForm' : 'editForm' }}" action="{{ $ft == 'edit' ? $url : '#' }}"
                  class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                  @csrf
                  <input type="hidden" name="page_id" id="page_id" value="{{ $jobpage->id }}" />
                  <div class="row">
                    <div class="col-md-4 col-sm-12 mb-3">
                      <x-InputField type="text" label="Tab Name" name="tab_name" id="tab_name" :ft="$ft"
                        :sd="$sd">
                      </x-InputField>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-3">
                      <button class="btn btn-sm btn-primary setBtn" type="submit">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- end card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">{{ $page_title }} List </h4>
              </div>
              <div class="card-body" id="trdata">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token" ]').attr('content')
        }
      });
      $(document).ready(function() {
        $(document).on('click', '.pagination a', function(event) {
          event.preventDefault();
          var page = $(this).attr('href').split('page=')[1];
          getData(page);
        });

        $('#dataForm').on('submit', function(event) {
          event.preventDefault();
          $(".errSpan").text('');
          $.ajax({
            url: "{{ aurl($page_route . '/store-ajax/') }}",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
              //alert(data);
              if ($.isEmptyObject(data.error)) {
                //alert(data.success);
                if (data.hasOwnProperty('success')) {
                  var h = 'Success';
                  var msg = data.success;
                  var type = 'success';
                  getData();
                  getTabs();
                } else {
                  var h = 'Failed';
                  var msg = data.failed;
                  var type = 'danger';
                }
                $('#dataForm')[0].reset();
                CKEDITOR.instances.description.setData('');
                CKEDITOR.instances.description2.setData('');
              } else {
                //alert(data.error);
                printErrorMsg(data.error);
                var h = 'Failed';
                var msg = 'Some error occured.';
                var type = 'danger';
              }
              showToastr(h, msg, type);
            }
          });
        });
      });

      function printErrorMsg(msg) {
        $.each(msg, function(key, value) {
          $("#" + key + "-err").text(value);
        });
      }

      getData();

      function getData(page) {
        if (page) {
          page = page;
        } else {
          var page = '{{ $page_no }}';
        }
        var page_id = '{{ $jobpage->id }}';
        //alert(page+page_id);
        return new Promise(function(resolve, reject) {
          $.ajax({
            url: "{{ aurl($page_route . '/get-data') }}",
            method: "GET",
            data: {
              page: page,
              page_id: page_id,
            },
            success: function(data) {
              $("#trdata").html(data);
            }
          });
        });
      }

      function DeleteAjax(id) {
        //alert(id);
        var cd = confirm("Are you sure ?");
        if (cd == true) {
          $.ajax({
            url: "{{ url('admin/' . $page_route . '/delete') }}" + "/" + id,
            success: function(data) {
              if (data == '1') {
                getData();
                getTabs();
                var h = 'Success';
                var msg = 'Record deleted successfully';
                var type = 'success';
                //$('#row' + id).remove();
                $('#toastMsg').text(msg);
                $('#liveToast').show();
                showToastr(h, msg, type);
              }
            }
          });
        }
      }

      function changeStatus(id, col, val) {
        //alert(id);
        var tbl = 'job_page_tabs';
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

      $(function() {
        var $description = CKEDITOR.replace('description');
        $description.on('change', function() {
          $description.updateElement();
        });

        var $description2 = CKEDITOR.replace('description2');
        $description2.on('change', function() {
          $description2.updateElement();
        });
      });

      function getTabs() {
        var page_id = '{{ $jobpage->id }}';
        //alert(page_id);
        return new Promise(function(resolve, reject) {
          setTimeout(() => {
            $.ajax({
              url: "{{ aurl($page_route . '/get-tabs') }}",
              method: "GET",
              data: {
                page_id: page_id,
              },
              success: function(data) {
                //alert(data);
                $("#parent_id").html(data);
              }
            }).fail(err => {
              // $("#migrateBtn").attr('class','btn btn-danger');
              // $("#migrateBtn").text('Migration Failed');
            });
          });
        });
      }

      $(document).ready(function() {
        $(document).on('keypress', '.position-update', function(event) {
          if (event.keyCode === 13) { // Check if the pressed key is 'Enter'
            event.preventDefault();
            var newValue = $(this).val(); // Get the updated value
            var rowId = $(this).data('id'); // Get the ID of the row
            // AJAX request to update the position value
            $.ajax({
              url: "{{ url('common/update-field') }}", // Replace with your Laravel route
              method: 'GET',
              data: {
                id: rowId,
                val: newValue,
                col: 'position',
                tbl: 'job_page_tabs',
              },
              success: function(response) {
                getData();
              },
            });
          }
        });
      });
    </script>
  @endsection
