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

    /**
     * @param JWT $jwt
     */
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
                return $this->returnUnauthenticatedUserResponse();
            }
        } catch (TokenExpiredException $exception) {
            return $this->returnTokenExceptionResponse('token_expired', $exception->getStatusCode());
        } catch (TokenInvalidException $exception) {
            return $this->returnTokenExceptionResponse('token_invalid', $exception->getStatusCode());
        } catch (JWTException $exception) {
            return $this->returnTokenExceptionResponse('token_absent', $exception->getStatusCode());
        }

        return $this->returnAuthenticatedUserResponse(compact('user'));

    }

    /**
     * Return a response from Token and JWT Exception
     *
     * @param $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function returnTokenExceptionResponse($message, $statusCode)
    {
        return response()->json(
            $this->buildResponse($message), $statusCode
        );
    }

    /**
     * Return Unauthenticated User Response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function returnUnauthenticatedUserResponse()
    {
        return response()->json('Unauthorized user', 404);
    }

    /**
     * Return Authenticated User Response
     *
     * @param array $authenticatedUser
     * @return \Illuminate\Http\JsonResponse
     */
    protected function returnAuthenticatedUserResponse($authenticatedUser = [])
    {
        return response()->json($this->buildResponse('token_valid', $authenticatedUser), 200);
    }

    /**
     * Build a response
     *
     * @param string $message
     * @param array $authenticatedUser
     * @return array
     */
    protected function buildResponse($message, $authenticatedUser = [])
    {
        if (empty($authenticatedUser)) {
            return ['message' => $message];
        }

        return [
            'message' => $message,
            'authenticatedUser' => $authenticatedUser
        ];
    }

}
