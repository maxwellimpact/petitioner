@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Petition List</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ action('PetitionController@create') }}" class="btn btn-primary">
                                Create a Petition
                            </a>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="petition-group">
                        @foreach($petitions as $petition)                            
                            <div class="petition-group-item">
                                <h4>{{ $petition->title }}</h4>
                                <div>
                                    {{ $petition->summary }}
                                </div>
                                <div class="text-right">
                                    <a class="btn btn-default">
                                        <span class="glyphicon glyphicon-trash text-danger" aria-hidden="true"></span> Delete
                                    </a>
                                    @if( !$petition->published )
                                    <a class="btn btn-default">
                                        <span class="glyphicon glyphicon-remove-sign text-warning" aria-hidden="true"></span> Unpublish
                                    </a>
                                    @else
                                    <a class="btn btn-default">
                                        <span class="glyphicon glyphicon-ok-sign text-success" aria-hidden="true"></span> Publish
                                    </a>
                                    @endif
                                    <a class="btn btn-primary">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    {!! $petitions->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
