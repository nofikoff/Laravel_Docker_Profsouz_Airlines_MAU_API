@extends('admin::layouts.master')

@php
    $user_posts = $user->posts()->list()->orderByDesc('created_at')->paginate(10);
    $logs = $user->logs()->with([
            'entity' => function ($query) {
                $query->withTrashed();
            }
        ])->orderByDesc('created_at')->paginate(10,['*'],'page_log');
@endphp

@section('content')
    <div class="col-sm-12 profile">
        <div class="row card">
            <div class="card-header">
                <strong>{{ trans('users::user.profile_title') }}</strong>
            </div>
            <div class="card-body">

                @include('admin::modules.users.components._form')
                @include('admin::modules.users.components._confirmed')

            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-12 profile">
            <div class="card">

                @include('admin::modules.users.components._roles')

            </div>
        </div>

    </div>

    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @foreach($logs as $log)

                        <div class="container">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        @include('admin::modules.log._'.$log->type)
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    {{ $logs->appends(\Illuminate\Support\Facades\Input::all())->links('pagination') }}
                </div>
            </div>
        </div>
    </div>

    @foreach($user_posts as $post)
        <div class="row">
            <div class="col-md-12">
                @include('posts::_item')
            </div>
        </div>
    @endforeach

    {{ $user_posts->links('pagination') }}

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
    <script src="{{ asset('assets/js/comments.js') }}"></script>
    <script>
        $('.birth-date').datetimepicker({
            format: "Y-m-d"
        });
    </script>
@endpush