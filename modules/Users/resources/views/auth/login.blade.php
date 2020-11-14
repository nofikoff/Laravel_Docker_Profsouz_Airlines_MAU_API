@extends('users::layouts.app')

@section('content')

    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <h1>{{ trans('auth.auth-title') }}</h1>
                        <p class="text-muted">{{ trans('auth.auth-subtitle') }}</p>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                        @endif
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-phone"></i></span>
                            </div>
                            <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                   placeholder="+38 (0__) ___-__-__" name="phone"
                                   value="{{ old('phone') }}" required autofocus id="phone">
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                            </div>
                            <input type="password" name="password" placeholder="{{ trans('auth.auth-password') }}" required
                                   class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"/>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary px-4">{{ trans('auth.auth-login') }}</button>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('password.request') }}" class="btn btn-link px-0">{{ trans('auth.auth-forget') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                <div class="card-body text-center">
                    <div>
                        <h2>{{ trans('auth.auth-signup') }}</h2>
                        <a href="{{ route('register') }}" type="button" class="btn btn-primary active mt-3">{{ trans('auth.auth-register') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-center{
            display: flex;
            align-content: center;
            justify-content: center;
        }

        .text-center h2{
            padding: 25px 0;
        }
    </style>
@endsection

@section('javascript')
<script>
    jQuery(function($) {
        $("#phone").mask("+38 (099) 999-99-99");
    });
</script>
@endsection