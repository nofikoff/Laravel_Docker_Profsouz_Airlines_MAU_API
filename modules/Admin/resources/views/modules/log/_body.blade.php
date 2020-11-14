{{ $log->created_at->format('d.m.Y H:i') }}
{{ trans('admin::log.change_body') }}
<a href="{{ route('admin.users.item', ['id' => $log->user_id]) }}">{{ $log->user->full_name }}</a>
{{ $log->entity->branch->name }}
@include('admin::modules.log._baselink')
{{ $log->comment }}
