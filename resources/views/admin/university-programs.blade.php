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
                      :ft="$ft" :sd="$sd" :list="$categories" savev="id" showv="category_name"
                      required="required"></x-SelectField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-SelectField label="Specialization" name="specialization_id" id="specialization_id"
                      :ft="$ft" :sd="$sd" :list="$specializations" savev="id" showv="specialization_name"
                      required="required">
                    </x-SelectField>
                  </div>
                  {{-- <div class="col-md-3 col-sm-12 mb-3">
                    <x-SelectField label="Programs" name="program_name" id="program_name" :ft="$ft"
                      :sd="$sd" :list="$programs" savev="program_name" showv="program_name"
                      required="required"></x-SelectField>
                  </div> --}}
                  <div class="col-md-3 col-sm-12 mb-3 hide-thi">
                    <x-InputField type="text" label="Program" name="program_name" id="program_name" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3 hide-this" id="newProgramField">
                    <x-InputField type="text" label="Add New Program" name="new_program" id="new_program"
                      :ft="$ft" :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-SelectField label="Level" name="level_id" id="level_id" :ft="$ft" :sd="$sd"
                      :list="$levels" savev="id" showv="level" required="required"></x-SelectField>
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
                    <x-multiple-select-field label="Course Mode" name="course_mode" id="course_mode" :ft="$ft"
                      :sd="$sd" :list="$coursemodes" savev="course_mode" showv="course_mode">
                    </x-multiple-select-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-multiple-select-field label="Exam Accepted" name="exam_accepted" id="exam_accepted"
                      :ft="$ft" :sd="$sd" :list="$exams" savev="exam_name" showv="exam_name">
                    </x-multiple-select-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-multiple-select-field label="Intake" name="intake" id="intake" :ft="$ft"
                      :sd="$sd" :list="$months" savev="month_short_name" showv="month_short_name"
                      required="required">
                    </x-multiple-select-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-InputField type="number" label="Tution Fees" name="tution_fees" id="tution_fees"
                      :ft="$ft" :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-InputField type="text" label="IELTS Band" name="ielts" id="ielts" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-InputField type="text" label="TOEFL Band" name="toefl" id="toefl" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-InputField type="text" label="PTE Band" name="pte" id="pte" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-InputField type="text" label="DUOLINGO Band" name="duolingo" id="duolingo"
                      :ft="$ft" :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-InputField type="text" label="GRE Band" name="gre" id="gre" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-InputField type="text" label="GMAT Band" name="gmat" id="gmat" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-InputField type="text" label="SAT Band" name="sat" id="sat" :ft="$ft"
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
                    <th>Course Mode</th>
                    <th>Exams</th>
                    <th>Intake</th>
                    <th>Tution Fees</th>
                    <th>Status</th>
                    <th>SEO</th>
                    <th>Overview</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rows as $row)
                    <tr id="row{{ $row->id }}">
                      <td>{{ $i }}</td>
                      <td>
                        Id : {{ $row->id }} <br>
                        Name : {{ $row->program_name }} <br>
                      </td>
                      <td>
                        Category : {{ $row->getCategory->category_name }} <br>
                        Specialization : {{ $row->getSpecialization->specialization_name }} <br>
                        Level : {{ $row->getLevel->level }} <br>
                      </td>
                      <td>{{ $row->duration }}</td>
                      <td>{!! json_to_list($row->study_mode) !!}</td>
                      <td>{!! json_to_list($row->course_mode) !!}</td>
                      <td>{!! json_to_list($row->exam_accepted) !!}</td>
                      <td>{!! json_to_list($row->intake) !!}</td>
                      <td>{{ $row->tution_fees }}</td>
                      <td>
                        <span id="astatus{{ $row->id }}"
                          class="badge bg-success {{ $row->status == 1 ? '' : 'hide-this' }}"
                          onclick="changeStatus('{{ $row->id }}','status','0')">Active</span>
                        <span id="istatus{{ $row->id }}"
                          class="badge bg-danger {{ $row->status == 0 ? '' : 'hide-this' }}"
                          onclick="changeStatus('{{ $row->id }}','status','1')">Inactive</span>
                      </td>
                      <td>
                        @if ($row->meta_title != null)
                          <button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light"
                            data-bs-toggle="modal"
                            data-bs-target="#SeoModalScrollable{{ $row->id }}">View</button>
                          <div class="modal fade" id="SeoModalScrollable{{ $row->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="SeoModalScrollableTitle{{ $row->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="SeoModalScrollableTitle{{ $row->id }}">
                                    SEO
                                  </h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  {!! $row->meta_title !!} <br>
                                  {!! $row->meta_keyword !!} <br>
                                  {!! $row->meta_description !!} <br>
                                  {!! $row->page_content !!} <br>
                                  {!! $row->seo_rating !!}
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        @else
                          Null
                        @endif
                      </td>
                      <td>
                        @if ($row->overview != null)
                          <button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light"
                            data-bs-toggle="modal"
                            data-bs-target="#OvrModalScrollable{{ $row->id }}">View</button>
                          <div class="modal fade" id="OvrModalScrollable{{ $row->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="OvrModalScrollableTitle{{ $row->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="OvrModalScrollableTitle{{ $row->id }}">
                                    SEO
                                  </h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  {!! $row->overview !!}
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        @else
                          Null
                        @endif
                      </td>
                      <td>
                        Created at : <b>{{ getFormattedDate($row->created_at, 'h:i A - d-m-Y') }}</b> <br>
                        Updated at : <b>{{ getFormattedDate($row->updated_at, 'h:i A - d-m-Y') }}</b> <br>
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
  </script>
@endsection
