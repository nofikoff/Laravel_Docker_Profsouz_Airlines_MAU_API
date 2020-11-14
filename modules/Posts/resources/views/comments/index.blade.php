<hr>
<div class="comments-block">

    <div class="row">
        <div class="col-md-8 comments-block-list">
            @include('posts::comments._list', ['comments' => $post->comments()->where('parent_id', 0)->get()])
        </div>
    </div>
    <hr>
    @can('comment', $post)
        <div class="row">
            <div class="col-md-8">
                @include('posts::comments._form')
            </div>
        </div>
    @endcan
</div>