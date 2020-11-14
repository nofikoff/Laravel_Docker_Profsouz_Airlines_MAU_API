@extends('users::layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="clearfix">
                <h2 class="float-left display-2">Внимание</h2>
                <h5 class="">{{ Auth::user()->full_name }}, Ваш аккаунт не подтверждён!</h5>
                <div style="display: flex;justify-content: center">
                    <a href="{{ route('logout') }}" class="btn btn-danger">Выход</a>
                </div>
            </div>
        </div>
    </div>

@endsection