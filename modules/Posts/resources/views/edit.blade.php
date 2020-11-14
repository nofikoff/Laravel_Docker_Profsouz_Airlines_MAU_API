@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-md-6">{{ trans('posts::edit.title') }} {{ trans('posts::list.create_' . $post->type) }}</div>
                    </div>

                </div>

                <div class="card-body">

                    @include('posts::form.index', [
                    'action' => route('posts.update', compact('post')),
                    'type' => $post->type
                    ])

                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                {{ trans('posts::edit.logs') }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(!empty($last_comments))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    {{ trans('posts::edit.new_comments') }}

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            @include('posts::comments._list', [
                                   'without_children' => true, 'comments' => $last_comments])

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @foreach($logs as $log)

                            {{--@if(!empty($log->comments))--}}
                            @include('posts::form.logs')
                            {{--@endif--}}

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
