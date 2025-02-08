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
            <h4 class="mb-sm-0 font-size-18">
              {{ $page_title }}
            </h4>
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
            </div>
            <div class="card-body {{ $ft == 'edit' ? '' : 'hide-this' }}" id="tblCDiv">
              <form id="{{ $ft == 'add' ? 'dataForm' : 'editForm' }}" {{ $ft == 'edit' ? 'action=' . $url : '' }}
                class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="row">
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-InputField type="text" label="Name" name="name" id="name" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-InputField type="email" label="Email" name="email" id="email" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-InputField type="text" label="Mobile" name="mobile" id="mobile" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  {{-- <div class="col-md-3 col-sm-12 mb-3">
                  <x-InputField type="text" label="Role" name="role" id="role" :ft="$ft" :sd="$sd"></x-InputField>
                </div> --}}
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-InputField type="file" label="Profile Pic" name="profile_picture" id="profile_picture"
                      :ft="$ft" :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-SDASelectField type="text" label="Role" name="role" id="role" :ft="$ft"
                      :sd="$sd" :list="$roles"></x-SDASelectField>
                  </div>
                  <div class="col-md-5 col-sm-12 mb-3">
                    <x-InputField type="text" label="Designation" name="designation" id="designation"
                      :ft="$ft" :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-TextareaField label="Shortnote" name="shortnote" id="shortnote" :ft="$ft"
                      :sd="$sd">
                    </x-TextareaField>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-TextareaField label="Highlights" name="highlights" id="highlights" :ft="$ft"
                      :sd="$sd">
                    </x-TextareaField>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-TextareaField label="Experiance" name="experiance" id="experiance" :ft="$ft"
                      :sd="$sd">
                    </x-TextareaField>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-TextareaField label="Education" name="education" id="education" :ft="$ft"
                      :sd="$sd">
                    </x-TextareaField>
                  </div>
                </div>

                @if ($ft == 'add')
                  <button type="reset" class="btn btn-sm btn-warning  mr-1"><i class="ti-trash"></i>
                    Reset</button>
                @endif
                @if ($ft == 'edit')
                  <a href="{{ aurl($page_route) }}" class="btn btn-sm btn-info "><i class="ti-trash"></i> Cancel</a>
                @endif
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
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
              } else {
                var h = 'Failed';
                var msg = data.failed;
                var type = 'danger';
              }
              $('#dataForm')[0].reset();
            } else {
              //alert(data.error);
              printErrorMsg(data.error);
              var h = 'Failed';
              var msg = 'Some error occured.';
              var type = 'danger';
            }
            showToastr(h, msg, type);
          }
        })
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
        //$("#migrateBtn").text('Migrating...');
        setTimeout(() => {
          $.ajax({
            url: "{{ aurl($page_route . '/get-data') }}",
            method: "GET",
            data: {
              page: page,
            },
            success: function(data) {
              $("#trdata").html(data);
            }
          }).fail(err => {
            // $("#migrateBtn").attr('class','btn btn-danger');
            // $("#migrateBtn").text('Migration Failed');
          });
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

    $(function() {
      var $highlights = CKEDITOR.replace('highlights');
      $highlights.on('change', function() {
        $highlights.updateElement();
      });

      var $experiance = CKEDITOR.replace('experiance');
      $experiance.on('change', function() {
        $experiance.updateElement();
      });

      var $education = CKEDITOR.replace('education');
      $education.on('change', function() {
        $education.updateElement();
      });

    });
  </script>
@endsection
