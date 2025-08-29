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
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-input-field type="text" label="Title" name="title" id="title" :ft="$ft"
                      :sd="$sd" />
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-textarea-field label="Description" name="description" id="description" :ft="$ft"
                      :sd="$sd" />
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-number-input type="number" label="Position" name="position" id="position" :ft="$ft"
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
              </h4>
            </div>
            <div class="card-body">
              <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Position</th>
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
                      <td>{{ $row->title }}</td>
                      <td>
                        <x-content-view-modal :row="$row" field="description" title="Description" />
                      </td>
                      <td>{{ $row->position }}</td>
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
    setPosition();

    CKEDITOR.replace('description');

    function setPosition() {
      //alert('Hello');
      var university_id = '{{ $university_id }}';
      return new Promise(function(resolve, reject) {
        setTimeout(() => {
          $.ajax({
            url: "{{ aurl($page_route . '/get-position') }}",
            method: "GET",
            data: {
              university_id: university_id,
            },
            success: function(data) {
              //alert(data);
              $("#position").val(data);
            }
          });
        });
      });
    }
  </script>
  @include('admin.js.delete-data')
@endsection
