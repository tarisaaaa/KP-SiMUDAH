<?php

namespace App\Http;

use App\Http\Middleware\AdminAplikasiandKetuaMahasiswaOnlyMiddleware;
use App\Http\Middleware\AdminAplikasiOnlyMiddleware;
use App\Http\Middleware\AdminaplKetuamhsPelatihOnlyMiddleware;
use App\Http\Middleware\AdminKeuanganAndPembinaOnlyMiddleware;
use App\Http\Middleware\AdminKeuanganOnlyMiddleware;
use App\Http\Middleware\AdminOnlyMiddleware;
use App\Http\Middleware\KetuaMahasiswaOnlyMiddleware;
use App\Http\Middleware\PelatihOnlyMiddleware;
use App\Http\Middleware\PembinaOnlyMiddleware;
use App\Http\Middleware\UserOnlyMiddleware;
use App\Http\Middleware\WkOnlyMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'adminaplikasi' => AdminAplikasiOnlyMiddleware::class,
        'adminkeuangan' => AdminKeuanganOnlyMiddleware::class,
        'ketuamahasiswa' => KetuaMahasiswaOnlyMiddleware::class,
        'pelatih' => PelatihOnlyMiddleware::class,
        'pembina' => PembinaOnlyMiddleware::class,
        'wk' => WkOnlyMiddleware::class,
        'adminaplikasiketuamahasiswa' => AdminAplikasiandKetuaMahasiswaOnlyMiddleware::class,
        'adminaplikasiketuamahasiswapelatih' => AdminaplKetuamhsPelatihOnlyMiddleware::class,
        'adminkeuanganandpembina' => AdminKeuanganAndPembinaOnlyMiddleware::class,
        'userid' => UserOnlyMiddleware::class,
    ];
}
