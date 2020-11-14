@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-md-6">{{ trans('posts::create.title') }} {{ trans('posts::list.create_' . \Request::route('type')) }}</div>
                    </div>

                </div>

                <div class="card-body">

                    @include('posts::form.index', ['action' => route('posts.store'), 'post' => new \Modules\Posts\Entities\Post()])

                </div>
            </div>
        </div>
    </div>

@endsection
