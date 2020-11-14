@extends('layouts.master')

@php
    $user_posts = $user->posts()->userReadBranches()->published()->list()->orderByDesc('created_at')->paginate(10);
@endphp

@section('content')
    <div class="col-sm-12 profile">
        <div class="row card">
            <div class="card-header">
                <strong>{{ trans('users::user.profile_title') }}</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="form-group">
                            <label for="first_name">{{ trans('users::user.fname') }}</label>
                            <p class="form-control-static" id="first_name">{{ $user->first_name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{ trans('users::user.lname') }}</label>
                            <p class="form-control-static" id="last_name">{{ $user->last_name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{ trans('users::user.phone') }}</label>
                            <p class="form-control-static" id="last_name">{{ $user->phone }}</p>
                        </div>
                        <div class="form-group">
                            <label for="position">{{ trans('users::user.position') }}</label>
                            <p class="form-control-static" id="position">
                                {{ $user->position ? $user->position : trans('users::user.undefined') }}
                            </p>
                        </div>

                        @if ($user->birthday)
                        <div class="form-group">
                            <label for="position">{{ trans('users::user.birth_date') }}</label>
                            <p class="form-control-static" id="position">
                                {{ $user->show_birthday }}
                            </p>
                        </div>
                        @endif

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
                @if($user->groups)
                    <div class="form-group">
                        <label for="group_list">{{ trans('users::user.group') }}</label>
                        <p class="form-control-static"
                           id="group_list">{{ $user->groups->pluck('name')->implode(', ') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('users::partials.comments')
    @include('users::partials.posts')

    <style>
        .profile .card-body .col-3 img {
            height: 300px;
            max-width: 100%;
        }

        .profile .card-body .form-control-static {
            font-weight: bold;
        }
    </style>
@endsection


@push('js')
    <script src="{{ asset('assets/js/posts.js') }}"></script>
    <script src="{{ asset('assets/js/comments.js') }}"></script>
@endpush