<div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-header">
        <span style="float:left;">
          <a href="{{ aurl('client/profile/'.$sd->id) }}"
            class="btn btn-xs btn{{ $currentMenu=='profile'?'':'-outline' }}-primary">Profile</a>
          <a href="{{ aurl('client/invoices/'.$sd->id) }}"
            class="btn btn-xs btn{{ $currentMenu=='invoices'?'':'-outline' }}-primary">Invoices</a>
        </span>
      </div>
    </div>
  </div>
</div>
