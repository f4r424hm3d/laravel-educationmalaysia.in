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
              <li class="breadcrumb-item"><a href="{{ url('/admin/university/') }}">University</a></li>
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
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">
              {{ $page_title }} List
              <div class="f-rgt">
                <a href="{{ url(url()->current().'?status=1') }}"
                  class="btn btn-sm {{ isset($_GET['status']) && $_GET['status']==1?'btn-success':'btn-outline-success'  }}">Active</a>
                <a href="{{ url(url()->current().'?status=0') }}"
                  class="btn btn-sm  {{ isset($_GET['status']) && $_GET['status']==0?'btn-danger':'btn-outline-danger'  }}">In-Active</a>
              </div>
            </h4>
          </div>
          <div class="card-body" id="trdata">



          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function clearFilter() {
    var h = ' Success';
    var msg = 'Filter cleared';
    var type = 'success'
    showToastr(h, msg, type);
    getData();
  }
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token" ]').attr('content')
    }
  });
  $(document).ready(function () {
    $(document).on('click', '.pagination a', function (event) {
      event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      getData(page);
    });
  });

  function printErrorMsg(msg) {
    $.each(msg, function (key, value) {
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
    var status = "{{ $_GET['status']??'0' }}";
    //alert(page+status);
    return new Promise(function (resolve, reject) {
      //$("#migrateBtn").text('Migrating...');
      setTimeout(() => {
        $.ajax({
          url: "{{ aurl($page_route.'/get-data') }}",
          method: "GET",
          data: {
            page: page,
            status: status,
          },
          success: function (data) {
            $("#trdata").html(data);
          }
        }).fail(err => {
          // $("#migrateBtn").attr('class','btn btn-danger');
          // $("#migrateBtn").text('Migration Failed');
        });
      });
    });
  }

  function changeStatus(id,col,val) {
    //alert(id);
    var tbl = 'university_reviews';
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
            $('#a'+col+id).toggle();
            $('#i'+col+id).toggle();
          }
          if (val == '0') {
            $('#a'+col+id).toggle();
            $('#i'+col+id).toggle();
          }
        }
      }
    });
  }

  function DeleteAjax(id) {
    //alert(id);
    var cd = confirm("Are you sure ?");
    if (cd == true) {
      $.ajax({
        url: "{{ url('admin/'.$page_route.'/delete') }}" + "/" + id,
        success: function (data) {
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

  $(document).ready(function () {
    $(document).on('change', '#scholarship_name', function (event) {
      event.preventDefault();
      var scholarship_name = $('#scholarship_name').val();
      $.ajax({
        url: "{{ url('common/slugify') }}",
        method: "GET",
        data: {
          text: scholarship_name
        },
        success: function (data) {
          $('#scholarship_slug').val(data);
        }
      });
    });
  });
</script>
@endsection