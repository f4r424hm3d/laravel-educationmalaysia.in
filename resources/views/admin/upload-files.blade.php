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
            <h4 class="card-title">{{ $title }} Record</h4>
          </div>
          <div class="card-body">
            <form id="dataForm" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
              @csrf
              <div class="row">
                <div class="col-md-3">
                  <div class="mb-3">
                    <label class="form-label" for="title">Enter Title</label>
                    <input type="text" class="form-control" id="title" name="title" {{ $ft=='edit' ? '' : 'requir' }}>
                    <span class="text-danger">
                      @error('title')
                      {{ $message }}
                      @enderror
                    </span>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <label class="form-label" for="file">Upload Image</label>
                    <input type="file" class="form-control" id="file" name="file" {{ $ft=='edit' ? '' : 'requir' }}>
                    <span class="text-danger">
                      @error('file')
                      {{ $message }}
                      @enderror
                    </span>
                    <span id="audExtError" class="text-danger"></span>
                  </div>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Submit</button>
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
            <table id="datatable" class="table table-bordered dt-responsiv nowra w-100">
              <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Date</th>
                  <th>File</th>
                  <th>Url</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $i = 1;
                @endphp
                @foreach ($rows as $row)
                <tr id="row{{ $row->id }}">
                  <td>{{ $i }}</td>
                  <td>{{ getFormattedDate($row->created_at,'d M Y - h:i A') }}</td>
                  <td>
                    <a href="{{ asset($row->file_path) }}" target="_blank"
                      class="waves-effect waves-light btn btn-xs btn-info">view</a> | <a
                      href="{{ asset($row->file_path) }}" download
                      class="waves-effect waves-light btn btn-xs btn-danger">download</a>
                  </td>
                  <td>
                    <img src="{{ asset($row->file_path) }}" height="80" width="80">
                    <input type="text" id="url{{ $row->id }}" value="{{ asset($row->file_path) }}">&nbsp;&nbsp;
                    <a onclick="copyFunc('{{ $row->id }}')" href="javascript:void()" data-toggle="tooltip"
                      class="waves-effect waves-light btn btn-xs btn-warning" title="Copy to clipboard">Copy</a>
                  </td>
                  <td>
                    <a href="javascript:void()" onclick="DeleteAjax('{{ $row->id }}','{{ $row->file_name }}')"
                      class="waves-effect waves-light btn btn-xs btn-danger">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>
                @php
                $i++;
                @endphp
                @endforeach
              </tbody>
            </table>
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
    $(document).on('click', '.pagination a', function(event){
      event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      getData(page);
    });

    $('#dataForm').on('submit', function(event) {
      event.preventDefault();
      $(".errSpan").text('');
      $.ajax({
        url: "{{ aurl($page_route.'/store-ajax/') }}",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          //alert(data);
          if($.isEmptyObject(data.error)){
            //alert(data.success);
            if(data.hasOwnProperty('success')){
              var h = 'Success';
              var msg = data.success;
              var type = 'success';
              getData();
            }else{
              var h = 'Failed';
              var msg = data.failed;
              var type = 'danger';
            }
            $('#dataForm')[0].reset();
          }else{
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

  function printErrorMsg (msg) {
    $.each( msg, function( key, value ) {
      $("#"+key+"-err").text(value);
    });
  }

  getData();
  function getData(page){
    if(page){
      page = page;
    }else{
      var page = '{{ $page_no }}';
    }
    //alert(page+university_id);
    return new Promise(function(resolve,reject) {
      //$("#migrateBtn").text('Migrating...');
      setTimeout(() => {
        $.ajax({
        url: "{{ aurl($page_route.'/get-data') }}",
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
        url: "{{ url('admin/'.$page_route.'/delete') }}" + "/" + id,
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

  function copyFunc(id) {
    //alert(id);
    var copyText = document.getElementById("url" + id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");

    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copied: " + copyText.value;
  }

</script>
@endsection