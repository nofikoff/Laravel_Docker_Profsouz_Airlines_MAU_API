<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword"
          content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
    <link rel="shortcut icon" href="{{ asset('/assets/img/favicon.png') }}">
    <title>CoreUI - Open Source Bootstrap Admin Template</title>

    <!-- Icons -->
    <link href="{{ asset('assets/vendors/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/css/simple-line-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/css/jquery.datetimepicker.min.css') }}" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>


    {{--<form action="{{ route('search') }}" class="form-inline my-2 my-lg-0 mx-auto">--}}
        {{--<div class="input-group" style="width: 450px">--}}
            {{--<input type="text" id="search" name="search" class="form-control"--}}
                   {{--placeholder="{{ trans('search.placeholder') }}" value="{{ request('search') }}">--}}
            {{--<span class="input-group-append">--}}
{{--<button type="button" class="btn btn-primary">{{ trans('search.submit') }}</button>--}}
{{--</span>--}}
        {{--</div>--}}
    {{--</form>--}}

    {{--<ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="#">Dashboard</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="#">Users</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="#">Settings</a>
        </li>
    </ul>--}}

    <ul class="nav navbar-nav ml-auto">
        {{--<li class="nav-item d-md-down-none">
            <a class="nav-link" href="#"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
        </li>
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#"><i class="icon-list"></i></a>
        </li>
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
        </li>--}}
        @include('layouts._languages')
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false">
                <img src="{{ \Auth::user()->avatar }}" class="img-avatar" alt="admin@bootstrapmaster.com">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                {{--<div class="dropdown-header text-center">--}}
                {{--<strong>Account</strong>--}}
                {{--</div>--}}
                {{--<a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></a>--}}
                {{--<a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></a>--}}
                {{--<a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></a>--}}
                {{--<a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></a>--}}
                <div class="dropdown-header text-center">
                    <strong>{{ trans('navigation.nav_text') }}</strong>
                </div>
                <a class="dropdown-item" href="{{ route('profile') }}"><i
                            class="fa fa-user"></i> {{ trans('navigation.nav_option_profile') }}</a>
                <a class="dropdown-item" href="{{ route('account') }}"><i
                            class="fa fa-wrench"></i> {{ trans('navigation.nav_option_settings') }}</a>
                {{--<a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="badge badge-secondary">42</span></a>--}}
                {{--<a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a>--}}
                <div class="divider"></div>
                {{--<a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>--}}
                <form action="{{ route('logout') }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="dropdown-item"><i
                                class="fa fa-lock"></i> {{ trans('navigation.nav_option_logout') }}</button>
                </form>
            </div>
        </li>
    </ul>

</header>
<div class="app-body">

    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">

                    <a class="nav-link" href="/">
                        <i class="fa fa-sitemap"></i>{{ trans('admin::navigation.site') }}
                    </a>

                    <a class="nav-link" href="{{ route('admin.users.list') }}">
                        <i class="fa fa-users"></i>{{ trans('admin::navigation.users') }}
                    </a>

                    <a class="nav-link" href="{{ route('admin.group.list') }}">
                        <i class="fa fa-group"></i>{{ trans('admin::navigation.group') }}
                    </a>

                    <a class="nav-link" href="{{ route('admin.branch.list') }}">
                        <i class="fa fa-code-fork"></i>{{ trans('admin::navigation.branches') }}
                    </a>

                    <a class="nav-link" href="{{ route('admin.infostatus.list') }}">
                        <i class="fa fa-check-square-o"></i>{{ trans('admin::navigation.info_statuses') }}
                    </a>

                    <a class="nav-link" href="{{ route('admin.finn_types.index') }}">
                        <i class="fa fa-info"></i>{{ trans('admin::navigation.finn_type') }}
                    </a>

                    <a class="nav-link" href="{{ route('admin.tag.list') }}">
                        <i class="fa fa-tags"></i>{{ trans('admin::navigation.tags') }}
                    </a>

                    <a class="nav-link" href="{{ route('admin.document.list') }}">
                        <i class="fa fa-file-text"></i>{{ trans('admin::navigation.documents') }}
                    </a>

                    {{--<a class="nav-link" href="{{ route('admin.premoderate.list') }}">
                        <i class="fa fa-gavel"></i>{{ trans('admin::navigation.premoderate') }}
                    </a>--}}

                    <a class="nav-link" href="{{ route('admin.vote.list') }}">
                        <i class="fa fa-comments-o"></i>{{ trans('admin::navigation.votes') }}
                    </a>

                    <a class="nav-link" href="{{ route('admin.logs') }}">
                        <i class="fa fa-list"></i>{{ trans('admin::navigation.logs') }}
                    </a>

                    <a class="nav-link" href="{{ route('admin.pages.index') }}">
                        <i class="fa fa-file"></i>{{ trans('admin::navigation.pages') }}
                    </a>

                </li>
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>

    <!-- Main content -->
    <main class="main">

        <br>

        <div class="container-fluid">

            @yield('content')

        </div>
    </main>

</div>

{{--<footer class="app-footer">--}}
{{--<span><a href="http://coreui.io">CoreUI</a> &copy; 2018 creativeLabs.</span>--}}
{{--<span class="ml-auto">Powered by <a href="http://coreui.io">CoreUI</a></span>--}}
{{--</footer>--}}

<!-- Bootstrap and necessary plugins -->
<script src="{{ asset('assets/vendors/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/pace.min.js') }}"></script>
<script src="{{ asset('assets/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/vendors/js/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/jquery.maskedinput.min.js') }}"></script>

<!-- CoreUI main scripts -->

<script src="{{ asset('assets/js/app.js') }}"></script>

@stack('js')


</body>
</html>