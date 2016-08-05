<form action="{{ $action_url }}" method="POST">
    {{ csrf_field() }}
    
    @if(isset($method) && $method == 'PUT')
    {{ method_field('PUT') }}
    @endif

    <div>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Details</a></li>
        <li role="presentation"><a href="#thanks" aria-controls="thanks" role="tab" data-toggle="tab">Thanks</a></li>
        <li role="presentation"><a href="#email" aria-controls="email" role="tab" data-toggle="tab">Email Response</a></li>
        
        <li class="pull-right">
            <button type="submit" class="btn btn-primary">
                {{ $action_name }}
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
              'value' => isset($petition) ? $petition->title : null,
              'attributes' => [
                  'placeholder' => 'enter clever title here'
              ]
            ])
            
            <input type='hidden' value='false' name='published' />
            
            @include('forms.controls.checkbox', [
              'name' => 'published',
              'label' => 'published',
              'type' => 'checkbox',
              'value' => true,
              'checked' => isset($petition) && $petition->published ? 'checked' : false
            ])

            @include('forms.controls.textarea', [
              'name' => 'summary',
              'label' => 'Summary',
              'value' => isset($petition) ? $petition->summary : null,
              'attributes' => [
                  'placeholder' => 'type a simple summary'
              ]
            ])

            @include('forms.controls.textarea', [
              'name' => 'body',
              'label' => 'Body',
              'value' => isset($petition) ? $petition->body : null,
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
              'value' => isset($petition) ? $petition->thanks_message : null,
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
              'value' => isset($petition) ? $petition->thanks_email_subject : null,
              'attributes' => [
                  'placeholder' => ''
              ]
            ])
            
            @include('forms.controls.textarea', [
              'name' => 'thanks_email_body',
              'label' => 'Body',
              'value' => isset($petition) ? $petition->thanks_email_body : null,
              'attributes' => [
                  'placeholder' => '',
                  'rows' => 15
              ]
            ])
        </div>
      </div>

    </div>
    
</form>
