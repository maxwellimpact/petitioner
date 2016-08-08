<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ $title }} </div>
                <div class="panel-body">
                  @yield(isset($section) && $section ? $section : 'panel-content')
                </div>
            </div>
        </div>
    </div>
</div>
