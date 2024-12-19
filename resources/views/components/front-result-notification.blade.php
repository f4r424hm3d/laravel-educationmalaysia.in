@if (session()->has('smsg'))
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  {{ session()->get('smsg') }}
</div>
@endif
@if (session()->has('emsg'))
<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  {{ session()->get('emsg') }}
</div>
@endif
