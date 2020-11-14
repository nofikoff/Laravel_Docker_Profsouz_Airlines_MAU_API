<h3>{{ trans('users::user.comments') }}</h3>
@foreach($posts_comments as $post_name => $comments)
    @continue(!count($comments))
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @php($post = $comments[0]->post)
                <div class="card-header">
                    <a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->title }}</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div>
                                <div class="text-muted">{{ $post->created_at->diffForHumans() }}</div>
                            </div>

                            <div>
                                <b>{{ trans('posts::list.type') }}:</b> {{ trans('posts::list.type_'.$post->type) }}
                            </div>

                            <div>
                                <b>{{ trans('posts::list.branch') }}:</b> {{ $post->branch->name }}
                            </div>

                            @if($post->info_status)
                                <div>
                                    <b>{{ trans('posts::list.info_status') }}:</b> {{ $post->info_status->name }}
                                </div>
                            @endif

                        </div>
                        <div class="col-md-10">
                            @foreach($comments as $comment)
                                <div class="card">
                                    <div class="card-header">
                                        {{ $comment->created_at }}
                                    </div>
                                    <div class="card-body">
                                        {{ $comment->text }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
{{ $comments_links }}
