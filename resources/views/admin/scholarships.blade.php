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
              <form id="{{ $ft == 'add' ? 'dataForm' : 'editForm' }}" {{ $ft == 'edit' ? 'action=' . $url : '' }}
                class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="row">
                  <div class="col-md-6 col-sm-12 mb-3">
                    <x-input-field type="text" label="Enter Title" name="title" id="title" :ft="$ft"
                      :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                    <x-input-field type="text" label="Enter Slug" name="slug" id="slug" :ft="$ft"
                      :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="Enter Active Status" name="active_status" id="active_status"
                      :ft="$ft" :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="Enter Type" name="type" id="type" :ft="$ft"
                      :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="file" label="Upload thumbnail" name="thumbnail" id="thumbnail"
                      :ft="$ft" :sd="$sd"></x-input-field>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="form-label sr-onl" for="page_type">Page Type</label>
                    <select name="page_type" id="page_type" class="form-control">
                      <option value="">Select</option>
                      <option value="landing_page" <?php echo $ft == 'edit' && $sd->page_type == 'landing_page' ? 'Selected' : ''; ?>>Landing Page</option>
                      <option value="scholarship_page" <?php echo $ft == 'edit' && $sd->page_type == 'scholarship_page' ? 'Selected' : ''; ?>>Scholarship Page</option>
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3 hide-this">
                    <x-input-field type="text" label="Enter Landing Page Link" name="landing_page_link"
                      id="landing_page_link" :ft="$ft" :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-textarea-field label="Shortnote" name="shortnote" id="shortnote" :ft="$ft"
                      :sd="$sd"></x-textarea-field>
                  </div>
                </div>
                <hr>
                <!--  SEO INPUT FILED COMPONENT  -->
                <x-SeoField :ft="$ft" :sd="$sd"></x-SeoField>
                <!--  SEO INPUT FILED COMPONENT END  -->
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
    $(document).ready(function() {
      // Function to toggle visibility based on the selected option
      function toggleLandingPageField() {
        const selectedValue = $('#page_type').val();
        if (selectedValue === 'landing_page') {
          $('.hide-this').show(); // Show the field if 'landing_page' is selected
        } else {
          $('.hide-this').hide(); // Hide the field otherwise
        }
      }

      // Initial check on page load
      toggleLandingPageField();

      // Event listener for change event on page_type dropdown
      $('#page_type').on('change', function() {
        toggleLandingPageField();
      });
    });
  </script>
  @include('admin.js.common-ajax-page')
@endsection
