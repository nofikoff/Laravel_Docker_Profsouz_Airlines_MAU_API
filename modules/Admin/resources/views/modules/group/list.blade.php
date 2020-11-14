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
                                        <input type="text" class="form-control" name="search" placeholder="{{ trans('admin::groups.search-pl') }}">
                                        <span class="input-group-append">
                                            <button class="btn btn-primary" style="margin-top: 0;">{{ trans('admin::groups.search') }}</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-4 text-right">
                            <a class="btn btn-success" href="{{ route('admin.group.create') }}" style="margin-top:0px;">
                                <i class="fa fa-plus-circle"></i> {{ trans('admin::groups.create-button') }}
                            </a>

                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th>{{ trans('admin::groups.group-name') }}</th>
                            <th style="width:50%;">{{ trans('admin::groups.group-count') }}</th>
                            <th>{{ trans('admin::groups.settings') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td>{{ $group->name }}</td>
                                <td>
                                    <small>{{ $group->users->pluck('full_name')->implode(', ') }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('admin.group.edit', ['id' => $group->id]) }}"
                                       class="btn btn-primary">{{ trans('admin::groups.edit') }}</a>

                                    <form action="{{ route('admin.group.destroy', ['id' => $group->id]) }}"
                                          style="display: inline-block;" method="POST">
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger">{{ trans('admin::groups.remove') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $groups->appends(\Illuminate\Support\Facades\Input::all())->links('pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection