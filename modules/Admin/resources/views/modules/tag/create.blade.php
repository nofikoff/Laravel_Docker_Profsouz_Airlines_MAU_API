@extends('admin::layouts.master')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('admin::tag.create') }}</strong>
                </div>
                @include('admin::modules.tag._form', ['tag' => new \Modules\Posts\Entities\Tag()])
            </div>
        </div>
    </div>

@endsection