<div href="{{ $notification->entity->url }}" class="card card-info">
    @php($document = $notification->entity)
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <a href="{{ route('documents.download', $document->id) }}">{{ $document->file }}</a>
            </div>
            <div class="col-md-4">
                <div class="text-right"><i class="icon-clock"></i> {{ $notification->created_at->format('H:i d.m.Y') }}
                </div>
            </div>
        </div>
    </div>
    <div class="card-body {{ $notification->read ? :'bg-warning' }}">
        <div class="row">
            <div class="col-md-2">

                <div class="avatar">
                    <img src="{{ $document->user->avatar }}" class="img-avatar">
                </div>

                <div>
                    <div class="text-muted">
                        <a href="{{ route('profile', ['id' => $document->user->id]) }}">{{ $document->user->full_name }}</a>
                    </div>
                </div>

                <div>
                    <b>{{ trans('posts::list.branch') }}:</b> {{ $document->branch->name }}
                </div>

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