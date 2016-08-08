@extends('layouts.app')

@section('content')

    @section('panel-content')
        @include('petition.form', [
            'action_url' => action('PetitionController@update', ['id' => $petition->id]),
            'action_name' => 'Update',
            'method' => 'PUT'
        ])
    @endsection

    @include('partials.container', ['title' => 'Recent Petitions'])

@endsection
