@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-9">
            <div class="card">

                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            @include('documents::components.search_input')
                        </div>

                        @if(isset($active_branch) ? Auth::user()->can('posting', $active_branch) : true)
                            <div class="col-md-4 text-right">
                                <a class="btn btn-success" href="{{ route('documents.create') }}" style="margin-top:0px;">
                                    <i class="fa fa-plus-circle"></i> {{ trans('documents::master.add-button') }}
                                </a>
                            </div>
                        @endif

                    </div>

                </div>
                <div class="card-body">
                    @include('documents::_list')
                    {!!  $documents->links('pagination') !!}
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            @include('documents::components.branches')
        </div>
    </div>

@stop

@push('js')
    <script src="{{ asset('assets/js/posts.js') }}"></script>
@endpush
