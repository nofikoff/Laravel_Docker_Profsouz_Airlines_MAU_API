<div class="row">
    <div class="col-md-8 offset-2">
        <div class="form-group text-center">
            @if ($user->is_confirmed)
                <form method="POST" action="{{ route('admin.users.confirm', $user->id) }}">
                    {{ csrf_field() }}
                    <button class="btn btn-success btn-sm" disabled>
                        {{ trans('users::user.confirmed_true') }}
                    </button>
                    <button class="btn btn-default btn-sm" type="submit">
                        <span class="icon-lock"></span> {{ trans('users::user.unconfirm') }}
                    </button>
                </form>

            @else
                <form method="POST" action="{{ route('admin.users.confirm', $user->id) }}">
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-sm" type="button">
                        {{ trans('users::user.confirmed_false') }}
                    </button>
                    <button class="btn btn-default btn-sm" type="submit">
                        <span class="icon-lock-open"></span> {{ trans('users::user.confirm') }}
                    </button>
                </form>
            @endif
        </div>
    </div>

</div>