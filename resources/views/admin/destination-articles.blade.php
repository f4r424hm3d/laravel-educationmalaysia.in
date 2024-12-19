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
                  <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                      <x-InputField type="text" label="Title" name="title" id="title" :ft="$ft"
                        :sd="$sd">
                      </x-InputField>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                      <x-InputField type="text" label="Page URL" name="page_url" id="page_url" :ft="$ft"
                        :sd="$sd">
                      </x-InputField>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <x-InputField type="file" label="Thumbnail" name="thumbnail" id="thumbnail" :ft="$ft"
                        :sd="$sd">
                      </x-InputField>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <x-SelectField label="Author" name="author_id" id="author_id" savev="id" showv="name"
                        :list="$users" :ft="$ft" :sd="$sd"></x-SelectField>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <x-SelectField label="Destination" name="destination_id" id="destination_id" savev="id"
                        showv="destination_name" :list="$destinations" :ft="$ft" :sd="$sd"></x-SelectField>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3">
                      <x-InputField type="text" label="Enter Heading" name="heading" id="heading" :ft="$ft"
                        :sd="$sd">
                      </x-InputField>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3">
                      <x-TextareaField label="Top Description" name="description" id="description" :ft="$ft"
                        :sd="$sd">
                      </x-TextareaField>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3">
                      <x-TextareaField label="Bottom Description" name="description2" id="description2" :ft="$ft"
                        :sd="$sd">
                      </x-TextareaField>
                    </div>
                  </div>
                  <hr>
                  <!--  SEO INPUT FILED COMPONENT  -->
                  <x-SeoField :ft="$ft" :sd="$sd"></x-SeoField>
                  <!--  SEO INPUT FILED COMPONENT END  -->
                  <button class="btn btn-sm btn-primary" type="submit">Submit</button>
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
        //alert(page+exam_id);
        return new Promise(function(resolve, reject) {
          $.ajax({
            url: "{{ aurl($page_route . '/get-data') }}",
            method: "GET",
            data: {
              page: page,
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
        var tbl = 'exam_tabs';
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
    </script>
  @endsection
