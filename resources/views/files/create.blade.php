@extends('layouts.app')

@section('content')

  @section('panel-content')

    <uploader :files="[]" inline-template>
        <form action="/file-upload" class="dropzone" id="dropzone-custom"></form>
        <div>
            <ul class="list-group" v-sortable>
                <li v-for="file in files" class="list-group-item">
                    <div class="row">
                        <input class="col-md-1" type="radio" name="primary" />
                        <div class="col-md-11" style="height: 100px; width: 100px; background-image: url(@{{file.finalURL}}); background-size:cover;">
                        </div>
                        <i class="glyphicon glyphicon-move"></i>
                    </div>
                </li>
            </ul>
        </div>
    </uploader>

  @endsection

  @include('partials.container', ['title' => 'Create a File'])

@endsection
