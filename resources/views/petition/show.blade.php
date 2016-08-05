<h1>{{ $petition->title }}</h1>
<div>
    {!! $petition->summary !!}
</div>

<div>
    @if(session('success') == true)
        @if($petition->thanks_message)
            {!! $petition->thanks_message !!}
        @else
            <p>
                Thanks for signing the petition!
            </p>
        @endif
    @else
        @include('sign.form')
    @endif
</div>
