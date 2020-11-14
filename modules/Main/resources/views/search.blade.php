@extends('layouts.master')

@section('content')

    <div class="row">

        <div class="col-md-9">

            <div class="card">

                @include('posts::_header', ['title' => trans('posts::list.title')])

                {{--<div class="card-header">--}}
                    {{--<form action="{{ route('search') }}" class="form-inline my-2 my-lg-0 mx-auto">--}}
                        {{--<div style="width:100%;">--}}
                            {{--<div class="input-group">--}}
                                {{--<input type="text" id="search" name="search" class="form-control"--}}
                                       {{--placeholder="{{ trans('search.placeholder') }}" value="{{ request('search') }}">--}}
                                {{--<span class="input-group-append">--}}
                                    {{--<button type="submit" class="btn btn-primary" style="margin-top: 0;">{{ trans('users::pages.search-button') }}</button>--}}
                                {{--</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}

                <div class="card-body">

                    @if(count($entities))
                        @foreach($entities as $entity)

                            @if(get_class($entity) == \Modules\Posts\Entities\Post::class)
                                @include('posts::_item', ['post' => $entity])
                            @elseif(get_class($entity) == \Modules\Documents\Entities\Document::class)
                                @include('documents::_item', ['document' => $entity])
                            @endif

                        @endforeach
                    @else
                        {{ trans('search.not_result') }}
                    @endif

                </div>

            </div>

        </div>
    </div>

@stop

@push('js')
<script src="{{ asset('assets/js/posts.js') }}"></script>
<script src="{{ asset('assets/js/comments.js') }}"></script>
@endpush
