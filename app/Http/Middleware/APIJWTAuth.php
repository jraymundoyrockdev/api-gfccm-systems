<?php

namespace ApiGfccm\Http\Middleware;

use Closure;
use ApiGfccm\Services\JWTValidation\ValidateJWT;

class APIJWTAuth
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
            return response()->json($this->buildErrorResponse($validatedJWTResult->message), 200);
        }
        
        return $next($request);
    }

    protected function buildErrorResponse($errorMessage)
    {
        return [
            'error' => $errorMessage
        ];
    }


}
