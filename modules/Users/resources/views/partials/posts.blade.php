<h3>{{ trans('users::user.posts') }}</h3>
@foreach($user_posts as $post)
    <div class="row">
        <div class="col-md-12">
            @include('posts::_item')
        </div>
    </div>
@endforeach
{{ $user_posts->appends(\Input::except('page'))->links('pagination') }}