@extends('admin.layouts.main')
@push('title')
<title>Study Abroad : Admin Dashboard</title>
@endpush
@section('main-section')
<div class="page-content">
  <div class="container-fluid">
    <!-- start page title -->
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item">
                <a href="javascript: void(0);">Admin</a>
              </li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-3 col-md-6">
        <div class="card card-h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-6">
                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total User</span>
                <h4 class="mb-3">
                  <span class="counter-value" data-target="">0</span>
                </h4>
              </div>
            </div>
            <div class="text-nowrap">
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
