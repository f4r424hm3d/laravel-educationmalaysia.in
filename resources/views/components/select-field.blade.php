<div class="form-group">
  <label>{{ $label }} {!! $required!=null?'<span class="text-danger">*</span>':'' !!}</label>
  <select name="{{ $name }}" id="{{ $id }}" class="form-control js-example-basic-singl" {{ $required }}>
    <option value="">Select</option>
    @foreach ($list as $row)
    <option value="{{ $row->$savev }}" {{ $ft=='edit' && $sd->$name == $row->$savev || old($name)==$row->$savev
      ?'selected':''
      }}>{{ $row->$showv }}</option>
    @endforeach
  </select>
  <span class="text-danger">
    @error($name)
    {{ $message }}
    @enderror
  </span>
</div>