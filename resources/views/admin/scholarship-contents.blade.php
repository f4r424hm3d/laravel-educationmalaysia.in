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
            <h4 class="mb-sm-0 font-size-18">{{ $page_title }}</h4>

            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/scholarships') }}">Scholarships</a></li>
                <li class="breadcrumb-item active" aria-current="page">Content</li>
              </ol>
            </div>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <!-- NOTIFICATION FIELD START -->
          <x-result-notification-field></x-result-notification-field>
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
              <form id="{{ $ft == 'add' ? 'dataForm' : 'editForm' }}" {{ $ft == 'edit' ? 'action=' . $url . '/' : '' }}
                class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="hidden" name="scholarship_id" value="{{ $scholarship_id }}">
                <div class="row">
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-input-field type="text" label="Enter Tab" name="tab" id="tab" :ft="$ft"
                      :sd="$sd">
                    </x-input-field>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-textarea-field label="Enter Description" name="description" id="description" :ft="$ft"
                      :sd="$sd">
                    </x-textarea-field>
                  </div>
                  {{-- <div class="col-md-6 col-sm-12 mb-3">
                    <x-select-field type="text" label="Select Parent Title" name="parent_id" id="parent_id"
                      :ft="$ft" :sd="$sd" :list="$parentContents" showv="title" savev="id">
                    </x-select-field>
                  </div> --}}
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-number-input type="number" label="Position" name="position" id="position" :ft="$ft"
                      :sd="$sd">
                    </x-number-input>
                  </div>
                </div>
                @if ($ft == 'add')
                  <button type="reset" class="btn btn-sm btn-warning  mr-1"><i class="ti-trash"></i>
                    Reset</button>
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
            <div class="card-body" id="trdata">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    getData();

    function getData(page) {
      if (page) {
        page = page;
      } else {
        var page = '{{ $page_no }}';
      }
      var scholarship_id = '{{ $scholarship_id }}';
      var ft = '{{ $ft }}';
      return new Promise(function(resolve, reject) {
        //$("#migrateBtn").text('Migrating...');
        setTimeout(() => {
          $.ajax({
            url: "{{ aurl($page_route . '/get-data') }}/",
            method: "GET",
            data: {
              page: page,
              scholarship_id: scholarship_id,
            },
            success: function(data) {
              $("#trdata").html(data);
              if (ft == 'add') {
                setPosition();
              }
            }
          });
        });
      });
    }

    function setPosition() {
      //alert('Hello');
      var scholarship_id = '{{ $scholarship_id }}';
      return new Promise(function(resolve, reject) {
        setTimeout(() => {
          $.ajax({
            url: "{{ aurl($page_route . '/get-position') }}/",
            method: "GET",
            data: {
              scholarship_id: scholarship_id,
            },
            success: function(data) {
              //alert(data);
              $("#position").val(data);
            }
          });
        });
      });
    }

    function setEditorBlank() {
      CKEDITOR.instances.description.setData('');
    }

    $(function() {
      var $description = CKEDITOR.replace('description');

      $description.on('change', function() {
        $description.updateElement();
      });
    });
  </script>
  @include('admin.js.common-form-submit')
  @include('admin.js.common-delete-data')
@endsection
