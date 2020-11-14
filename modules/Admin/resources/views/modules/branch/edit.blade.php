@extends('admin::layouts.master')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('admin::branch.edit-title') }}</strong>
                </div>
                <form method="post" class="form-horizontal">
                    <div class="card-body">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"
                                   for="text-input">{{ trans('admin::branch.name') }}</label>
                            <div class="col-md-9">
                                <input type="text" id="text-input" name="name" class="form-control"
                                       placeholder="{{ trans('admin::branch.name-pl') }}" value="{{ $branch->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"
                                   for="textarea-input">{{ trans('admin::branch.description') }}</label>
                            <div class="col-md-9">
                                <textarea id="textarea-input" name="description" rows="7" class="form-control"
                                          placeholder="{{ trans('admin::branch.description-pl') }}...">{{ $branch->description }}</textarea>
                            </div>
                        </div>
                        @include('admin::modules.branch.form._parent')
                        @include('admin::modules.branch.form._type')

                        <div class="form-group row" style="{{ $branch->parent_id ?: 'display: none;' }}">
                            <label class="col-md-3 col-form-label"
                                   for="checkbox-inherit">{{ trans('admin::branch.inherit_info') }}</label>
                            <div class="col-md-9 pt-2">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="is_inherit" type="checkbox" id="checkbox-inherit"
                                               value="1"
                                                {{ $branch->is_inherit ? ' checked' : '' }}>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary">
                            <i class="fa fa-dot-circle-o"></i> {{ trans('admin::branch.submit') }}
                        </button>
                        <button type="reset" class="btn btn-sm btn-danger">
                            <i class="fa fa-ban"></i> {{ trans('admin::branch.reset') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="groupPermission">
    </div>

    @include('admin::modules.branch.form._js')
@endsection