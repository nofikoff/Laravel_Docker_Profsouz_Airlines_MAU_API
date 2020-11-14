<div class="card card-info  {{ $notification->read ? :'bg-warning' }}">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <a href="{{ route('profile', ['id' => $notification->entity->id]) }}">{{ $notification->text }}</a>
                <small>{{ $notification->read ?  trans('users::notifications.is_read') : trans('users::notifications.none_read') }}</small>
            </div>
            <div class="col-md-4">
                <div class="text-right"><i class="icon-clock"></i> {{ $notification->created_at->format('H:i d.m.Y') }}
                </div>
            </div>
        </div>
    </div>
</div>