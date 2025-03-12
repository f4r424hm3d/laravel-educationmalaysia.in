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
              <!-- IMPORT FORM START -->
              <x-ImportForm :pageRoute="$page_route" fileName="course-specializations"></x-ImportForm>
              <hr>
              <!-- IMPORT FORM END -->
              <form action="{{ $url }}" class="needs-validation" method="post" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="row">
                  <div class="col-md-4 col-sm-12 mb-3">
                    <x-SelectField label="Course Category" name="course_category_id" id="course_category_id"
                      savev="id" showv="name" :list="$category" :ft="$ft" :sd="$sd"></x-SelectField>
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3 ">
                    <x-InputField type="text" label="Specialization" name="name" id="name" :ft="$ft"
                      :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3">
                    <x-InputField type="text" label="Specialization Slug" name="slug" id="slug"
                      :ft="$ft" :sd="$sd"></x-InputField>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-select-field label="{{ unslugify('author') }}" name="author_id" id="author_id" :ft="$ft"
                      :sd="$sd" :list="$authors" savev="id" showv="name"></x-select-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="file" label="{{ unslugify('thumbnail') }}" name="thumbnail" id="thumbnail"
                      :ft="$ft" :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="file" label="{{ unslugify('banner') }}" name="banner" id="banner"
                      :ft="$ft" :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="file" label="{{ unslugify('content_image') }}" name="content_image"
                      id="content_image" :ft="$ft" :sd="$sd"></x-input-field>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-3 hide-this">
                    <x-textarea-field label="{{ unslugify('shortnote') }}" name="shortnote" id="shortnote"
                      :ft="$ft" :sd="$sd">
                    </x-textarea-field>
                  </div>
                </div>
                <hr>

                {{-- SEO INPUT FILED COMPONENT --}}
                <x-seo-field :ft="$ft" :sd="$sd"></x-seo-field>
                {{-- SEO INPUT FILED COMPONENT END --}}

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
                      <label for="">Search By Specialization Name, Specialization Id or Course Category Id</label>
                      <input type="text" name="keyword" class="form-control"
                        value="{{ isset($_GET['keyword']) ? $_GET['keyword'] : '' }}"
                        placeholder="Search By Specialization Name, Specialization Id or Course Category Id">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                    <button class="btn btn-sm btn-primary setBtn" type="submit">Search</button>
                    <a href="{{ aurl($page_route) }}" class="btn btn-sm btn-danger setBtn"><i class="ti-trash"></i>
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
                    <th>Sr. No.</th>
                    <th>Specialization</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>SEO</th>
                    <th>Images</th>
                    <th>Contents</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rows as $row)
                    <tr id="row{{ $row->id }}">
                      <td>{{ $i }}</td>
                      <td>{{ $row->id }} <br> {{ $row->name }}</td>
                      <td>{{ $row->course_category_id }} <br> {{ $row->courseCategory->name }}</td>
                      <td>{{ $row->author->name }}</td>
                      <td>
                        @if ($row->meta_title != null)
                          <button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light"
                            data-bs-toggle="modal"
                            data-bs-target="#SeoModalScrollable{{ $row->id }}">View</button>
                          <div class="modal fade" id="SeoModalScrollable{{ $row->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="SeoModalScrollableTitle{{ $row->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="SeoModalScrollableTitle{{ $row->id }}">
                                    SEO
                                  </h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <h4>Title</h4>
                                  <p>{!! $row->meta_title !!}</p>
                                  <h4>Keyword</h4>
                                  <p>{!! $row->meta_keyword !!}</p>
                                  <h4>Description</h4>
                                  <p>{!! $row->meta_description !!}</p>
                                  <h4>Page Content</h4>
                                  <p>{!! $row->page_content !!}</p>
                                  <h4>Rating/Review</h4>
                                  <p>Rating : {{ $row->seo_rating }} | Best Rating : {{ $row->best_rating }} | Total
                                    Reviews :
                                    {{ $row->review_number }}</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        @else
                          N/A
                        @endif
                      </td>
                      <td>
                        <ul>
                          <li>Thumbnail : @if ($row->thumbnail_path != null)
                              <a href="{{ asset($row->thumbnail_path) }}" target="_blank">View</a>
                            @else
                              N/A
                            @endif
                          </li>
                          <li>Banner :@if ($row->banner_path != null)
                              <a href="{{ asset($row->banner_path) }}" target="_blank">View</a>
                            @else
                              N/A
                            @endif
                          </li>
                          <li>Content Image : @if ($row->content_image_path != null)
                              <a href="{{ asset($row->content_image_path) }}" target="_blank">View</a>
                            @else
                              N/A
                            @endif
                          </li>
                          <li>OG Image : @if ($row->og_image_path != null)
                              <a href="{{ asset($row->og_image_path) }}" target="_blank">View</a>
                            @else
                              N/A
                            @endif
                          </li>
                        </ul>
                      </td>
                      <td>
                        <ul>
                          <li>
                            <a href="{{ aurl('course-specialization-contents/' . $row->id) }}">
                              Content <span class="badge bg-danger">{{ $row->contents->count() }}</span>
                            </a>
                          </li>
                          <li>
                            <a href="{{ aurl('course-specialization-faqs/' . $row->id) }}">
                              Faqs <span class="badge bg-danger">{{ $row->faqs->count() }}</span>
                            </a>
                          </li>
                          <li>
                            <a href="{{ aurl('course-specialization-level-contents/' . $row->id) }}">
                              Level Content <span class="badge bg-danger">{{ $row->levelContents->count() }}</span>
                            </a>
                          </li>
                        </ul>
                      </td>
                      <td>
                        <a href="{{ url('admin/' . $page_route . '/update/' . $row->id) }}"
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
    CKEDITOR.replace("description");

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
  </script>
@endsection
