<div class="row">
  <div class="col-md-6 col-sm-12">
    <div class="form-group mb-3">
      <label>Meta Title</label>
      <input name="meta_title" type="text" class="form-control" placeholder="Enter Meta Title"
        value="{{ $ft == 'edit' ? $sd->meta_title : old('meta_title') }}">
      <span class="text-danger">
        @error('meta_title')
          {{ $message }}
        @enderror
      </span>
    </div>
  </div>
  <div class="col-md-6 col-sm-12">
    <div class="form-group mb-3">
      <label>Meta Keyword</label>
      <input name="meta_keyword" type="text" class="form-control" placeholder="Meta Keyword"
        value="{{ $ft == 'edit' ? $sd->meta_keyword : old('meta_keyword') }}">
      <span class="text-danger">
        @error('meta_keyword')
          {{ $message }}
        @enderror
      </span>
    </div>
  </div>
  <div class="col-md-12 col-sm-12">
    <div class="form-group mb-3">
      <label>Meta Description</label>
      <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="5">{{ $ft == 'edit' ? $sd->meta_description : old('meta_description') }}</textarea>
      <span class="text-danger">
        @error('meta_description')
          {{ $message }}
        @enderror
      </span>
    </div>
  </div>
  <div class="col-md-4 col-sm-12">
    <div class="form-group mb-3">
      <label>Page Content</label>
      <input name="page_content" type="text" class="form-control" placeholder="Page Content"
        value="{{ $ft == 'edit' ? $sd->page_content : old('page_content') }}">
      <span class="text-danger">
        @error('page_content')
          {{ $message }}
        @enderror
      </span>
    </div>
  </div>
  <div class="col-md-4 col-sm-12">
    <div class="form-group mb-3">
      <label>Seo Rating</label>
      <input name="seo_rating" type="text" class="form-control" placeholder="Seo Rating"
        value="{{ $ft == 'edit' ? $sd->seo_rating : old('seo_rating') }}">
      <span class="text-danger">
        @error('seo_rating')
          {{ $message }}
        @enderror
      </span>
    </div>
  </div>
  <div class="col-md-4 col-sm-12">
    <div class="form-group mb-3">
      <label>Og Image</label>
      <input name="og_img" type="file" class="form-control" placeholder="OG Image">
      <span class="text-danger">
        @error('og_img')
          {{ $message }}
        @enderror
      </span>
    </div>
  </div>
</div>
