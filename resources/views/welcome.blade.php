@extends('layouts.app')

@section('content')
    @section('panel-content')
        <div class="petition-group">
            @foreach($petitions as $petition)
                <div class="petition-item media">
                    <div class="media-left">
                        <img class="media-object" src="http://loremflickr.com/320/240?random={{ $petition->id }}">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="{{ action('PetitionController@show', ['id'=>$petition->id]) }}">
                                {{ $petition->title }}
                            </a>
                        </h4>
                        <div class="petition-item-summary">
                            {!! $petition->summary !!}
                        </div>
                    </div>
                    <div class="media-right">
                        <a class="btn btn-primary btn-lg btn-block" href="{{ route('petitions.show', ['id'=>$petition->id]) }}">
                            view
                        </a>
                    </div>
                </div>
            @endforeach
            <div class="text-center">
                {!! $petitions->links() !!}
            </div>
        </div>
    @endsection

    @include('partials.container', ['title' => 'Recent Petitions'])
@endsection
