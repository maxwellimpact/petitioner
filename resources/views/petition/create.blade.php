@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                
                <div class="panel-heading">Create a Petition</div>

                <div class="panel-body">
                    <form action="{{ action('PetitionController@store') }}" method="POST">
                        {{ csrf_field() }}

                        <div>
                          <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Details</a></li>
                            <li role="presentation"><a href="#thanks" aria-controls="thanks" role="tab" data-toggle="tab">Thanks</a></li>
                            <li role="presentation"><a href="#email" aria-controls="email" role="tab" data-toggle="tab">Email Response</a></li>
                            
                            <li class="pull-right">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </li>
                            
                          </ul>
                          
                          <div>
                              <br><!-- TODO: replace with css adjustments --> 
                          </div>

                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="details">
                                @include('forms.controls.input', [
                                  'name' => 'title',
                                  'label' => 'Title',
                                  'value' => '',
                                  'attributes' => [
                                      'placeholder' => 'enter clever title here'
                                  ]
                                ])
                                
                                @include('forms.controls.checkbox', [
                                  'name' => 'published',
                                  'label' => 'published',
                                  'type' => 'checkbox',
                                  'value' => ''
                                ])

                                @include('forms.controls.textarea', [
                                  'name' => 'summary',
                                  'label' => 'Summary',
                                  'value' => '',
                                  'attributes' => [
                                      'placeholder' => 'type a simple summary'
                                  ]
                                ])

                                @include('forms.controls.textarea', [
                                  'name' => 'body',
                                  'label' => 'Body',
                                  'value' => '',
                                  'attributes' => [
                                      'placeholder' => 'give as much detail as you can but be concise',
                                      'rows' => 15
                                  ]
                                ])
                                
                            </div>
                            
                            <div role="tabpanel" class="tab-pane fade" id="thanks">
                                @include('forms.controls.textarea', [
                                  'name' => 'thanks_message',
                                  'label' => 'Thank You Message',
                                  'value' => '',
                                  'attributes' => [
                                      'placeholder' => 'say something nice to your signees',
                                      'rows' => 15
                                  ]
                                ])
                            </div>
                            
                            <div role="tabpanel" class="tab-pane fade" id="email">
                                @include('forms.controls.input', [
                                  'name' => 'thanks_email_subject',
                                  'label' => 'Subject',
                                  'value' => '',
                                  'attributes' => [
                                      'placeholder' => ''
                                  ]
                                ])
                                
                                @include('forms.controls.textarea', [
                                  'name' => 'thanks_email_body',
                                  'label' => 'Body',
                                  'value' => '',
                                  'attributes' => [
                                      'placeholder' => '',
                                      'rows' => 15
                                  ]
                                ])
                            </div>
                          </div>

                        </div>
                        
                    </form>
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
