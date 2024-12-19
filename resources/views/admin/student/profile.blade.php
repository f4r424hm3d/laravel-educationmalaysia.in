@extends('backend.layouts.main')
@push('title')
<title>{{ $page_title }}</title>
@endpush
@section('main-section')
<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">{{ $page_title }} <span class="text-danger">({{ $sd->name }})</span>
          </h4>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/university/') }}">University</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    @include('backend.client.client-profile-menu')
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
            <h4 class="card-title">Personal Information</h4>
          </div>
          <div class="card-body {{ $ft=='edit'?'':'hide-thi' }}" id="tblCDiv">
            <form action="{{ $url }}" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
              @csrf
              <div class="row">
                <div class="col-md-4 col-sm-12 mb-3">
                  <x-InputField type="text" label="Name" name="name" id="name" :ft="$ft" :sd="$sd"></x-InputField>
                </div>
                <div class="col-md-4 col-sm-12 mb-3">
                  <x-InputField type="email" label="Email" name="email" id="email" :ft="$ft" :sd="$sd"></x-InputField>
                </div>
                <div class="col-md-4 col-sm-12 mb-3">
                  <x-InputField type="text" label="Mobile" name="mobile" id="mobile" :ft="$ft" :sd="$sd"></x-InputField>
                </div>
              </div>
              <div class="float-right">
                @if ($ft == 'add')
                <button type="reset" class="btn btn-sm btn-warning  mr-1"><i class="ti-trash"></i> Reset</button>
                @endif
                @if ($ft == 'edit')
                <a href="{{ aurl($page_route) }}" class="btn btn-sm btn-info "><i class="ti-trash"></i> Cancel</a>
                @endif
                <button class="btn btn-sm btn-primary" type="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
        <!-- end card -->
      </div>
    </div>
  </div>
</div>
<script>
  function DeleteAjax(id) {
    //alert(id);
    var cd = confirm("Are you sure ?");
    if (cd == true) {
      $.ajax({
        url: "{{ url('admin/'.$page_route.'/delete') }}" + "/" + id,
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
