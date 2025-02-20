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
            <div class="card-body {{ $ft == 'edit' ? '' : 'hide-this' }}" id="tblCDiv">
              <form action="{{ $url }}" class="needs-validation" method="post" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="row">
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-SelectField label="Select User" name="user_id" id="user_id" savev="id" showv="name"
                      :list="$users" :ft="$ft" :sd="$sd"></x-SelectField>
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-s-d-a-select-field label="Punch Type" name="punch_type" id="punch_type" :list="$punchTypes"
                      :ft="$ft" :sd="$sd"></x-s-d-a-select-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="datetime-local" label="Punch At" name="punch_at" id="punch_at" :ft="$ft"
                      :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="Browser" name="browser" id="browser" :ft="$ft"
                      :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="Browser Version" name="browser_version" id="browser_version"
                      :ft="$ft" :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="OS" name="os" id="os" :ft="$ft"
                      :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="IP Address" name="ip_address" id="ip_address" :ft="$ft"
                      :sd="$sd"></x-input-field>
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
          <div class="card">
            <div class="card-body">
              <form class="needs-validation" method="get" enctype="multipart/form-data" novalidate>
                <div class="row">
                  <div class="col-md-5 col-sm-12 mb-3">
                    <div class="form-group">
                      <label for="">Users</label>
                      <select name="user" id="user" class="form-control">
                        <option value="">Select</option>
                        @foreach ($users as $row)
                          <option value="{{ $row->id }}"
                            {{ isset($_GET['user']) && $_GET['user'] == $row->id ? 'selected' : '' }}>{{ $row->name }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                    <button class="btn btn-sm btn-primary setBtn" type="submit">Search</button>
                    <a href="{{ url($page_route) }}" class="btn btn-sm btn-danger setBtn"><i class="ti-trash"></i>
                      Clear</a>
                  </div>
                </div>
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
                  <a href="{{ aurl($page_route . '/export/') }}" class="btn btn-xs btn-success">Export</a>
                </span>
              </h4>
            </div>
            <div class="card-body">
              <table id="datatabl" class="table table-bordered dt-responsive nowrap w-100">
                <thead>
                  <tr>
                    <th>S. No.</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Punch Type</th>
                    <th>System</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rows as $row)
                    <tr id="row{{ $row->id }}">
                      <td>{{ $i }}</td>
                      <td>{{ $row->user->name }}</td>
                      <td>{{ getFormattedDate($row->punch_at, '(D) d M, Y - h:i A') }}</td>
                      <td>{{ $row->punch_type }}</td>
                      <td>
                        Browser : {{ $row->browser }} <br>
                        OS : {{ $row->os }} <br>
                        IP Address : {{ $row->ip_address }}
                      </td>
                      <td>
                        <a href="{{ url($page_route . '/update/' . $row->id) }}"
                          class="waves-effect waves-light btn btn-xs btn-outline btn-info">
                          <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                        <a href="javascript:void()" onclick="deleteData('{{ $row->id }}')"
                          class="waves-effect waves-light btn btn-xs btn-outline btn-danger">
                          <i class="fa fa-trash" aria-hidden="true"></i>
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
        </div>
      </div>
    </div>
  </div>
  <script>
    function deleteData(id) {
      //alert(id);
      var cd = confirm("Are you sure ?");
      if (cd == true) {
        $.ajax({
          url: "{{ url($page_route . '/delete') }}" + "/" + id,
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
  </script>
@endsection
