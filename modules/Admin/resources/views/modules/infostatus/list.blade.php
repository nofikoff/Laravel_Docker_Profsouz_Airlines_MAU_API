@extends('admin::layouts.master')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">

                        <div class="col-md-12 text-right">
                            <a class="btn btn-success" href="{{ route('admin.infostatus.create') }}" style="margin-top:0px;">
                                <i class="fa fa-plus-circle"></i> {{ trans('admin::infostatuses.create') }}
                            </a>

                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th><img src="{{ asset('assets/svg/flags/ru.svg') }}" style="width:20px;"></th>
                            <th><img src="{{ asset('assets/svg/flags/uk.svg') }}" style="width:20px;"></th>
                            <th><img src="{{ asset('assets/svg/flags/en.svg') }}" style="width:20px;"></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($statuses as $status)
                            <tr>
                                <td>
                                    {{ $status->ru }}
                                </td>
                                <td>
                                    {{ $status->uk }}
                                </td>
                                <td>
                                    {{ $status->en }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.infostatus.edit', ['id' => $status->id]) }}"
                                       class="btn btn-primary">{{ trans('admin::infostatuses.edit') }}</a>

                                    <form action="{{ route('admin.infostatus.delete', ['id' => $status->id]) }}"
                                          style="display: inline-block;" method="POST">
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger">{{ trans('admin::infostatuses.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection