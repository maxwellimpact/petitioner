@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                
                <div class="panel-heading">Petition List</div>

                <div class="panel-body">
                    @foreach($petitions as $petition)
                        <div>
                            <h3>{{ $petition->title }}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
