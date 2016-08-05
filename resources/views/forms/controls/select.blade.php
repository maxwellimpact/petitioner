<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">{{ $label }}</label>

    <div class="col-md-6">
      <select class="form-control" name="{{ $name }}" {{ isset($type)?$type:'' }}>
        @foreach($options as $option)
          <option {{ old($name, $value)==$option[$options_value] ? 'selected':'' }} value="{{ $option[$options_value] }}">
            {{ $option[$options_text] }}
          </option>
        @endforeach
      </select>
      @include('forms.controls.errors', ['name' => $name])
    </div>
</div>
