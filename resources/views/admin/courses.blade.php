@extends('admin.layouts.main')
@push('title')
  <title>{{ $page_title }}</title>
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
            </div>
            <div class="card-body" id="tblCDiv">
              <!-- IMPORT FORM START -->
              <x-ImportForm :pageRoute="$page_route" fileName="programs"></x-ImportForm>
              <hr>
              <!-- IMPORT FORM END -->
              <form action="{{ $url }}" class="needs-validation" method="post" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="row">

                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-SelectField label="Course Category" name="course_category_id" id="course_category_id"
                      savev="id" showv="category_name" :list="$category" :ft="$ft"
                      :sd="$sd"></x-SelectField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-SelectField label="Course Specialization" name="specialization_id" id="specialization_id"
                      savev="id" showv="specialization_name" :list="$specialization" :ft="$ft"
                      :sd="$sd"></x-SelectField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-InputField type="text" label="Program Name" name="program_name" id="program_name"
                      :ft="$ft" :sd="$sd"></x-InputField>
                  </div>
                </div>
                @if ($ft == 'add')
                  <button type="reset" class="btn btn-sm btn-warning  mr-1"><i class="ti-trash"></i> Reset</button>
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
              <h4 class="card-title">Record List</h4>
            </div>
            <div class="card-body">
              <table id="datatabl" class="table table-bordered dt-responsive nowrap w-100">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Program</th>
                    <th>Category</th>
                    <th>Specialization</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rows as $row)
                    <tr id="row{{ $row->id }}">
                      <td>{{ $i }}</td>
                      <td>{{ $row->program_name }}</td>
                      <td>{{ $row->getCategory->name ?? 'n/a' }}</td>
                      <td>{{ $row->getSpecialization->name ?? 'n/a' }}</td>
                      <td>
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
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
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
