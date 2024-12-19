@php
use App\Models\Country;
use App\Models\CourseCategory;
use App\Models\Specialization;
use App\Models\Level;
use App\Models\Student;

@endphp
@extends('admin.layouts.main')
@push('title')
<title>Students</title>
@endpush
@section('main-section')
<div class="content-wrapper">
  <div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="d-flex align-items-center">
        <div class="mr-auto">
          <div class="d-inline-block align-items-center">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Students</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
          <!-- NOTIFICATION FIELD START -->
          <x-ResultNotificationField></x-ResultNotificationField>
          <!-- NOTIFICATION FIELD END -->
        </div>
        <div class="col-lg-12 col-md-12 col-12">
          <div class="box hide-this hideDiv">
            <div class="box-body">
              <h4 class="box-title text-info"> Filter</h4>
              <form method="get" class="form" enctype="multipart/form-data">
                <hr class="my-15">
                {{-- @csrf --}}
                <div class="row">
                  <div class="form-group col-md-3 col-sm-12">
                    <label>Nationality</label>
                    <select name="nationality" id="nationality" class="form-control select2">
                      <option value="">Select</option>
                      @foreach ($nat as $na)
                      <option value="{{ $na->nationality }}" {{ isset($_GET['nationality']) &&
                        $_GET['nationality']==$na->nationality ? 'Selected' : '' }}>
                        {{ $na->nationality }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-3 col-sm-12">
                    <label>Level</label>
                    <select name="level" id="level" class="form-control select2">
                      <option value="">Select</option>
                      @foreach ($lvl as $l)
                      <option value="{{ $l->current_qualification_level }}" {{ isset($_GET['level']) &&
                        $_GET['level']==$l->current_qualification_level ? 'Selected' : '' }}>
                        {{ $l->getLevel->name ?? '' }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-3 col-sm-12">
                    <label>Course</label>
                    <select name="course" id="course" class="form-control select2">
                      <option value="">Select</option>
                      @foreach ($cc as $c)
                      <option value="{{ $c->intrested_course_category }}" {{ isset($_GET['course']) &&
                        $_GET['course']==$c->intrested_course_category ? 'Selected' : '' }}>
                        {{ $c->getCourse->category ?? '' }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-3 col-sm-12">
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
        {{-- {{ printArray($dep) }} --}}
        <div class="col-lg-12 col-md-12 col-12">
          <div class="box">
            <div class="box-header">
              <h4 class="box-title">Students List</h4>
              <div style="float:right;" class="mb-0">
                <input class="form-control" onkeyup="myNewF()" type="text" id="search" placeholder="Search">
              </div>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table id="" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th colspan="2">
                        <input style="opacity: 9;left:30px" type="checkbox" name="check_all" id="check_all" value="" />
                      </th>
                      <th>Sr. No.</th>
                      <th>Action</th>
                      <th>Name</th>
                      <th>Contact</th>
                      <th>Father</th>
                      <th>Mother</th>
                      <th>Nationality</th>
                      <th>Inernational Id</th>
                      <th>Qualification Level</th>
                      <th>Intrested Course</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    @endphp
                    @foreach ($rows as $row)
                    <tr id="row{{ $row->id }}">
                      <td colspan="2">
                        <input style="opacity: 9;left:30px" type="checkbox" name="selected_id[]" class="checkbox"
                          value="{{ $row->id }}" />
                      </td>
                      <td>{{ $i }}</td>
                      <td>
                        <a href="{{ url('admin/student/' . $row->id) }}"
                          class="waves-effect waves-light btn btn-sm btn-outline btn-info">
                          <i class="fa fa-user" aria-hidden="true"></i>
                        </a>
                      </td>
                      <td>
                        {!! $row->name ? '<b>Name : </b>' . $row->name . '<br>' : '' !!}
                        {!! $row->gender ? '<b>Gender : </b>' . $row->gender . '<br>' : '' !!}
                        {!! $row->dob ? '<b>D.O.B : </b>' . $row->dob . '<br>' : '' !!}
                      </td>
                      <td>
                        {!! $row->mobile ? '<b>Mobile : </b>' . $row->c_code . ' ' . $row->mobile . '<br>' : '' !!}
                        {!! $row->email ? '<b>Email : </b>' . $row->email . '<br>' : '' !!}
                      </td>
                      <td>
                        {!! $row->father ? '<b>Father : </b>' . $row->father . '<br>' : '' !!}
                        {!! $row->father_occupation ? '<b>Occupation : </b>' . $row->father_occupation . '<br>' : '' !!}
                        {!! $row->father_income ? '<b>Income : </b>' . $row->father_income . '<br>' : '' !!}
                      </td>
                      <td>
                        {!! $row->mother ? '<b>Mother : </b>' . $row->mother . '<br>' : '' !!}
                        {!! $row->mother_occupation ? '<b>Occupation : </b>' . $row->mother_occupation . '<br>' : '' !!}
                        {!! $row->mother_income ? '<b>Income : </b>' . $row->mother_income . '<br>' : '' !!}
                      </td>
                      <td>{{ $row->nationality }}</td>
                      <td>{{ $row->aadhar }}</td>
                      <td>{{ $row->getLevel->name ?? '' }}</td>
                      <td>{{ $row->getCourse->category ?? '' }}</td>
                    </tr>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                  </tbody>
                </table>
                {!! $rows->links('pagination::bootstrap-5') !!}
              </div>
              <hr>
              <div class="hide-this" id="submitBtn">
                <a title="Delete" data-toggle="tooltip" onclick="bulkForceDelete()" href="javascript:void()"
                  class="btn btn-danger btn-sm">
                  Delete
                </a>
                <a title="Delete" data-toggle="tooltip" onclick="bulkRestore()" href="javascript:void()"
                  class="btn btn-success btn-sm">
                  Restore
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<script>
  function bulkForceDelete() {
      var deleteConfirm = confirm("Are you sure?");
      if (deleteConfirm == true) {
        var users_arr = [];
        $(".checkbox:checked").each(function() {
          var userid = $(this).val();
          users_arr.push(userid);
        });
        //alert(users_arr);
        $.ajax({
          url: "{{ url('admin/student/bulk-force-delete') }}",
          type: 'get',
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

    function bulkRestore() {
      var deleteConfirm = confirm("Are you sure?");
      if (deleteConfirm == true) {
        var users_arr = [];
        $(".checkbox:checked").each(function() {
          var userid = $(this).val();
          users_arr.push(userid);
        });
        //alert(users_arr);
        $.ajax({
          url: "{{ url('admin/student/bulk-restore') }}",
          type: 'get',
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
          url: "{{ url('admin/student/force-delete') }}" + "/" + id,
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

</script>
@endsection