{{ $log->created_at->format('d.m.Y H:i') }}
{{ trans('admin::log.change_infostatus') }}
<a href="{{ route('admin.users.item', ['id' => $log->user_id]) }}">{{ $log->user->full_name }}</a>
{{ $log->entity->branch->name }}
<a href="{{ route('posts.show', ['id' => $log->entity_id]) }}">{{ $log->entity->title }}</a>
{{ trans('admin::log.new_infostatus') }}:
{{ optional(\Modules\Posts\Entities\InfoStatus::find($log->value))->name }}
{{ $log->comment }}