{{ $log->created_at->format('d.m.Y H:i') }}
{{ trans('admin::log.create_comment') }}
<a href="{{ route('admin.users.item', ['id' => $log->user_id]) }}">{{ $log->user->full_name }}</a>
@include('admin::modules.log._baselink'):
{{ $log->comment }}