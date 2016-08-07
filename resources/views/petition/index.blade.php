@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            @if(session('update') == true)
            <div class="alert alert-success" role="alert">
                Your petition was updated succesfully.
            </div>
            @endif
            
            @if(session('create') == true)
            <div class="alert alert-success" role="alert">
                Your petition was created succesfully.
            </div>
            @endif
            
            @if(session('delete') == true)
            <div class="alert alert-danger" role="alert">
                Your petition was deleted succesfully.
            </div>
            @endif
            
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
                            <div class="petition-item">
                                <h4>{{ $petition->title }}</h4>
                                <div class="petition-item-summary">
                                    {!! $petition->summary !!}
                                </div>
                                <div class="text-right petition-item-actions">
                                    <a class="btn btn-default pull-left" href="{{ action('PetitionController@show', ['id'=>$petition->id]) }}">
                                        <span class="glyphicon glyphicon-eye-open text-primary" aria-hidden="true"></span> View
                                    </a>
                                    <form action="{{ action('PetitionController@destroy', ['id'=>$petition->id]) }}" method="POST" class="form-delete-inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-default" type="submit">
                                            <span class="glyphicon glyphicon-trash text-danger" aria-hidden="true"></span> Delete
                                        </button>
                                    </form>
                                    @if( !$petition->published )
                                    <a class="btn btn-default">
                                        <span class="glyphicon glyphicon-remove-sign text-warning" aria-hidden="true"></span> Unpublish
                                    </a>
                                    @else
                                    <a class="btn btn-default">
                                        <span class="glyphicon glyphicon-ok-sign text-success" aria-hidden="true"></span> Publish
                                    </a>
                                    @endif
                                    <a class="btn btn-primary" href="{{ action('PetitionController@edit', ['id'=>$petition->id]) }}">
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
