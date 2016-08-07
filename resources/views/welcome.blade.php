@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Recent</div>

                <div class="panel-body">
                    <div class="petition-group">
                        @foreach($petitions as $petition)                            
                            <div class="petition-item">
                                <h4>
                                    <a href="{{ action('PetitionController@show', ['id'=>$petition->id]) }}">
                                        {{ $petition->title }}
                                    </a>
                                </h4>
                                <div class="petition-item-summary">
                                    {!! $petition->summary !!}
                                </div>
                            </div>
                        @endforeach
                        <div class="text-center">
                            {!! $petitions->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
