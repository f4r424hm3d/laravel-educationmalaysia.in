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
                  <div class="col-md-6 col-sm-12 mb-3">
                    <x-InputField type="text" label="Enter Page Name" name="page_name" id="page_name" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                    <x-InputField type="text" label="Enter Headline" name="headline" id="headline" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3">
                    <x-InputField type="file" label="Thumbnail" name="thumbnail" id="thumbnail" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  {{-- <div class="col-md-12 col-sm-12 mb-3">
                    <x-TextareaField label="Shortnote" name="shortnote" id="shortnote" :ft="$ft"
                      :sd="$sd"></x-TextareaField>
                  </div> --}}
                </div>
                <hr>
                <!--  SEO INPUT FILED COMPONENT  -->
                <x-SeoField :ft="$ft" :sd="$sd"></x-SeoField>
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
              <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Page Name</th>
                    <th>Headline</th>
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
                        <a href="{{ url('/admin/service-content/' . $row->id) }}"
                          class="waves-effect waves-light btn btn-xs btn-outline-info">
                          Content <span class="badge bg-danger">{{ $row->contents->count() }}</span>
                        </a>
                        <x-delete-button :id="$row->id" />
                        <x-edit-button :url="url('admin/' . $page_route . '/update/' . $row->id)" />
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
  @include('admin.js.delete-data')
@endsection
