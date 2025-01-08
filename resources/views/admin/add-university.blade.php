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
                  <button class="btn btn-xs btn-info tglBtn hide-this">+</button>
                  <button class="btn btn-xs btn-info tglBtn">-</button>
                </span>
              </h4>
            </div>
            <div class="card-body {{ $ft == 'edit' ? '' : 'hide-thi' }}" id="tblCDiv">
              <!-- IMPORT FORM START -->
              {{-- <x-ImportForm :pageRoute="$page_route" fileName="university"></x-ImportForm>
              <hr> --}}
              <!-- IMPORT FORM END -->
              <form action="{{ $url }}" class="needs-validation" method="post" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="row">
                  <div class="col-md-6 col-sm-12 mb-3">
                    <x-input-field type="text" label="Name" name="name" id="name" :ft="$ft"
                      :sd="$sd" required="required">
                    </x-input-field>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                    <x-input-field type="text" label="Slug" name="uname" id="uname" :ft="$ft"
                      :sd="$sd" required="required">
                    </x-input-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="Views" name="views" id="views" :ft="$ft"
                      :sd="$sd">
                    </x-input-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="City" name="city" id="city" :ft="$ft"
                      :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-DatalistField type="text" label="State" name="state" id="state" savev="nicename"
                      showv="state_name" :list="$states" :ft="$ft" :sd="$sd"></x-DatalistField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-SelectField label="Institute Type" name="institute_type" id="institute_type" savev="id"
                      showv="type" :list="$instType" :ft="$ft" :sd="$sd"></x-SelectField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-number-input type="number" label="Rating" name="rating" id="rating" :ft="$ft"
                      :sd="$sd" max="5" min="1" step=".1">
                    </x-number-input>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="number" label="Rank (QS Malaysia)" name="rank" id="rank"
                      :ft="$ft" :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="number" label="QS Wrold Ranking" name="qs_rank" id="qs_rank"
                      :ft="$ft" :sd="$sd">
                    </x-input-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="number" label="The Times" name="times_rank" id="times_rank" :ft="$ft"
                      :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-select-field label="Author" name="author_id" id="author_id" savev="id" showv="name"
                      :list="$authors" :ft="$ft" :sd="$sd"></x-select-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="file" label="Logo" name="logo" id="logo" :ft="$ft"
                      :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="file" label="Banner" name="banner" id="banner" :ft="$ft"
                      :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-textarea-field label="Shortnote" name="shortnote" id="shortnote" :ft="$ft"
                      :sd="$sd"></x-textarea-field>
                  </div>
                </div>
                <hr>

                <!--  SEO INPUT FIELD COMPONENT START -->
                <x-seo-field :ft="$ft" :sd="$sd"></x-seo-field>
                <!--  SEO INPUT FIELD COMPONENT END  -->

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
      <div class="row hide-this">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Bulk Update</h4>
            </div>
            <div class="card-body" id="tblCDiv">
              <form method="post" action="{{ url('admin/' . $page_route . '/bulk-update-import') }}" id="import_csv"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="form-group col-md-4 mb-3">
                    <label>Select Excel File</label>
                    <input type="file" name="file" id="file" required class="form-control mb-2 mr-sm-2" />
                  </div>
                  <div class="form-group col-md-4 mb-3">
                    <label>&nbsp;&nbsp;</label>
                    <button style="margin-top:28px" type="submit" name="import_csv" class="btn btn-sm btn-info"
                      id="import_csv_btn">Import</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    CKEDITOR.replace("description");
  </script>
@endsection
