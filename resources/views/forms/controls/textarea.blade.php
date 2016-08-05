<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }} row">
    <label class="col-md-4 control-label">{{ $label }}</label>

    <div class="col-md-6">
        <textarea
        @foreach($attributes as $key => $attr)
          @if( is_int($key) )
            {{ $attr }}
          @else
            {{ $key }}="{{ $attr }}"
          @endif
        @endforeach
        type="{{ isset($type)?$type:'text' }}" class="form-control" name="{{ $name }}">{{ old($name, isset($value)?$value:null) }}</textarea>
        
        @include('forms.controls.errors', ['name' => $name])
    </div>
</div>
