<div class="checkbox {{ $errors->has($name) ? ' has-error' : '' }} row">
    <div class="col-md-6 col-md-offset-4">
        <label>
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
            type="checkbox" class="checkbox" name="{{ $name }}" value="{{ old($name, isset($value)?$value:null) }}">
            {{ $label }}
        </label>
        @include('forms.controls.errors', ['name' => $name])
    </div>
</div>
