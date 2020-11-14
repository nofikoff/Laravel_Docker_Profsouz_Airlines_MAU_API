@extends('admin::layouts.master')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <form method="GET" class="form-group row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="{{ trans('admin::tag.search_placeholder') }}" value="{{ request('search') }}">
                                        <span class="input-group-append">
                                            <button class="btn btn-primary" style="margin-top: 0;">{{ trans('admin::tag.search_button') }}</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-4 text-right">
                            <a class="btn btn-success" href="{{ route('admin.tag.create') }}" style="margin-top:0px;">
                                <i class="fa fa-plus-circle"></i> {{ trans('admin::tag.create') }}
                            </a>

                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th style="width:65%;">{{ trans('admin::tag.field.name') }}</th>
                            <th>{{ trans('admin::tag.field.class') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $tag)

                            @include('admin::modules.tag.list_item')

                        @endforeach
                        </tbody>
                    </table>
                    {{ $tags->appends(\Illuminate\Support\Facades\Input::all())->links('pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection