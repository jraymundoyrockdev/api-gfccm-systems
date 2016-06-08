<?php

namespace ApiGfccm\Http\Middleware;

use Closure;
use Tymon\JWTAuth\JWTAuth as JWT;

class InvalidateToken
{
    /**
     * @var JWT
     */
    private $jwt;

    /**
     * InvalidateToken constructor.
     * @param JWT $jwt
     */
    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->jwt->setRequest($request)->parseToken()->invalidate();

        return $next($request);
    }
}
