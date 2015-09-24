<?php

namespace ApiGfccm\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \ApiGfccm\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \ApiGfccm\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \ApiGfccm\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \ApiGfccm\Http\Middleware\RedirectIfAuthenticated::class,
        'resource' => \ApiGfccm\Http\Middleware\RespondWithResource::class,
        'jwt.auth' => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
        'jwt.refresh' => \ApiGfccm\Http\Middleware\RefreshToken::class,
        'jwt.validate' => \ApiGfccm\Http\Middleware\ValidateToken::class,
        'APIJWT.auth' => \ApiGfccm\Http\Middleware\APIJWTAuth::class
    ];
}
