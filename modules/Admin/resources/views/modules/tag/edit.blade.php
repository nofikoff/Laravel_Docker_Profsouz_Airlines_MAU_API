@extends('admin::layouts.master')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('admin::tag.edit') }} {{ $tag->name }}</strong>
                </div>
                @include('admin::modules.tag._form')
            </div>
        </div>
    </div>

@endsection