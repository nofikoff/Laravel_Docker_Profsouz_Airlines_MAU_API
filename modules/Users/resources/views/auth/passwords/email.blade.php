@extends('users::layouts.app')

@section('content')
    <div class="col-md-6">
        <div class="clearfix">
            <h4 class="pt-3">{{ trans('auth.reset-title') }}</h4>
        </div>
        @if (count($errors->all()))
            <div class="alert alert-danger">
                <ul style="margin-bottom:0px; list-style-type: none;padding: 0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}
            <div class="input-prepend input-group">
                <input id="prependedInput" class="form-control" type="text"
                       placeholder="+38 (0__) ___-__-__" name="phone" value="{{ old('phone') }}">
                <span class="input-group-append">
                    <button class="btn btn-info" type="submit">{{ trans('auth.reset-button') }}</button>
                </span>

            </div>
        </form>
    </div>


    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-8 col-md-offset-2">--}}
    {{--<div class="panel panel-default">--}}
    {{--<div class="panel-heading">Reset Password</div>--}}
    {{--<div class="panel-body">--}}
    {{--@if (session('status'))--}}
    {{--<div class="alert alert-success">--}}
    {{--{{ session('status') }}--}}
    {{--</div>--}}
    {{--@endif--}}

    {{--<form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">--}}
    {{--{{ csrf_field() }}--}}

    {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
    {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

    {{--<div class="col-md-6">--}}
    {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

    {{--@if ($errors->has('email'))--}}
    {{--<span class="help-block">--}}
    {{--<strong>{{ $errors->first('email') }}</strong>--}}
    {{--</span>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<div class="col-md-6 col-md-offset-4">--}}
    {{--<button type="submit" class="btn btn-primary">--}}
    {{--Send Password--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
@endsection

@section('javascript')
    <script>
        jQuery(function($) {
            $("#prependedInput").mask("+38 (099) 999-99-99");
        });
    </script>
@endsection
