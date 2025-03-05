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

              <form action="{{ $url }}" class="needs-validation" method="post" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="row">
                  <div class="col-md-4 col-sm-12 mb-3">
                    <x-InputField type="text" label="Exam Name" name="page_name" id="page_name" :ft="$ft"
                      :sd="$sd">
                    </x-InputField>
                  </div>
                  <div class="col-md-8 col-sm-12 mb-3">
                    <x-InputField type="text" label="Enter Title" name="headline" id="headline" :ft="$ft"
                      :sd="$sd">
                    </x-InputField>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-TextareaField label="Description" name="description" id="description" :ft="$ft"
                      :sd="$sd">
                    </x-TextareaField>
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3">
                    <x-InputField type="file" label="Thumbnail" name="thumbnail" id="thumbnail" :ft="$ft"
                      :sd="$sd">
                    </x-InputField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-InputField type="number" label="Position" name="position" id="position" :ft="$ft"
                      :sd="$sd">
                    </x-InputField>
                  </div>
                </div>
                <hr>
                <!--  SEO INPUT FILED COMPONENT  -->
                <x-seo-field :ft="$ft" :sd="$sd" />
                <!--  SEO INPUT FILED COMPONENT END  -->
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
            <div class="card-body">
              <table id="datatable" class="table table-bordered dt-responsiv nowra w-100">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Exam Name</th>
                    <th>Heading</th>
                    <th>Description</th>
                    <th>Header View</th>
                    <th>Position</th>
                    <th>Image</th>
                    <th>SEO</th>
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
                      <td>{{ $row->page_name }}</td>
                      <td>{{ $row->headline }}</td>
                      <td>
                        @if ($row->description != null)
                          <button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light"
                            data-bs-toggle="modal" data-bs-target="#DesModalScrollable{{ $row->id }}">View</button>
                          <div class="modal fade" id="DesModalScrollable{{ $row->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="DesModalScrollableTitle{{ $row->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="DesModalScrollableTitle{{ $row->id }}">
                                    Description
                                  </h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  {!! $row->description !!}
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
                      <td><span id="ahview{{ $row->id }}"
                          class="badge bg-success {{ $row->hview == 1 ? '' : 'hide-this' }}"
                          onclick="changeStatus('{{ $row->id }}','hview','0')">Active</span>
                        <span id="ihview{{ $row->id }}"
                          class="badge bg-danger {{ $row->hview == 0 ? '' : 'hide-this' }}"
                          onclick="changeStatus('{{ $row->id }}','hview','1')">Inactive</span>
                      </td>
                      <td>{{ $row->position }}</td>
                      <td>
                        @if ($row->imgpath != null)
                          <img src="{{ asset($row->imgpath) }}" alt="" height="40" width="40">
                        @else
                          N/A
                        @endif
                      </td>
                      <td>
                        <x-seo-view-model :row="$row" />
                      </td>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function changeStatus(id, col, val) {
      //alert(id);
      var tbl = 'exams';
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
