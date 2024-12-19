@extends('admin.layouts.main')
@push('title')
<title>Add Student</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
<div class="page-content">
  <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Add Student</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Student</li>
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
            <h4 class="card-title">Add Record</h4>
          </div>
          <div class="card-body">
            <form method="post" id="editInfoForm">

              <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
              </div>

              <div class="col-md-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                <span id="name-err" class="text-danger errSpan"></span>
              </div>
              <div class="col-md-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                <span id="email-err" class="text-danger errSpan"></span>
              </div>
              <div class="col-md-3">
                <label for="mobile" class="form-label">Mobile:</label>
                <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Mobile">
                <span id="mobile-err" class="text-danger errSpan"></span>
              </div>


              <div class="mb-3 text-center">
                <button class="btn btn-success btn-submit btn-sm" type="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


  $(document).ready(function() {

    $('#editInfoForm').on('submit', function(event) {
      event.preventDefault();
      $(".errSpan").text('');
      $.ajax({
        url: "{{ aurl('leads/store-ajax/') }}",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          //alert(data);
          if($.isEmptyObject(data.error)){
            //alert(data.success);
            $('#editInfoForm')[0].reset();
            var h = 'Success';
            var msg = 'Record added successfully';
            var type = 'success';
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
    // $(".print-error-msg").find("ul").html('');
    // $(".print-error-msg").css('display','block');
    // $.each( msg, function( key, value ) {
    //   $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    // });
    $.each( msg, function( key, value ) {
      $("#"+key+"-err").text(value);
    });
  }

</script>
@endsection