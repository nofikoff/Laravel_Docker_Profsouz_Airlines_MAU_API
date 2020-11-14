@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @include('posts::_header', ['title' => trans('posts::list.my_posts_title')])
                @include('posts::components._navigation')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach(\Modules\Posts\Entities\Post::statuses() as $status)
                                @if(request('status') == $status)
                                    <button class="btn btn-outline-primary"
                                            disabled>{{ trans('posts::form.'.$status) }}</button>
                                @else
                                    <a class="btn btn-info"
                                       href="{{ request()->fullUrlWithQuery(['status' => $status]) }}">{{ trans('posts::form.'.$status) }}</a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @include('posts::_system_posts')
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
