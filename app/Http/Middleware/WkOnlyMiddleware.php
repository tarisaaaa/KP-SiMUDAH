<?php

namespace App\Http\Middleware;

use Closure;

class WkOnlyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->role != 'wk') {
            return abort(401, 'Tindakan ini tidak diizinkan');
        }
        return $next($request);
    }
}
