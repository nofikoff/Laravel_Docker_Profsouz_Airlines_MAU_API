<li class="nav-item dropdown" style="padding-right:60px;">
    <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('assets/svg/flags/' . App::getLocale() . '.svg') }}" style="width:26px; margin-top:-2px;">
    </a>
    <ul class="dropdown-menu dropdown-menu-right">

        @foreach(explode(',',env('SETTINGS_LOCALES')) as $lang)
            <a href="{{ route('lang', $lang) }}" class="dropdown-item">
                <img src="{{ asset('assets/svg/flags/'.$lang.'.svg') }}"
                     style="width:26px; margin-top:-2px;"> {{ strtoupper($lang) }}
            </a>
        @endforeach

    </ul>
</li>