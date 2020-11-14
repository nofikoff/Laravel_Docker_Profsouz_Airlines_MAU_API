<?php

namespace App\Http\Middleware;

use Closure;

class PostAuthorizationMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('Authorization')) {
            $request->headers->set('Authorization',$request->get('Authorization'));
            $request->headers->add(['Authorization' => $request->get('Authorization')]);
            $request->request->remove('Authorization');
        }

        return $next($request);
    }
}
