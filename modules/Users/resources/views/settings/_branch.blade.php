<div class="list-group-item list-group-item-action {{ !$branch->access_notify ? 'list-group-item-secondary' : ''}}">
    <div class="row">
        <div class="col-md-4">
            <div>
                {{ $branch->name }}
                @if(optional($branch->pivot)->key)
                    <small>
                        ({{ trans('users::setting.notifications.'. ($branch->pivot->value ? 'urgent' : 'none_urgent')) }}
                        )
                    </small>
                @endif
            </div>
            <div>
                <ul>
                    @if($branch->parent)
                        <li>
                            <b>{{ trans('users::setting.notifications.parent_branch') }}: </b>
                            {{ $branch->parent->name }}
                        </li>
                    @endif
                    <li>
                        <b>{{ trans('users::setting.notifications.last_entity_date') }}: </b>
                        @if($branch->posts()->published()->exists())
                            {{ $branch->posts()->published()->latest()->first()->created_at }}
                        @elseif($branch->documents()->published()->exists())
                            {{ $branch->documents()->published()->latest()->first()->created_at }}
                        @else
                            {{ trans('users::setting.notifications.branch_empty') }}
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            @if($branch->follow)
                <form action="{{ route('settings.notifications.branch.unfollow') }}"
                      method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                    <button class="btn btn-danger"
                            type="submit" {{ $branch->access_notify ? :'disabled' }}>{{ trans('users::setting.notifications.unfollow') }}</button>
                </form>
            @else
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            {{ $branch->access_notify ? :'disabled' }}
                    >{{ trans('users::setting.notifications.follow') }}</button>
                    <div class="dropdown-menu">
                        <form action="{{ route('settings.notifications.branch.follow') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                            <input type="hidden" name="urgent" value="1">
                            <button type="submit"
                                    class="dropdown-item">{{ trans('users::setting.notifications.urgent') }}</button>
                        </form>
                        <form action="{{ route('settings.notifications.branch.follow') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                            <input type="hidden" name="urgent" value="0">
                            <button type="submit"
                                    class="dropdown-item">{{ trans('users::setting.notifications.none_urgent') }}</button>
                        </form>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>