@extends('users::layouts.app')

@section('content')

    <div class="col-md-6">
        <div class="card mx-4">
            <div class="card-body p-4">
                <form action="{{ route('register') }}" method="POST">
                    {{ csrf_field() }}
                    <h1>{{ trans('auth.register-title') }}</h1>
                    <p class="text-muted">{{ trans('auth.register-subtitle') }}</p>

                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-user"></i></span>
                        </div>
                        <input type="text" name="first_name" class="form-control latin"
                               placeholder="{{ trans('auth.register-fname') }}"
                               value="{{ old('first_name') }}" required>
                    </div>

                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-user"></i></span>
                        </div>
                        <input type="text" name="last_name" class="form-control latin"
                               placeholder="{{ trans('auth.register-lname') }}"
                               value="{{ old('last_name') }}" required>
                    </div>

                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-phone"></i></span>
                        </div>
                        <input type="text" name="phone" class="form-control" placeholder="+38 (0__) ___-__-__"
                               value="{{ old('last_name') }}" required id="phone">
                    </div>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="{{ trans('auth.auth-password') }}">
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                        </div>
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="{{ trans('auth.register-repeat') }}">
                    </div>
                    <button type="submit" class="btn btn-block btn-success">{{ trans('auth.register-create') }}</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        jQuery(function($) {
            $("#phone").mask("+38 (099) 999-99-99");

            $('.latin').bind('keyup',function(){
                $(this).val($(this).val().replace(/[^a-z ]/i, ""))
            });
        });
    </script>
@endsection