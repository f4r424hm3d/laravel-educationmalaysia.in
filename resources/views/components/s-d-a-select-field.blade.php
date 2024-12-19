<div class="form-group">
  <label>{{ $label }} {!! $required!=null?'<span class="text-danger">*</span>':'' !!}</label>
  <select name="{{ $name }}" id="{{ $id }}" class="form-control select2" {{ $required }} data-trigger>
    <option value="">Select</option>
    @foreach ($list as $key => $value)
    <option value="{{ $value }}" {{ $ft=='edit' && $sd->$name == $value || old($name)==$value
      ?'selected':''
      }}>{{ $key }}</option>
    @endforeach
  </select>
  <span class="text-danger">
    @error($name)
    {{ $message }}
    @enderror
  </span>
</div>