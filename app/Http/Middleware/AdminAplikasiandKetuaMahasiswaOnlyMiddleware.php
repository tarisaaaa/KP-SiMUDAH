<?php

namespace App\Http\Middleware;

use Closure;

class AdminAplikasiandKetuaMahasiswaOnlyMiddleware
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
        if ($request->user()->role != 'ketuamahasiswa' && $request->user()->role != 'adminaplikasi') {
            return abort(401, 'Tindakan ini tidak diizinkan');
        }
        return $next($request);
    }
}
