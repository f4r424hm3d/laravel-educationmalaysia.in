<div class="col">
  <div class="form-check">
    <label class="form-check-label" for="{{ $id }}">
      {{ $label }}
    </label>
    <input class="form-check-input" type="checkbox" name="{{ $name }}" id="{{ $id }}"
      {{ $ft == 'edit' && $sd->$name == 1 ? 'checked' : '' }} {{ $required }}>
  </div>
</div>
