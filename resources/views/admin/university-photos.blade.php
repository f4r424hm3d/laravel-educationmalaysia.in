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
          <x-result-notification-field />
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
              <form action="{{ $url }}" class="needs-validation" method="post" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="row">
                  <div class="col-md-6 col-sm-12 mb-3">
                    <x-input-field type="text" label="Title" name="title" id="title" :ft="$ft"
                      :sd="$sd" />
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3">
                    <x-multiple-input-field type="file" label="Photo" name="photo" id="photo" :ft="$ft"
                      :sd="$sd" />
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3">
                    <x-checkbox label="Is Featured" name="is_featured" id="is_featured" :ft="$ft"
                      :sd="$sd" />
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
              <h4 class="card-title">
                {{ $page_title }} List
                {{--  <span style="float:right;">
                <button class="btn btn-xs btn-success">Export</button>
              </span>  --}}
              </h4>
            </div>
            <div class="card-body">
              <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Title</th>
                    <th>Photo</th>
                    <th>Date</th>
                    <th>Featured</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $i = 1;
                  @endphp
                  @foreach ($rows as $row)
                    @php
                      $cr = Carbon\Carbon::parse($row->created_at)->setTimezone('Asia/Kolkata');
                    @endphp
                    <tr id="row{{ $row->id }}">
                      <td>{{ $i }}</td>
                      <td>{{ $row->title }}</td>
                      <td>
                        @if ($row->photo_path != null)
                          <img src="{{ asset($row->photo_path) }}" alt="" height="80" width="80">
                        @else
                          N/A
                        @endif
                      </td>
                      <td>
                        Created at : <b>{{ getFormattedDate($row->created_at, 'h:i A - d-m-Y') }}</b> <br>
                        Updated at : <b>{{ getFormattedDate($row->updated_at, 'h:i A - d-m-Y') }}</b> <br>
                      </td>
                      <td>
                        <span id="ais_featured{{ $row->id }}"
                          class="badge bg-success {{ $row->is_featured == 1 ? '' : 'hide-this' }}"
                          onclick="changeStatus('{{ $row->id }}','is_featured','0')">Yes</span>
                        <span id="iis_featured{{ $row->id }}"
                          class="badge bg-danger {{ $row->is_featured == 0 ? '' : 'hide-this' }}"
                          onclick="changeStatus('{{ $row->id }}','is_featured','1')">No</span>
                      </td>
                      <td>
                        <x-delete-button :id="$row->id" />
                        <x-edit-button :url="url('admin/' . $page_route . '/' . $university->id . '/update/' . $row->id)" />
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
      var tbl = 'university_photos';
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
  </script>
  @include('admin.js.delete-data')
@endsection
