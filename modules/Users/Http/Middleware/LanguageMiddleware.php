<?php

namespace Modules\Users\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        \App::setLocale(\Session::get('locale',
            $request->user() ? $request->user()->locale : env('SETTINGS_DEFAULT_LANG')));

        return $next($request);
    }
}
