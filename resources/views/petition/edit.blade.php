@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                
                <div class="panel-heading">Create a Petition</div>

                <div class="panel-body">
                    @include('petition.form', [
                        'action_url' => action('PetitionController@update', ['id' => $petition->id]),
                        'action_name' => 'Update',
                        'method' => 'PUT'
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({
    selector: 'textarea',
    menubar: false,
    toolbar: 'undo redo | styleselect | bold italic | link'
});</script>
@endsection
