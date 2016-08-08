<form action="{{ action('SignController@store', ['id' => $petition->id]) }}" method="POST">
    {{ csrf_field() }}
    
    @include('forms.controls.input', [
      'name' => 'name',
      'label' => 'Name',
      'value' => '',
      'attributes' => [
          'placeholder' => 'Jay Smith'
      ]
    ])
    
    @include('forms.controls.input', [
      'name' => 'email',
      'label' => 'Email',
      'value' => '',
      'attributes' => [
          'placeholder' => 'jay@example.com'
      ]
    ])
    
    @include('forms.controls.input', [
      'name' => 'phone',
      'label' => 'Phone',
      'value' => '',
      'attributes' => [
          'placeholder' => '555-555-5555'
      ]
    ])
    
    <button type="submit" class="btn btn-primary btn-block btn-lg">
        Sign
    </button>
</form>
