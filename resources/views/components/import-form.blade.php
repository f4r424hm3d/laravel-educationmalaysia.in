<form method="post" action="{{ url('admin/' . $pageRoute . '/import') }}" id="import_csv" enctype="multipart/form-data">
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
      <a download href="{{ asset('format/' . $fileName . '.xlsx') }}" style="margin-top:28px"
        class="btn btn-sm btn-primary">Formate</a>
    </div>
  </div>
</form>
