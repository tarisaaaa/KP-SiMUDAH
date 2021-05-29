<?php

namespace App\Http\Middleware;

use Closure;

class AdminKeuanganAndPembinaOnlyMiddleware
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
        if ($request->user()->role != 'wk' && $request->user()->role != 'pembina') {
            return abort(401, 'Tindakan ini tidak diizinkan');
        }  
        return $next($request);
    }
}
