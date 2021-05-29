<?php

namespace App\Http\Middleware;

use Closure;

class AdminKeuanganOnlyMiddleware
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
        if ($request->user()->role != 'adminkeuangan') {
            return abort(401, 'Tindakan ini tidak diizinkan');
        }  
        return $next($request);
    }
}
