<?php

namespace ApiGfccm\Http\Middleware;

use Closure;
use ApiGfccm\Services\JWTValidation\ValidateJWT;

class KyokaiAccSysAuth
{
    /**
     * @var ValidateJWT
     */
    protected $validateJWT;

    public function __construct(ValidateJWT $validateJWT)
    {
        $this->validateJWT = $validateJWT;
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
        $validatedJWTResult = $this->validateJWT->validate();
        $validatedJWTResult = $validatedJWTResult->getData();

        if ($validatedJWTResult->message != 'token_valid') {
            return $validatedJWTResult;
        }

        if ($validatedJWTResult->authenticated->user->role_id != 3) {
            return 'user_unauthorized';
        }

        return $next($request);
    }


}
