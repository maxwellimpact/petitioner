@extends('layouts.app')

@section('content')

  @section('panel-content')

    <uploader :files="[]" inline-template>
        <form action="/file-upload" class="dropzone" id="dropzone-custom"></form>
        <div>
            <ul v-for="file in files">
                <li>@{{ file.finalURL }}</li>
            </ul>
        </div>
    </uploader>

  @endsection

  @include('partials.container', ['title' => 'Create a File'])

@endsection
