@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @include('posts::_header', ['title' => trans('posts::list.title')])
                @include('posts::components._navigation')
                <div class="card-body">
                    @include('posts::_system_posts')
                    @foreach($branches_posts as $branch_name => $posts)
                        <h4>{{ $branch_name }}</h4>
                        @include('posts::_list')
                        <hr>
                    @endforeach
                    {{ $links }}
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="{{ asset('assets/js/posts.js') }}"></script>
    <script src="{{ asset('assets/js/comments.js') }}"></script>
@endpush
