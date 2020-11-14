@extends('layouts.master')

@section('content')
    <div class="col-sm-12 profile">
        <div class="row card">
            <div class="card-header">
                <strong>{{ trans('users::setting.notifications.title') }}</strong>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($branches as $branch)
                        @include('users::settings._branch')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

