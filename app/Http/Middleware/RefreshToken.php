<?php namespace Nrns\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Middleware\RefreshToken as BaseRefreshToken;

/**
 * Custom implementation of the JWT token refresher
 *
 * @package Nrns\Http\Middleware
 */
class RefreshToken extends BaseRefreshToken
{
    /**
     * Handle the incoming request
     *
     * Defers most of the work to the base JWT middleware, then promotes the token
     * into the response payload which is expected by simple-auth-tokens
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = parent::handle($request, $next);
        $token = $this->parseTokenFromHeader($response);

        if (! $token) {
            return $response;
        }
        return $response->setContent(json_encode(['token' => $token]));
    }

    /**
     * Parse the token out of the header
     *
     * @param $response
     * @return mixed|null
     */
    private function parseTokenFromHeader($response)
    {
        $header = $response->headers->get('Authorization');
        if ($header) {
            return str_ireplace('bearer', '', $header);
        }
        return null;
    }
}
