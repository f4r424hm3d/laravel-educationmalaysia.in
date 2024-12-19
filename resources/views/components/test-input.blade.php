<div class="col-md-12 col-sm-12">
  <div class="form-group mb-3">
    <label>Meta Title</label>
    <input name="meta_title" type="text" class="form-control" placeholder="Enter Meta Title"
      >
    <span class="text-danger">
      @error('meta_title')
      {{ $message }}
      @enderror
    </span>
  </div>
</div>
