@extends('layouts.petition')

@section('content')
    <div class="petition-layout">
        <header style="background-image:url(http://loremflickr.com/1200/740?random={{ $petition->id }});">
            <div>
                <div class="container">
                    <h1>{{ $petition->title }}</h1>
                </div>
            </div>
        </header>
        
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    {!! $petition->body !!}
                </div>
                <div class="col-md-4">
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
            </div>
        </div>
        
@endsection
