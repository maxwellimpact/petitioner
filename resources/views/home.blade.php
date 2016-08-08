@extends('layouts.app')

@section('content')
    
    @section('panel-content')
        You are logged in!
    @endsection

    @include('partials.container', ['title' => 'Dashboard'])

@endsection
