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
    <link href="{{ asset('assets/libs/noty/noty.css') }}" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- Custom styles for this application -->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    @stack('css')
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
                <img src="{{ \Auth::user()->avatar }}" class="img-avatar" alt="">
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
                <a class="dropdown-item" href="{{ route('setting.notifications') }}"><i
                            class="fa fa-wrench"></i> {{ trans('navigation.nav_option_setting_notifications') }}</a>
                {{--<a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="badge badge-secondary">42</span></a>--}}
                {{--<a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a>--}}
                <div class="divider"></div>
                {{--<a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>--}}
                <a class="dropdown-item" href="{{ route('logout') }}"><i
                            class="fa fa-lock"></i> {{ trans('navigation.nav_option_logout') }}</a>
                {{--<form action="{{ route('logout') }}" method="POST">--}}
                {{--                    {{ csrf_field() }}--}}
                {{--<button type="submit" class="dropdown-item"><i--}}
                {{--class="fa fa-lock"></i> {{ trans('navigation.nav_option_logout') }}</button>--}}
                {{--</form>--}}
            </div>
        </li>
    </ul>

</header>
<div class="app-body">

    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    @if(\Auth::user() && \Auth::user()->is_admin())
                        <a class="nav-link" href="{{ route('admin') }}">
                            <i class="fa fa-id-card"></i>{{ trans('navigation.admin') }}
                        </a>
                    @endif

                    @if(Auth::user()->is_editor() || (isset($active_branch)
                     && Auth::user()->can('publishing', $active_branch)))
                        <a class="nav-link" href="{{ route('posts.premoderate') }}">
                            <i class="fa fa-address-card"></i>{{ trans('posts::navigation.premoderate') }}
                        </a>
                @endif

                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-code-fork"></i>
                        {{ trans('posts::navigation.branches') }}
                    </a>
                    <ul class="nav-dropdown-items">

                        @include('posts::components._branches', ['branches' => \Modules\Posts\Entities\Branch::userRead()->root()->postable()->get()])
                        <li class="nav-item">
                            <a class="nav-link" href="notifications-alerts.html"><i class="icon-bell"></i> Alerts</a>
                        </li>
                    </ul>
                </li>

                <a class="nav-link" href="{{ route('posts.my') }}">
                    <i class="fa fa-address-card"></i>
                    {{ trans('posts::navigation.my_posts') }}
                </a>

                <a class="nav-link" href="{{ route('posts.index') }}">
                    <i class="fa fa-list-alt"></i>{{ trans('navigation.list_posts') }}
                </a>

                {{--<a class="nav-link"--}}
                {{--href="{{ route('posts.create', ['type' => \Modules\Posts\Entities\Branch::TYPE_FINN_HELP]) }}">--}}
                {{--<i class="fa fa-list-alt"></i>{{ trans('navigation.finn_help') }}--}}
                {{--</a>--}}

                <a class="nav-link"
                   href="{{ route('posts.create', \Modules\Posts\Entities\Post::TYPE_FINN_HELP) }}">
                    <i class="fa fa-list-alt"></i>{{ trans('navigation.finn_help') }}
                </a>

                <a class="nav-link" href="{{ route('users') }}">
                    <i class="fa fa-users"></i>{{ trans('navigation.list_users') }}
                </a>

                <a class="nav-link" href="{{ route('documents.index') }}">
                    <i class="fa fa-file-text"></i>{{ trans('navigation.list_documents') }}
                </a>

                <a class="nav-link" href="{{ route('user.notifications') }}">
                    <i class="fa fa-bell"></i>{{ trans('navigation.notifications') }}
                </a>

                @foreach(\Modules\Main\Entities\Page::published()->ordered()->get() as $page)
                    <a class="nav-link" href="{{ route('page.show', $page->alias) }}">
                        <i class="fa fa-file"></i>{{ $page->title }}
                    </a>
                @endforeach

                </li>

            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>

    <!-- Main content -->
    <main class="main">

        {{--<ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>

            <li class="breadcrumb-menu d-md-down-none">
                <div class="btn-group" role="group" aria-label="Button group">
                    <a class="btn" href="#"><i class="icon-speech"></i></a>
                    <a class="btn" href="./"><i class="icon-graph"></i> &nbsp;Dashboard</a>
                    <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>
                </div>
            </li>
        </ol>--}}
        <br>

        <div class="container-fluid">
            @yield('content')

        </div>
    </main>

</div>

<footer class="app-footer">
    <span><a href="http://coreui.io">CoreUI</a> &copy; 2018 creativeLabs.</span>
    <span class="ml-auto">Powered by <a href="http://coreui.io">CoreUI</a></span>
</footer>

<!-- Bootstrap and necessary plugins -->
<script src="{{ asset('assets/vendors/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/pace.min.js') }}"></script>
<script src="{{ asset('assets/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/vendors/js/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/jquery.maskedinput.min.js') }}"></script>

<script src="{{ asset('assets/libs/sockjs.min.js') }}"></script>
<script src="{{ asset('assets/libs/centrifuge.min.js') }}"></script>
<script src="{{ asset('assets/libs/noty/noty.min.js') }}"></script>
<!-- CoreUI main scripts -->
<script src="{{ asset('assets/js/notification.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>

@stack('js')

<script>
            @php($timestamp = (string)time())
            @php($token = app('centrifuge')->generateToken(Auth::id(), $timestamp))

    var centrifuge = new Centrifuge({
            url: '{{ env('CENTRIFUGE_FRONTEND_URL') }}',
            user: "{{ Auth::id() }}",
            timestamp: "{{ $timestamp }}",
            token: "{{ $token }}"
        });

    centrifuge.subscribe("user_{{ Auth::id() }}", function (message) {
        user_norififcation(message.data.message, message.data.url, message.data.type);
    });

    centrifuge.connect();

</script>

@include('users::layouts._noty')


</body>
</html>