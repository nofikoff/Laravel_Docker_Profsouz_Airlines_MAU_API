<div class="card {{ $post->importance ? 'card-accent-danger' : '' }}">

    <div class="card-header">
        @if($post->in_top)
            <i class="fa fa-lock"></i>
        @endif
        <a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->title }}</a>

        <div class="card-actions">
            @can('update', $post)
                <a href="{{ route('posts.edit', compact('post')) }}"><i class="icon-pencil"></i></a>
            @endcan
            @can('delete', $post)
                <a href="#" class="btn-delete" data-text="{{ trans('posts::list.delete_question') }}"><i
                            class="icon-trash"></i></a>
            @endcan
        </div>
    </div>

    <div class="card-body">

        <div style="margin: -10px 0 10px">
            @foreach ($post->tags as $tag)
                <a href="{{ route('posts.tag', $tag->alias) }}" class="badge badge-pill badge-{{ $tag->class }}">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-2">

                <div class="avatar">
                    <img src="{{ $post->user->avatar }}" class="img-avatar">
                    {{--<span class="avatar-status badge-success"></span>--}}
                </div>

                <div>
                    <div class="text-muted">
                        <a href="{{ route('profile', ['id' => $post->user->id]) }}">{{ $post->user->full_name }}</a>
                    </div>
                    <div class="text-muted">{{ $post->created_at->diffForHumans() }}</div>
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
                @include('admin::modules.vote.components._body')

                @if($post->attachments)
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($post->attachments as $attachment)
                                <div>
                                    <a href="{{ $attachment->download_url }}">
                                        <i class="fa fa-file"></i>
                                        {{ $attachment->name }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($post->is_commented)
        <div class="card-footer bg-white">
            <i class="fa fa-comment"></i>
            <a href="{{ route('posts.comments', ['id' => $post->id]) }}" class="show-comments"
               data-id="{{ $post->id }}">{{ trans('posts::comments.list') }} (<span>{{ $post->comments_count }}</span>)</a>
            <div class="card-footer-comments"></div>
        </div>
    @endif
    {{--<div class="text-muted">{{ trans('posts::comments.disabled') }}</div>--}}

    <form action="{{ route('posts.destroy') }}"
          class="form-post-delete"
          style="display: inline-block"
          method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $post->id }}">
    </form>

</div>