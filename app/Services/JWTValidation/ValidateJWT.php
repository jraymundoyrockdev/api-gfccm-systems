<?php namespace ApiGfccm\Services\JWTValidation;

use Tymon\JWTAuth\JWTAuth as JWT;
use Tymon\JWTAuth\Exceptions\TokenExpiredException as TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException as TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException as JWTException;

/**
 * A wrapper class to validate JWT token
 *
 * Class Paginator
 * @package Nrns\Services
 */
class ValidateJWT
{

    /**
     * @var JWT
     */
    protected $jwt;

    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * Validate Token
     *
     * returns Illuminate\Http\JsonResponse
     */
    public function validate()
    {
        try {
            if (!$user = $this->jwt->parseToken()->authenticate()) {
                return $this->returnResponse('user_not_found', 404);
            }
        } catch (TokenExpiredException $e) {
            return $this->returnResponse('token_expired', $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return $this->returnResponse('token_invalid', $e->getStatusCode());
        } catch (JWTException $e) {
            return $this->returnResponse('token_absent', $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }

    protected function returnResponse($responseType, $statusCode)
    {
        return response()->json($responseType, $statusCode);
    }
}
