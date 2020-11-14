@extends('admin::layouts.master')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('admin::groups.create-title') }}</strong>
                </div>
                <form method="post">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="hf-email">{{ trans('admin::groups.group-name') }}</label>
                            <div class="col-md-9">
                                <input type="text" id="hf-email" name="name" class="form-control"
                                       placeholder="{{ trans('admin::groups.group-name-pl') }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fa fa-dot-circle-o"></i> {{ trans('admin::groups.create-button') }}
                        </button>
                        <button type="reset" class="btn btn-sm btn-danger">
                            <i class="fa fa-ban"></i> {{ trans('admin::groups.reset') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection