<form action="{{ route('posts.comment.store') }}" data-url="{{ route('posts.comment.store') }}" method="POST" class="comment-form" style="width: 800px">
    {{ csrf_field() }}
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <input type="hidden" name="parent_id" value="0">
    <div class="row">
        <div class="col-md-1">
            <div class="avatar">
                <img src="{{ Auth::user()->avatar }}" class="img-avatar">
                <span class="avatar-status badge-success"></span>
            </div>
        </div>
        <div class="col-md-8 form-group">
            <textarea name="text" id="" cols="30" rows="2" class="form-control"
                      placeholder="{{ trans('posts::comments.text_placeholder') }}"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 text-right form-group offset-md-1">
            <label for="inputFile_{{ $post->id }}" class="btn btn-success btn-sm" style="margin-top: 8px">
                <i class="fa fa-paperclip"></i>
            </label>
            <input id="inputFile_{{ $post->id }}" type="file" name="image" class="comment-file" accept="image/*">
            <button class="btn btn-danger btn-sm hidden remove_image">
                <i class="fa fa-close"></i>
            </button>
            <button type="submit" class="btn btn-sm btn-primary">{{ trans('posts::comments.submit') }}</button>
        </div>
    </div>
</form>