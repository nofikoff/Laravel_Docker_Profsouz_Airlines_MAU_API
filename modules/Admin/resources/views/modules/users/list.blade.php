@extends('admin::layouts.master')

@section('content')
        <div class="col-12">

            <div class="card">
                <div class="card-header">

                    @include('admin::modules.users.components._search')

                </div>

                <div class="card-header text-center">

                    @include('admin::modules.users.components._search_settings')

                </div>

                <div class="card-body">
                    @if (!count($users))
                        <h4 class="text-center">{{ trans('admin::master.empty_search') }}</h4>
                    @else
                        @include('admin::modules.users.components._user_item')
                    @endif
                </div>

            </div>

            {{ $users->appends(Request::except('page'))->links('pagination') }}

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