@extends('layouts.app')

@section('content')
    
    @section('panel-content')
        @include('petition.form', [
            'action_url' => action('PetitionController@store'),
            'action_name' => 'Create'
        ])
    @endsection

    @include('partials.container', ['title' => 'Recent Petitions'])
    
@endsection
