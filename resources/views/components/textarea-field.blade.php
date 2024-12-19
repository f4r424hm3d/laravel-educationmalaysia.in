<div class="form-group">
  <label>{{ $label }} {!! $required!=null?'<span class="text-danger">*</span>':'' !!}</label>
  <textarea name="{{ $name }}" id="{{ $id }}" class="form-control" placeholder="{{ $label }}" {{ $required
    }}>{{ $ft == 'edit' ? $sd->$name : old($name) }}</textarea>
  <span class="text-danger" id="{{ $name }}-err">
    @error($name)
    {{ $message }}
    @enderror
  </span>
</div>