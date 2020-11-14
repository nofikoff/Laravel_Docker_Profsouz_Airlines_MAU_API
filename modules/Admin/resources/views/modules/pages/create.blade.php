@extends('admin::layouts.master')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('admin::pages.create') }}</strong>
                </div>
                <form method="post" action="{{ route('admin.pages.store') }}">
                    {{ csrf_field() }}
                    <div class="card-body">
                        @include('admin::modules.pages._form', ['page' => new \Modules\Main\Entities\Page()])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection