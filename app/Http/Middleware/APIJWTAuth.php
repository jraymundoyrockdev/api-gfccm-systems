<?php

namespace ApiGfccm\Http\Middleware;

use ApiGfccm\Services\JWTValidation\ValidateJWT;
use Closure;

class APIJWTAuth
{
    /**
     * @var ValidateJWT
     */
    protected $validateJWT;

    /**
     * APIJWTAuth constructor.
     * @param ValidateJWT $validateJWT
     */
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
        $validatedJWTResult = $this->validateJWT->validate()->getData();

        if ($validatedJWTResult->message != 'token_valid') {
            return response()->json($this->buildErrorResponse($validatedJWTResult->message), 401);
        }

        return $next($request);
    }

    /**
     * @param $errorMessage
     * @return array
     */
    protected function buildErrorResponse($errorMessage)
    {
        return [
            'error' => $errorMessage
        ];
    }


}
