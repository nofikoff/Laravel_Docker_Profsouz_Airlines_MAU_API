@foreach($posts as $post)
    <div class="row">
        <div class="col-md-12">
            @include('admin::modules.premoderation.components._item')
        </div>
    </div>
@endforeach