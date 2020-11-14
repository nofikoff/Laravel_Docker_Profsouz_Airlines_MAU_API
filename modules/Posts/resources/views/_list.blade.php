@foreach($posts as $post)
    <div class="row">
        <div class="col-md-12">
            @include('posts::_item')
        </div>
    </div>
@endforeach