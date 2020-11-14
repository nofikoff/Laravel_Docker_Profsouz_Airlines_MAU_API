@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @include('posts::_header', ['title' => $branch->name,
                'disable_create' => !Auth::user()->can('posting', $branch), 'active_branch' => $branch])
                @include('posts::components._navigation', ['active_branch' => $branch])
                <div class="card-body">
                    @include('posts::_system_posts')
                    {!! $branch->description !!}
                    @include('posts::_list')
                    {{ $posts->appends(\Input::except('page'))->links('pagination') }}
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="{{ asset('assets/js/posts.js') }}"></script>
    <script src="{{ asset('assets/js/comments.js') }}"></script>
@endpush
