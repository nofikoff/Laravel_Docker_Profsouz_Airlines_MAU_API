@if($post)
    <div class="card card-info">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <a href="{{ $post->url }}">{{ $post->title }}</a>
                </div>
                <div class="col-md-4">
                    <div class="text-right"><i
                                class="icon-clock"></i> {{ $notification->created_at->format('H:i d.m.Y') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body {{ $notification->read ? :'bg-warning' }}">
            <div class="row">
                <div class="col-md-2">
                    @if($post->user)
                        <div class="avatar">
                            <img src="{{ $post->user->avatar }}" class="img-avatar">
                        </div>

                        <div>
                            <div class="text-muted">
                                <a href="{{ route('profile', ['id' => $post->user->id]) }}">{{ $post->user->full_name }}</a>
                            </div>
                        </div>
                    @endif

                    <div>
                        <b>{{ trans('posts::list.branch') }}:</b> {{ optional($post->branch)->name }}
                    </div>

                    @if($post->info_status)
                        <div>
                            <b>{{ trans('posts::list.info_status') }}:</b> {{ $post->info_status->name }}
                        </div>
                    @endif

                    <div>
                        <b>{{ trans('posts::list.type') }}: </b> {{ trans('posts::list.type_'.$post->type) }}
                    </div>

                    @if($post->sms_notify)
                        <div>
                            <b>{{ trans('users:notifications.sms_doubling') }}</b>
                        </div>
                    @endif
                </div>

                <div class="col-md-10">
                    {{ $notification->text }}
                    <div class="text-muted" style="position: absolute; right: 0; bottom: -20px;">
                        <small>{{ $notification->read ?  trans('users::notifications.is_read') : trans('users::notifications.none_read') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif