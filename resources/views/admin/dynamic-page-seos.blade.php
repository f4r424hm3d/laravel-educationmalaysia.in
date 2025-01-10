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
            <div class="card-body  {{ $ft == 'edit' ? '' : 'hide-this' }}" id="tblCDiv">
              <form action="{{ $url }}" class="needs-validation" method="post" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="row">
                  <div class="col-md-6 col-sm-12 mb-3">
                    <x-InputField type="text" label="Enter Page Name" name="url" id="url" :ft="$ft"
                      :sd="$sd">
                    </x-InputField>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label>Meta Title</label>
                      <input name="title" type="text" class="form-control" placeholder="Enter Meta Title"
                        value="{{ $ft == 'edit' ? $sd->title : old('title') }}">
                      <span id="title-err" class="text-danger errSpan">
                        @error('title')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label>Meta Keyword</label>
                      <input name="keyword" type="text" class="form-control" placeholder="Meta Keyword"
                        value="{{ $ft == 'edit' ? $sd->keyword : old('keyword') }}">
                      <span id="keyword-err" class="text-danger errSpan">
                        @error('keyword')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group mb-3">
                      <label>Meta Description</label>
                      <textarea name="description" id="description" class="form-control" cols="30" rows="5">{{ $ft == 'edit' ? $sd->description : old('description') }}</textarea>
                      <span id="description-err" class="text-danger errSpan">
                        @error('description')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 hide-thi">
                    <div class="form-group mb-3">
                      <label>Page Content</label>
                      <input name="page_content" type="text" class="form-control" placeholder="Page Content"
                        value="{{ $ft == 'edit' ? $sd->page_content : old('page_content') }}">
                      <span id="page_content-err" class="text-danger errSpan">
                        @error('page_content')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <div class="form-group mb-3">
                      <label>Seo Rating</label>
                      <input name="seo_rating" type="number" class="form-control" placeholder="Seo Rating"
                        value="{{ $ft == 'edit' ? $sd->seo_rating : old('seo_rating') }}" min="1" max="5"
                        step=".1">
                      <span id="seo_rating-err" class="text-danger errSpan">
                        @error('seo_rating')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <div class="form-group mb-3">
                      <label>Best Rating</label>
                      <input name="best_rating" type="number" class="form-control" placeholder="Seo Rating"
                        value="{{ $ft == 'edit' ? $sd->best_rating : old('best_rating') }}" min="1" max="5"
                        step=".1">
                      <span id="best_rating-err" class="text-danger errSpan">
                        @error('best_rating')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <div class="form-group mb-3">
                      <label>Number of Review</label>
                      <input name="review_number" type="number" class="form-control" placeholder="Seo Rating"
                        value="{{ $ft == 'edit' ? $sd->review_number : old('review_number') }}">
                      <span id="review_number-err" class="text-danger errSpan">
                        @error('review_number')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <div class="form-group mb-3">
                      <label>Upload OG Image</label>
                      <input name="og_image" type="file" class="form-control" placeholder="Upload OG Image">
                      <span id="og_image-err" class="text-danger errSpan">
                        @error('og_image')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
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
              <table id="datatable" class="table table-bordered dt-responsiv nowra w-100">
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Page</th>
                    <th>Title</th>
                    <th>Keyword</th>
                    <th>Content</th>
                    <th>Description</th>
                    <th>SEO Rating</th>
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
                      <td>
                        <?php echo $row->url; ?>
                      </td>
                      <td>
                        <x-content-view-modal :row="$row" field="title" title="Meta Title" />
                      </td>
                      <td>
                        <x-content-view-modal :row="$row" field="keyword" title="Meta Keyword" />
                      </td>
                      <td>
                        <x-content-view-modal :row="$row" field="page_content" title="Page Content" />
                      </td>
                      <td>
                        <x-content-view-modal :row="$row" field="description" title="Meta Description" />
                      </td>
                      <td>
                        Seo Rating : {{ $row->seo_rating }} <br>
                        Best Rating : {{ $row->best_rating }} <br>
                        Review Number : {{ $row->review_number }}
                      </td>
                      <td>
                        <x-delete-button :id="$row->id" />
                        <x-edit-button url="url('admin/' . $page_route . '/update/' . $row->id)" />
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
