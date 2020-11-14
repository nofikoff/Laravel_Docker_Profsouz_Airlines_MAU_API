@extends('layouts.master')

@section('content')

    <div class="container">

        <div class="col-12">

            <div class="card">
                <div class="card-header">

                    <form method="GET" class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search"
                                       value="{{ Request::get('search') }}" placeholder="{{ trans('users::pages.search-text') }}">
                                <span class="input-group-append">
<button type="button" class="btn btn-primary" style="margin-top: 0;">{{ trans('users::pages.search-button') }}</button>
</span>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="card-body">
                    @foreach($users as $user)
                        <div class="col-sm-12 profile">
                            <div class="row card">
                                <div class="card-header">
                                    <strong>
                                        <a href="{{ route('profile', ['id' => $user->id]) }}">{{ $user->full_name }}
                                          <small>{{ count($user->roles) ? '(' . $user->roles->pluck('display_name')->implode(', ') . ')' : '' }}</small>
                                        </a>
                                    </strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label for="last_name">{{ trans('users::user.phone') }}</label>
                                                <p class="form-control-static" id="last_name">{{ $user->phone }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="position">{{ trans('users::user.position') }}</label>
                                                <p class="form-control-static" id="position">{{ $user->position ? $user->position : trans('users::user.undefined') }}</p>
                                            </div>

                                            <div class="form-group">
                                                <label for="last_online">{{ trans('users::user.last_seen') }}</label>
                                                <p class="form-control-static"
                                                   id="last_online">{{ $user->updated_at->format('H:i d.m.Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <img src="{{ $user->avatar }}" alt="">
                                        </div>
                                    </div>
                                    @if(count($user->roles))
                                        <div class="form-group">
                                            <label for="group_list">{{ trans('users::user.roles') }}</label>
                                            <p class="form-control-static"
                                               id="group_list">{{ count($user->roles) ? '(' . $user->roles->pluck('display_name')->implode(', ') . ')' : trans('users::user.hasnot_groups') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            {{ $users->links('pagination') }}

        </div>
    </div>

    <style>
        .profile .card-body .col-3 img {
            height: 170px;
            max-width: 100%;
        }

        .profile .card-body .form-control-static {
            font-weight: bold;
        }
    </style>
@endsection
