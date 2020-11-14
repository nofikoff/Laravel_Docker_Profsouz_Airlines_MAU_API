{{ $log->created_at->format('d.m.Y H:i') }}
{{ trans('admin::log.logout') }}
{{ $log->user->full_name }}
{{ $log->ip }}