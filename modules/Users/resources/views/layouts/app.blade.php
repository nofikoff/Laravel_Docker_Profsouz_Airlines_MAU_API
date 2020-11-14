<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
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

    <!-- Main styles for this application -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body class="app flex-row align-items-center">
<div class="lang">
    <div class="nav-item dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('assets/svg/flags/' . App::getLocale() . '.svg') }}"
                 style="width:26px; margin-top:-2px;">
        </a>
        <ul class="dropdown-menu dropdown-menu-right">

            @foreach(explode(',',env('SETTINGS_LOCALES')) as $lang)
                <a href="{{ route('lang', $lang) }}" class="dropdown-item">
                    <img src="{{ asset('assets/svg/flags/'.$lang.'.svg') }}"
                         style="width:26px; margin-top:-2px;"> {{ strtoupper($lang) }}
                </a>
            @endforeach

        </ul>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        @yield('content')
    </div>
</div>

<!-- Bootstrap and necessary plugins -->
<script src="{{ asset('assets/vendors/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/pace.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/jquery.maskedinput.min.js') }}"></script>

<!-- CoreUI main scripts -->

<script src="{{ asset('assets/js/app.js') }}"></script>
@yield('javascript')
</body>
<style>
    .lang {
        position: absolute;
        top: 0;
        right: 0;
    }
</style>
</html>