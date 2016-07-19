<?php

use Illuminate\Foundation\Http\Kernel as HttpKernel;


/**
 * Class Kernel
 *
 * Http Kernel for testing. This is bound in at test start in order to
 * selectively remove the auth related middleware, while leaving the
 * format related middleware untouched.
 *
 * This is done due to a limitation in Laravel's test middleware handling
 * which currently does not allow for selective middleware disabling
 *
 * @see https://github.com/laravel/framework/issues/10254
 */
class Kernel extends HttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'guest' => 'ApiGfccm\Http\Middleware\RedirectIfAuthenticated',
        'csrf' => 'ApiGfccm\Http\Middleware\VerifyCsrfToken',
        'resource' => 'ApiGfccm\Http\Middleware\RespondWithResource',
        'format.json' => 'ApiGfccm\Http\Middleware\FormatJsonRequest',
        'APIJWT.auth' => 'ApiGfccm\Http\Middleware\PassThrough'
    ];
}