@foreach($comments as $comment)
    <div class="row comment-item" style="width: 700px;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="avatar">
                        <img src="{{ $comment->user->avatar }}" class="img-avatar">
                    </div>
                    <div>
                        <div><a href="{{ route('profile', ['id' => $comment->user->id]) }}">{{ $comment->user->full_name }}</a></div>
                        <div class="text-muted">{{ $comment->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="p-3 bg-light rounded border">
                        @if($comment->parent_id)
                            <a href="{{ route('profile', $comment->parent->user->id) }}">{{ $comment->parent->user->full_name }}</a>,
                        @endif
                            <img src="{{ asset($comment->image_url) }}" alt="" width="100%">
                        {{ $comment->text }}
                    </div>
                    <div class="text-right">
                        @can('delete', $comment)
                            <form action="{{ route('posts.comment.delete') }}" method="POST" class="comment-delete" style="display: inline-block">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $comment->id }}">
                                <button type="submit" class="btn btn-link text-danger">{{ trans('posts::comments.delete') }}</button>
                            </form>
                        @endcan
                        @can('update', $comment)
                            <a href="#" data-text="{{ $comment->text }}" data-comment_id="{{ $comment->id }}" class="btn btn-link comment-edit">{{ trans('posts::comments.edit') }}</a>
                        @endcan
                        <a href="#" data-id="{{ $comment->id }}" class="btn btn-link comment-reply">{{ trans('posts::comments.reply') }}</a>
                    </div>
                </div>
            </div>
            @if($comment->children && (isset($without_children) ? !$without_children : true))
                <div class="messages">@include('posts::comments._list', ['comments' => $comment->children])</div>
            @endif
        </div>
    </div>
@endforeach

<style>
    .comment-item .messages{
        margin: 10px 0 10px 60px;
    }

    .comment-item .messages .messages .messages .messages{
        margin: 10px 0 10px 0;
    }
</style>