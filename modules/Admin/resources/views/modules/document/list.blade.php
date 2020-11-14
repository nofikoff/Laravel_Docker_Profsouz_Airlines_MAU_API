@extends('admin::layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-8 offset-2">
            <div class="card">

                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <form method="GET" action="{{ route('admin.document.search') }}" class="form-group row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                               value="{{ Request::get('search') }}" placeholder="{{ trans('users::pages.search-text') }}">
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-primary" style="margin-top: 0;">{{ trans('users::pages.search-button') }}</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-4 text-right">
                            <a class="btn btn-success" href="{{ route('documents.create') }}" style="margin-top:0px;">
                                <i class="fa fa-plus-circle"></i> {{ trans('documents::master.add-button') }}
                            </a>

                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('admin::modules.document._list')
                    {!!  $documents->links('pagination') !!}
                </div>
            </div>
        </div>
    </div>

@stop

@push('js')
    <script src="{{ asset('assets/js/posts.js') }}"></script>
@endpush
