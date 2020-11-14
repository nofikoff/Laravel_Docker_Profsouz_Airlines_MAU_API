@extends('admin::layouts.master')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('admin::groups.edit-title') }}</strong>
                </div>
                <form method="post">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="hf-email">{{ trans('admin::groups.group-name') }}</label>
                            <div class="col-md-9">
                                <input type="text" id="hf-email" name="name" class="form-control"
                                       placeholder="{{ trans('admin::groups.group-name-pl') }}" value="{{ $group->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <table class="table table-responsive-sm">
                                <thead>
                                <tr>
                                    <th>{{ trans('users::user.avatar') }}</th>
                                    <th>{{ trans('users::user.full-name') }}</th>
                                    <th>{{ trans('users::user.phone') }}</th>
                                    <th>{{ trans('users::user.position') }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="userTable">
                                @foreach($group->users as $user)
                                    <tr data-user="{{ $user->id }}">
                                        <td>
                                            <img src="{{ $user->avatar }}" class="rounded-circle" alt="" width="40px">
                                        </td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->position }}</td>
                                        <td>
                                            <a class="btn btn-danger btn-remove">{{ trans('admin::groups.remove') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> {{ trans('admin::groups.submit') }}
                        </button>
                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> {{ trans('admin::groups.remove') }}</button>
                    </div>
                </form>
                <div class="card-body">
                    <div class="form-group row">
                        <form style="display: flex;width: 100%">
                            <label class="col-md-2 col-form-label" for="username">{{ trans('users::user.username') }}</label>
                            <div class="col-md-8">
                                <input type="text" id="username" name="search" class="form-control"
                                       placeholder="{{ trans('admin::groups.username-pl') }}..." value="{{ Request::get('search') }}">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary">{{ trans('admin::groups.search') }}</button>
                            </div>
                        </form>
                    </div>
                    @if(Request::get('search'))
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>{{ trans('users::user.avatar') }}</th>
                                <th>{{ trans('users::user.full-name') }}</th>
                                <th>{{ trans('users::user.phone') }}</th>
                                <th>{{ trans('users::user.position') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr data-user="{{ $user->id }}">
                                    <td><img src="{{ $user->avatar }}" class="rounded-circle" alt="" width="40px"></td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->position }}</td>
                                    <td>
                                        <button class="btn btn-success btn-add">{{ trans('admin::groups.add') }}</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <script>
        window.onload = function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-remove').on('click', function () {
                var user_id = $(this).parent().parent().attr('data-user');

                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.group.user', ['id' => $group->id]) }}",
                    data: {user_id: user_id},
                }).done(function (msg) {
                    $('#userTable').find('tr').each(function () {
                        if ($(this).attr('data-user') === user_id)
                            $(this).remove()
                    })
                });
            })


            $('.btn-add').on('click', function () {
                var user_id = $(this).parent().parent().attr('data-user');

                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.group.user', ['id' => $group->id]) }}",
                    data: {user_id: user_id},
                }).done(function (msg) {
                    location.reload()
                });
            })
        }</script>
@endsection