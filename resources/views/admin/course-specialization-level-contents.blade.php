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
                <li class="breadcrumb-item"><a href="{{ url('/admin/course-specializations') }}">Specializations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contents</li>
              </ol>
            </div>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <!-- NOTIFICATION FIELD START -->
          <x-result-notification-field></x-result-notification-field>
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
            <div class="card-body" id="tblCDiv">
              <form id="{{ $ft == 'add' ? 'dataForm' : 'editForm' }}" {{ $ft == 'edit' ? 'action=' . $url : '' }}
                class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="hidden" name="specialization_id" value="{{ $specialization_id }}">
                <div class="row">
                  <div class="col-md-6 col-sm-12 mb-3">
                    <x-select-field label="Select Level" name="level" id="level" :ft="$ft" :sd="$sd"
                      :list="$levels" showv="level" savev="level">
                    </x-select-field>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-textarea-field label="Enter Description" name="content" id="content" :ft="$ft"
                      :sd="$sd">
                    </x-textarea-field>
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
          url: "{{ aurl($page_route . '/store/') }}",
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
                $('#dataForm')[0].reset();
                CKEDITOR.instances.content.setData('');
              }
            } else {
              //alert(data.error);
              printErrorMsg(data.error);
              var h = 'Failed';
              var msg = 'Some error occured';
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
      var specialization_id = '{{ $specialization_id }}';
      return new Promise(function(resolve, reject) {
        //$("#migrateBtn").text('Migrating...');
        setTimeout(() => {
          $.ajax({
            url: "{{ aurl($page_route . '/get-data') }}",
            method: "GET",
            data: {
              page: page,
              specialization_id: specialization_id,
            },
            success: function(data) {
              $("#trdata").html(data);
            }
          });
        });
      });
    }

    // CKEDITOR.replace("description");

    $(function() {
      var $content = CKEDITOR.replace('content');

      $content.on('change', function() {
        $content.updateElement();
      });
    });

    // DELETE ROW
    function deleteData(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "{{ url('admin/' . $page_route . '/delete') }}" + "/" + id,
            success: function(data) {
              if (data.success == true) {
                getData();
                Swal.fire('Deleted!', 'Your record has been deleted.', 'success');
              }
            }
          });
        }
      });
    }
  </script>
@endsection
