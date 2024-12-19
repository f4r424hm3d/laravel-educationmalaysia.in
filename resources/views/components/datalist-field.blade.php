<div class="form-group">
  <label>{{ $label }} {!! $required!=null?'<span class="text-danger">*</span>':'' !!}</label>
  <input list="{{ $id }}s" name="{{ $name }}" id="{{ $id }}" type="{{ $type }}" class="form-control" placeholder="{{ $label }}" value="{{ $ft == 'edit' ? $sd->$name : old($name) }}" {{ $required }}>
  <datalist id="{{ $id }}s">
    @foreach ($list as $row)
      <option value="{{ $row->$showv }}">
    @endforeach
  </datalist>
  <span class="text-danger">
    @error($name)
    {{ $message }}
    @enderror
  </span>
</div>
