<div class="card {{ $post->importance ? 'card-accent-danger' : '' }}">

    <div class="card-header">
        @if($post->in_top)
            <i class="fa fa-lock" title="{{ trans('posts::form.in_top') }}"></i>
        @endif

        @if ($post->status === \Modules\Posts\Entities\Post::STATUS_DRAFT)
            <span style="margin-right:6px;" class="fa fa-clipboard" title="{{ trans('posts::form.its_draft') }}"></span>
        @elseif ($post->status === \Modules\Posts\Entities\Post::STATUS_PREMODERATION)
            <span style="margin-right:6px;" class="fa fa-eye" title="{{ trans('posts::form.its_premoderation') }}"></span>
        @endif
        <a href="{{ route('posts.edit', compact('post')) }}">{{ $post->title }}</a>

        <div class="card-actions">
            <a href="#" class="moderate-link" data-value="published" data-form="{{ $post->id }}"><i
                        class="icon-check"></i></a>
            <a href="#" class="moderate-link" data-value="draft" data-form="{{ $post->id }}"><i class="icon-close"></i></a>
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
                @if(View::exists(implode('.', ['posts::types', $post->type])))
                    @include(implode('.', ['posts::types', $post->type]))
                @endif

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


    <div class="card-footer bg-white">
        @if($post->is_commented)
            <i class="fa fa-comment"></i>
            <a href="{{ route('posts.comments', ['id' => $post->id]) }}" class="show-comments"
               data-id="{{ $post->id }}">{{ trans('posts::comments.list') }} (<span>{{ $post->comments_count }}</span>)</a>
            <div class="card-footer-comments"></div>
        @else
            <div class="text-muted">{{ trans('posts::comments.disabled') }}</div>
        @endif
    </div>


    <form action="{{ route('admin.premoderate.action') }}"
          class="form-post-delete"
          style="display: inline-block"
          id="form-{{ $post->id }}"
          data-text="{{ trans('admin::master.confirm') }}"
          method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $post->id }}">
        <input type="hidden" id="form-{{ $post->id }}-action" name="action" value="none">
    </form>
</div>