@extends('admin::layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-body">
                    @if (count($posts))

                        @include('admin::modules.vote.components._list')
                        {{ $posts->links('pagination') }}
                    @else
                    <h4 class="text-center">Ничего не найдено</h4>
                    @endif

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="{{ asset('assets/js/a-votes.js') }}"></script>
@endpush