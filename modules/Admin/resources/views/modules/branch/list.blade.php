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
                                        <input type="text" class="form-control" name="search"
                                               placeholder="{{ trans('admin::branch.search-pl') }}">
                                        <span class="input-group-append">
                                            <button class="btn btn-primary" style="margin-top: 0;">
                                                {{ trans('admin::branch.search') }}
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-4 text-right">
                            <a class="btn btn-success" href="{{ route('admin.branch.create') }}" style="margin-top:0px;">
                                <i class="fa fa-plus-circle"></i> {{ trans('admin::branch.button-create') }}
                            </a>

                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th>{{ trans('admin::branch.name') }}</th>
                            <th>{{ trans('admin::branch.parent') }}</th>
                            <th>{{ trans('admin::branch.description') }}</th>
                            <th>
                                <span style="cursor:help;" title="{{ trans('admin::branch.inherit_info') }}">
                                    <i class="fa fa-copy"></i>
                                </span>
                            </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($branches as $branch)

                            @include('admin::modules.branch.list_item')

                        @endforeach
                        </tbody>
                    </table>
                    {{ $branches->appends(\Illuminate\Support\Facades\Input::all())->links('pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection