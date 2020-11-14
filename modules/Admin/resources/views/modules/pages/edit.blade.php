@extends('admin::layouts.master')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('admin::pages.edit-title') }}</strong>
                </div>
                <form method="post" action="{{ route('admin.pages.update', $page) }}">
                    @method('PUT')
                    {{ csrf_field() }}
                    <div class="card-body">
                        @include('admin::modules.pages._form')
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection