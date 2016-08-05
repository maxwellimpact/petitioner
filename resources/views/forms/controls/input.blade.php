<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }} row">
    <label class="col-md-4 control-label">{{ $label }}</label>

    <div class="col-md-6">
        <input
        @if(isset($attributes))
            @foreach((array)$attributes as $key => $attr)
              @if( is_int($key) )
                {{ $attr }}
              @else
                {{ $key }}="{{ $attr }}"
              @endif
            @endforeach
        @endif
        type="{{ isset($type)?$type:'text' }}" class="form-control" name="{{ $name }}" value="{{ old($name, isset($value)?$value:null) }}">
        @include('forms.controls.errors', ['name' => $name])
    </div>
</div>
