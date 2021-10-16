<?php

namespace App\Http\Middleware;

use Closure;

class UserOnlyMiddleware
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
        $id = $request->route('profile');
        if ($request->user()->id != $id) {
            return abort(401, 'Tindakan ini tidak diizinkan');
        }
        return $next($request);
    }
}
