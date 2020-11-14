@extends('layouts.master')

@section('content')
    <div class="col-sm-12 profile">
        <form method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('users::user.edit_title') }}</strong>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label for="first_name">{{ trans('users::user.fname') }}</label>
                                <input type="text" class="form-control latin" id="first_name" name="first_name"
                                       value="{{ $user->first_name }}" required placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="last_name">{{ trans('users::user.lname') }}</label>
                                <input type="text" class="form-control latin" id="last_name" name="last_name"
                                       value="{{ $user->last_name }}" required placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="phone">{{ trans('users::user.phone') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       value="{{ $user->phone }}" placeholder="+38 (0__) ___-__-__">
                            </div>
                        </div>
                        <div class="col-3" id="img_block">
                            <img src="{{ asset($user->avatar) }}" alt="" class="img">
                            <input type="file" id="file-input" name="image">
                            <div class="btn btn-info retweet">
                                <i class="fa fa-retweet" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-3 hidden" id="camera_block">
                            <div id="my_camera" class="img"></div>
                            <div class="btn btn-success"><i class="fa fa-camera"></i></div>

                            <div class="btn btn-info retweet">
                                <i class="fa fa-retweet" aria-hidden="true"></i>
                            </div>
                            <input type="hidden" name="webcam">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="birth">{{ trans('users::user.birth_date') }}</label>
                        <input type="text" class="form-control datepicker" id="birth" name="birthday"
                               value="{{ $user->birthday }}"
                               placeholder="{{ $user->birthday ? '' : trans('users::user.undefined') }}">
                    </div>

                    <div class="form-group">
                        <label for="position">{{ trans('users::user.position') }}</label>
                        <input type="text" class="form-control" id="position" name="position"
                               value="{{ $user->position }}"
                               placeholder="{{ $user->position ? '' : trans('users::user.undefined') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">{{ trans('users::user.password') }}</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">{{ trans('users::user.cpassword') }}</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                               placeholder="">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fa fa-dot-circle-o"></i> {{ trans('users::user.confirm_alt') }}
                    </button>
                    <button type="reset" class="btn btn-sm btn-danger"><i
                                class="fa fa-ban"></i> {{ trans('users::user.reset') }}</button>
                </div>
            </div>
        </form>
    </div>

    <style>
        .profile .card-body .col-3 .img {
            height: 213px;
            max-width: 100%;
        }
    </style>
@endsection

@push('js')
    <script src="{{ asset('assets/vendors/js/webcam.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/jquery.maskedinput.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#phone").mask("+38 (099) 999-99-99");

            $('.retweet').on('click', function() {
                $('#img_block').toggleClass('hidden')
                $('#camera_block').toggleClass('hidden')
            })

            $('.fa-camera').on('click', function () {
                Webcam.snap( function(data_uri) {
                    $('input[name="webcam"]').val(data_uri)
                } );
            })

            $('.latin').bind('keyup',function(){
                $(this).val($(this).val().replace(/[^a-z ]/i, ""))
            });
        })

        Webcam.set({
            width: 320,
            height: 240,
            dest_width: 640,
            dest_height: 480,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');

        $.datetimepicker.setLocale('{{ App::getLocale() }}');

        $('.datepicker').datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
        });
    </script>
@endpush