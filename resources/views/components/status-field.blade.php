<span id="astatus{{ $row->id }}" class="badge bg-success {{ $row->status == 1 ? '' : 'hide-this' }}"
  onclick="changeStatus('{{ $row->id }}','status','0')">Active</span>
<span id="istatus{{ $row->id }}" class="badge bg-danger {{ $row->status == 0 ? '' : 'hide-this' }}"
  onclick="changeStatus('{{ $row->id }}','status','1')">Inactive</span>