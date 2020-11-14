@extends('admin::layouts.master')

@section('content')

    <div class="row">

        <div class="col-md-8 offset-2">

            <div class="card">

                <div class="card-body">

                    @include('admin::modules.premoderation.components._list')
                    {{ $posts->links('pagination') }}

                </div>

            </div>

        </div>

    </div>

@stop

@push('js')
    <script src="{{ asset('assets/js/a-posts.js') }}"></script>
    <script src="{{ asset('assets/js/posts.js') }}"></script>
    <script src="{{ asset('assets/js/comments.js') }}"></script>
@endpush