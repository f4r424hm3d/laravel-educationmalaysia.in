@php
  use App\Models\StudyMode;
@endphp
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
            <h4 class="mb-sm-0 font-size-18">{{ $page_title }} <span class="text-danger">({{ $university->name }})</span>
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
      @include('admin.university-profile-header')
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
            <div class="card-body {{ $ft == 'edit' ? '' : 'hide-thi' }}" id="tblCDiv">
              <!-- IMPORT FORM START -->
              <x-ImportForm :pageRoute="$page_route . '/' . $university->id" fileName="university-program-list">
              </x-ImportForm>
              <hr>
              <!-- IMPORT FORM END -->
              <form action="{{ $url }}" class="needs-validation" method="post" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="row">
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-SelectField label="Course Category" name="course_category_id" id="course_category_id"
                      :ft="$ft" :sd="$sd" :list="$categories" savev="id" showv="name"
                      required="required"></x-SelectField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-SelectField label="Specialization" name="specialization_id" id="specialization_id"
                      :ft="$ft" :sd="$sd" :list="$specializations" savev="id" showv="name"
                      required="required">
                    </x-SelectField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3 hide-thi">
                    <x-InputField type="text" label="Program" name="course_name" id="course_name" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-SelectField label="Level" name="level" id="level" :ft="$ft" :sd="$sd"
                      :list="$levels" savev="level" showv="level" required="required"></x-SelectField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-InputField type="text" label="Duration" name="duration" id="duration" :ft="$ft"
                      :sd="$sd" required="required"></x-InputField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-multiple-select-field label="Study Mode" name="study_mode" id="study_mode" :ft="$ft"
                      :sd="$sd" :list="$studymodes" savev="study_mode" showv="study_mode" required="required">
                    </x-multiple-select-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-multiple-select-field label="Intake" name="intake" id="intake" :ft="$ft"
                      :sd="$sd" :list="$months" savev="month_short_name" showv="month_short_name"
                      required="required">
                    </x-multiple-select-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-InputField type="text" label="Application Deadline" name="application_deadline"
                      id="application_deadline" :ft="$ft" :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-InputField type="number" label="Tution Fees" name="tution_fee" id="tution_fee" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-TextareaField label="Overview" name="overview" id="overview" :ft="$ft"
                      :sd="$sd">
                    </x-TextareaField>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-TextareaField label="Entry Requirement" name="entry_requirement" id="entry_requirement"
                      :ft="$ft" :sd="$sd">
                    </x-TextareaField>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-TextareaField label="Exam Required" name="exam_required" id="exam_required" :ft="$ft"
                      :sd="$sd">
                    </x-TextareaField>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-TextareaField label="Mode of Instruction" name="mode_of_instruction" id="mode_of_instruction"
                      :ft="$ft" :sd="$sd">
                    </x-TextareaField>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-TextareaField label="Scholarship Info" name="scholarship_info" id="scholarship_info"
                      :ft="$ft" :sd="$sd">
                    </x-TextareaField>
                  </div>
                </div>
                <hr>
                <!--  SEO INPUT FIELD COMPONENT  -->
                <x-SeoField :ft="$ft" :sd="$sd"></x-SeoField>
                <!--  SEO INPUT FIELD COMPONENT END  -->
                @if ($ft == 'add')
                  <button type="reset" class="btn btn-sm btn-warning  mr-1"><i class="ti-trash"></i> Reset</button>
                @endif
                @if ($ft == 'edit')
                  <a href="{{ aurl($page_route . '/' . $university->id) }}" class="btn btn-sm btn-info "><i
                      class="ti-trash"></i> Cancel</a>
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
              <h4 class="card-title">
                {{ $page_title }} List
                <span style="float:right;">
                  <a href="{{ aurl($page_route . '/' . $university->id . '/export/') }}"
                    class="btn btn-xs btn-success">Export</a>
                </span>
              </h4>
            </div>
            <div class="card-body">
              <table id="datatabl" class="table table-bordered dt-responsive nowrap w-100">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Program</th>
                    <th>Category</th>
                    <th>Duration</th>
                    <th>Study Mode</th>
                    <th>Intake</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>SEO</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rows as $row)
                    <tr id="row{{ $row->id }}">
                      <td>{{ $i }}</td>
                      <td>
                        Id : {{ $row->id }} <br>
                        Name : {{ $row->course_name }} <br>
                      </td>
                      <td>
                        Category : {{ $row->category->name }} <br>
                        Specialization : {{ $row->getSpecialization->name }} <br>
                        Level : {{ $row->level }} <br>
                      </td>
                      <td>{{ $row->duration }}</td>
                      <td>{{ $row->study_mode }}</td>
                      <td>{{ $row->intake }}</td>
                      <td>{{ $row->application_deadline }}</td>
                      <td>
                        <x-status-field :row="$row" />
                      </td>
                      <td>
                        <x-seo-view-model :row="$row" />
                      </td>
                      <td>
                        <a href="javascript:void()" onclick="DeleteAjax('{{ $row->id }}')"
                          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                        <a href="{{ url('admin/' . $page_route . '/' . $university->id . '/update/' . $row->id) }}"
                          class="waves-effect waves-light btn btn-xs btn-outline btn-info">
                          <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                        <a href="{{ url('admin/university-program-contents/' . $row->id) }}"
                          class="waves-effect waves-light btn btn-xs btn-outline btn-info">
                          Add Content
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
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Update Record</h4>
            </div>
            <div class="card-body {{ $ft == 'edit' ? '' : 'hide-thi' }}" id="tblCDiv">
              <!-- IMPORT FORM START -->
              <form method="post"
                action="{{ url('admin/' . $page_route . '/' . $university->id . '/bulk-update-import') }}"
                id="import_csv" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="form-group col-md-4 mb-3">
                    <label>Select CSV File</label>
                    <input type="file" name="file" id="file" required class="form-control mb-2 mr-sm-2" />
                  </div>
                  <div class="form-group col-md-4 mb-3">
                    <label>&nbsp;&nbsp;</label>
                    <button style="margin-top:28px" type="submit" name="import_csv" class="btn btn-sm btn-info"
                      id="import_csv_btn">Import</button>
                  </div>
                </div>
              </form>
              <!-- IMPORT FORM END -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function changeStatus(id, col, val) {
      //alert(id);
      var tbl = 'university_programs';
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

    $(document).ready(function() {
      $('#course_category_id').on('change', function(event) {
        var course_category_id = $('#course_category_id').val();
        //alert(course_category_id);
        $.ajax({
          url: "{{ aurl('course-specialization/get-by-category') }}",
          method: "GET",
          data: {
            course_category_id: course_category_id
          },
          success: function(result) {
            //alert(result);
            $('#specialization_id').html(result);
          }
        })
      });
      $('#specialization_id').on('change', function(event) {
        var course_category_id = $('#course_category_id').val();
        var specialization_id = $('#specialization_id').val();
        var add_new = 'addnew';
        //alert(`${course_category_id} , ${specialization_id}`);
        $.ajax({
          url: "{{ aurl('programs/get-by-spc-and-cat') }}",
          method: "GET",
          data: {
            course_category_id: course_category_id,
            specialization_id: specialization_id,
            add_new: add_new,
          },
          success: function(result) {
            //alert(result);
            $('#program_name').html(result);
          }
        })
      });
      $('#program_name').on('change', function(event) {
        var program_name = $('#program_name').val();
        //alert(`${course_category_id} , ${specialization_id}`);
        if (program_name == 'addnew') {
          $('#newProgramField').show();
          $('#new_program').val('');
          $('#new_program').attr('required', 'required');
        } else {
          $('#newProgramField').hide();
          $('#new_program').val('blank');
        }
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

    CKEDITOR.replace("overview");
    CKEDITOR.replace("entry_requirement");
    CKEDITOR.replace("exam_required");
    CKEDITOR.replace("mode_of_instruction");
    CKEDITOR.replace("scholarship_info");
  </script>
@endsection
