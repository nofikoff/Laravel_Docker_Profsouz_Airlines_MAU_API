<form method="POST" action="{{ route('admin.users.roles', $user->id) }}">
    {{ csrf_field() }}
    <div class="card-header">
        <strong>{{ trans('admin::master.roles') }}</strong>
    </div>

    <div class="table-responsive">
        <table class="table" style="margin-bottom:0px;">
            <tr>
                <th style="width:90%;">{{ trans('admin::master.role_name') }}</th> <th>{{ trans('admin::master.role_status') }}</th>
            </tr>

            @foreach (\Modules\Users\Entities\Role::get() as $role)
                <tr>
                    <td>{{ $role->display_name }}</td>
                    <td>
                        <label class="switch switch-text switch-pill switch-primary">
                            {{--                                            <input type="hidden" value="0" name="role[{{ $role->id }}]">--}}
                            <input type="checkbox" class="switch-input" value="{{ $role->id }}" name="role[]"
                                    {{ $user->hasRole($role) ? ' checked' : '' }}>
                            <span class="switch-label" data-on="&check;" data-off="&chi;"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="card-body2">
        <button type="submit" class="btn btn-block btn-success">
            {{ trans('admin::master.role_button') }}
        </button>
    </div>
</form>