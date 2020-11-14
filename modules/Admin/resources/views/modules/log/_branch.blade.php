{{ $log->created_at->format('d.m.Y H:i') }}
{{ trans('admin::log.change_branch') }}
<a href="{{ route('admin.users.item', ['id' => $log->user_id]) }}">{{ $log->user->full_name }}</a>
{{ \Modules\Posts\Entities\Branch::find($log->value)->name }}
@include('admin::modules.log._baselink')
{{ $log->comment }}