<?php

namespace ClassyPOS\Http;

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
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \ClassyPOS\Http\Middleware\SetLocale::class,
    ];
    

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \ClassyPOS\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \ClassyPOS\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
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
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \ClassyPOS\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'admin' => \ClassyPOS\Http\Middleware\waqar::class,
        'sale'  =>  \ClassyPOS\Http\Middleware\salesman::class,
        'customerdelete'  =>  \ClassyPOS\Http\Middleware\CustomerDelete::class,
        'Role'  =>            \ClassyPOS\Http\Middleware\RoleMiddleWare::class,
        'Role2'  =>           \ClassyPOS\Http\Middleware\RoleMiddleWare2::class,
        'Role3'  =>           \ClassyPOS\Http\Middleware\RoleMiddleWare3::class,
    ];
}
