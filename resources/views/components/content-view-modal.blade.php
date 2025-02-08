@if (data_get($row, $field) != null)
  <button type="button" class="btn btn-xs btn-outline-info waves-effect waves-light" data-bs-toggle="modal"
    data-bs-target="#{{ $field }}ModalScrollable{{ $row->id }}">View</button>
  <div class="modal fade" id="{{ $field }}ModalScrollable{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="{{ $field }}ModalScrollableTitle{{ $row->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="{{ $field }}ModalScrollableTitle{{ $row->id }}">
            {{ $title }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {!! data_get($row, $field) !!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@else
  Null
@endif
