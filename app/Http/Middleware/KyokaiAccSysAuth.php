<?php

namespace ApiGfccm\Http\Middleware;

use Closure;
use ApiGfccm\Services\JWTValidation\ValidateJWT;
use Illuminate\Http\JsonResponse as JsonResponse;

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
        $validatedTokenResult = $this->validateJWT->validate();
        $validatedToken = $validatedTokenResult->getData(1);

        print_r($validatedToken); die;
        if (! array_key_exists('user', $validatedToken)) {
            return $validatedToken;
        }

        return $this->validateUserRole($validatedToken);
    }

    protected function validateUserRole($validatedToken)
    {
        return $validatedToken['user']['role_id'];
    }
}
