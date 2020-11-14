@extends('admin::layouts.master')

@section('content')
    <div class="container">
        <div class="col-6 offset-3">
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('admin::infostatuses.header') }}</strong>
                </div>
                <form method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label" for="input-ru"><img src="{{ asset('assets/svg/flags/ru.svg') }}" style="width:25px;"></label>
                            <div class="col-sm-11">
                                <input type="text" id="input-ru" name="ru" class="form-control"
                                       value="{{ $status->ru }}" placeholder="RU">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label" for="input-uk"><img src="{{ asset('assets/svg/flags/uk.svg') }}" style="width:25px;"></label>
                            <div class="col-sm-11">
                                <input type="text" id="input-uk" name="uk" class="form-control"
                                       value="{{ $status->uk }}" placeholder="UK">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label" for="input-en"><img src="{{ asset('assets/svg/flags/en.svg') }}" style="width:25px;"></label>
                            <div class="col-sm-11">
                                <input type="text" id="input-en" name="en" class="form-control"
                                       value="{{ $status->en }}" placeholder="EN">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fa fa-dot-circle-o"></i> {{ trans('admin::infostatuses.submit') }}
                        </button>
                        <button type="reset" class="btn btn-sm btn-danger">
                            <i class="fa fa-ban"></i> {{ trans('admin::infostatuses.reset') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection