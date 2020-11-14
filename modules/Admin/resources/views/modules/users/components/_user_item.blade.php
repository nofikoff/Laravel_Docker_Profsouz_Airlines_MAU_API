<div class="col-sm-12 profile">
    <div class="row card">
        <div class="card-header">

        </div>
        <div class="table-responsive">
            <table class="table" style="margin-bottom:0px;">
                <tr>
                    <th>{{ trans('users::user.fname') . ' ' .  trans('users::user.lname') }}</th>
                    <th>{{ trans('users::user.phone') }}</th>
                    <th>{{ trans('users::user.position') }}</th>
                    <th>{{ trans('users::user.birth_date') }}</th>
                    <th>{{ trans('users::user.register_date') }}</th>
                    <th>{{ trans('users::user.last_seen') }}</th>
                    <th>{{ trans('users::user.roles') }}</th>
                    <th></th>
                </tr>

                @foreach ($users as $user)
                    <tr>
                        <td>
                            <strong class="badge">
                                <a href="{{ route('admin.users.item', $user->id) }}" target="_blank">
                                    <img src="{{ $user->avatar }}" class="img-rounded" style="margin-right:10px; max-width:16px; max-height:16px;">
                                    {{ $user->full_name }}
                                </a>
                            </strong>
                        </td>
                        <td>{{ $user->phone }}</td>
                        <td><small>{{ $user->position ? $user->position : trans('users::user.undefined') }}</small></td>
                        <td><span class="badge">{{ $user->birthday ? $user->birthday : trans('users::user.undefined') }}</span></td>
                        <td><span class="badge">{{ $user->created_at->format('d.m.y') }}</span></td>
                        <td><span class="badge">{{ $user->updated_at->format('H:i d.m.y') }}</span></td>
                        <td><small>{{ $user->roles->pluck('display_name')->implode(', ') }}</small></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-{{ $user->is_confirmed ? 'success' : 'danger' }}">
                                <i class="{{ $user->is_confirmed ? 'icon-check' : 'icon-close' }}"></i>
                                {{--                                                        {{ $user->is_confirmed ? trans('users::user.small_confirmed_true') : trans('users::user.small_confirmed_false') }}--}}
                            </button>
                            <a href="{{ route('admin.users.item', $user->id) }}" class="btn btn-sm btn-success">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>