@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @include('posts::_header', ['title' => $group->name, 'disable_create' => !Auth::user()->can('posting', $group)])
                @include('posts::components._navigation', ['active_group' => $group])
                <div class="card-body">
                    @include('posts::_system_posts')
                    @include('posts::_list')
                    {{ $posts->links('pagination') }}
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="{{ asset('assets/js/posts.js') }}"></script>
    <script src="{{ asset('assets/js/comments.js') }}"></script>
@endpush
