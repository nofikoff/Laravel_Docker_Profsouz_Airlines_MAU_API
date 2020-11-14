<form action="{{ route('admin.users.item', $user->id) }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="row form-group">
                <strong>{{ trans('users::user.id') }}</strong>
                <input class="form-control" type="text" value="{{ $user->id }}" disabled>
            </div>

            <div class="row form-group">
                <strong>{{ trans('users::user.fname') }}</strong>
                <input name="first_name" class="form-control" type="text" value="{{ $user->first_name }}">
            </div>

            <div class="row form-group">
                <strong>{{ trans('users::user.lname') }}</strong>
                <input name="last_name" class="form-control" type="text" value="{{ $user->last_name }}">
            </div>

            <div class="row form-group">
                <strong>{{ trans('users::user.phone') }}</strong>
                <input name="phone" class="form-control" type="text" value="{{ $user->phone }}">
            </div>

            <div class="row form-group">
                <strong>{{ trans('users::user.position') }}</strong>
                <input name="position" class="form-control" type="text" placeholder="{{ $user->position ? '' : trans('users::user.undefined') }}" value="{{ $user->position ? $user->position : '' }}">
            </div>

            <div class="row form-group">
                <strong>{{ trans('users::user.birth_date') }}</strong>
                <input name="birth_date" id="birth-date" class="form-control" type="date" placeholder="{{ $user->birthday ? '' : trans('users::user.undefined') }}" value="{{ $user->birthday ? $user->birthday : '' }}">
            </div>

            <div class="row form-group">
                <strong>{{ trans('users::user.register_date') }}</strong>
                <input class="form-control" type="text" value="{{ $user->created_at->format('H:i d.m.Y') }}" disabled>
            </div>

            <div class="row form-group">
                <strong>{{ trans('users::user.last_seen') }}</strong>
                <input class="form-control" type="text" value="{{ $user->updated_at->format('H:i d.m.Y') }}" disabled>
            </div>

            <div class="row form-group">
                <strong>{{ trans('users::user.groups') }}</strong>
                <input class="form-control" type="text" value="{{ $user->groups->pluck('name')->implode(', ') }}" disabled>
            </div>

            <div class="row form-group">
                <button class="btn btn-success btn-block" type="submit">
                    Изменить пользователя
                </button>
            </div>
        </div>
    </div>
</form>