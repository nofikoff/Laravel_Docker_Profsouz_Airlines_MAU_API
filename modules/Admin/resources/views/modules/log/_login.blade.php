{{ $log->created_at->format('d.m.Y H:i') }}
{{ trans('admin::log.login') }}
<a href="{{ route('admin.users.item', ['id' => $log->user_id]) }}">{{ $log->user->full_name }}</a>
{{ $log->ip }}