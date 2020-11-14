{{ $log->created_at->format('d.m.Y H:i') }}
{{ trans('admin::log.delete_'.$log->entity_type) }}
<a href="{{ route('admin.users.item', ['id' => $log->user_id]) }}">{{ $log->user->full_name }}</a>
{{ $log->entity->branch->name }}
{{ $log->value }}