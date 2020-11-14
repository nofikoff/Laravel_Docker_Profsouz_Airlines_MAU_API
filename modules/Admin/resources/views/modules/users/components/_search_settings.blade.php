<div class="btn-group btn-group-sm" role="group" aria-label="Search Settings">
    <a href="{{ route('admin.users.verified') }}" class="btn btn-warning">{{ trans('admin::master.only_verified') }}</a>
    <a href="{{ route('admin.users.not_verified') }}" class="btn btn-warning">{{ trans('admin::master.only_not_verified') }}</a>
    <a href="{{ route('admin.users.list') }}" class="btn btn-warning">{{ trans('admin::master.show_all_users') }}</a>
</div>