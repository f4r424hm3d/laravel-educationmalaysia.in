<div class="form-group">
  <label>{{ $label }} {!! $required!=null?'<span class="text-danger">*</span>':'' !!}</label>
  <select name="{{ $name }}" id="{{ $id }}" class="form-control select2" {{ $required }} data-trigge>
    <option value="">Select</option>
    @foreach ($list as $item)
    <option value="{{ $item }}" {{ $ft=='edit' && $sd->$name == $item || old($name) == $item
      ?'selected':''
      }}>{{ $item }}</option>
    @endforeach
  </select>
  <span class="text-danger">
    @error($name)
    {{ $message }}
    @enderror
  </span>
</div>