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
            <div class="card-body" id="tblCDiv">
              <form action="{{ $url }}" class="needs-validation" method="post" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="row">
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-Select-field label="Category" name="category_id" id="category_id" savev="id"
                      showv="category_name" :list="$category" :ft="$ft" :sd="$sd" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-Select-field label="Created By" name="author_id" id="author_id" savev="id" showv="name"
                      :list="$users" :ft="$ft" :sd="$sd" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="file" label="Thumbnail" name="thumbnail" id="thumbnail" :ft="$ft"
                      :sd="$sd" />
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-input-field type="text" label="Title" name="headline" id="headline" :ft="$ft"
                      :sd="$sd" />
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3">
                    <x-textarea-field label="Description" name="description" id="description" :ft="$ft"
                      :sd="$sd" />
                  </div>
                </div>
                <hr>
                <!--  SEO INPUT FIELD COMPONENT START -->
                <x-seo-field :ft="$ft" :sd="$sd" />
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
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table id="datatable" class="table table-bordered dt-responsiv nowra w-100">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Thumbnail</th>
                    <th>Created By</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $i = 1;
                  @endphp
                  @foreach ($rows as $row)
                    @php
                      $url = url('admin/blog-contents/' . $row->id);
                      $faqUrl = url('admin/blog-faqs/' . $row->id);
                    @endphp
                    <tr id="row{{ $row->id }}">
                      <td>{{ $i }}</td>
                      <td>{{ $row->getCategory->category_name ?? $row->category_id }}</td>
                      <td>{{ $row->headline }}</td>
                      <td>
                        <x-content-view-modal :row="$row" field="description" />
                      </td>
                      <td>
                        @if ($row->thumbnail_path != null && file_exists($row->thumbnail_path))
                          <img src="{{ asset($row->thumbnail_path) }}" alt="" height="20" width="20">
                        @else
                          N/A
                        @endif
                      </td>
                      <td>{{ $row->author->name ?? 'Null' }}</td>

                      <td>
                        <x-custom-button :url="$url" label="Content" :count="$row->contents->count()" />
                        <x-custom-button :url="$faqUrl" label="Faqs" :count="$row->faqs->count()" />
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
