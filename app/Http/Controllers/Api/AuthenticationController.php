<?php

namespace ApiGfccm\Http\Controllers\Api;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth as JWT;
use Tymon\JWTAuth\Exceptions\TokenExpiredException as TokenExpiredException;

class AuthenticationController extends Controller
{
    /**
     * @var JWT
     */
    protected $jwt;

    /**
     * @var Guard
     */
    protected $auth;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(JWT $jwt, Guard $auth, Request $request)
    {
        $this->auth = $auth;
        $this->jwt = $jwt;
        $this->request = $request;
    }

    /**
     * Authorize the user
     *
     * @param ResponseFactory $response
     * @return array|\Illuminate\Http\Response
     */
    public function authorize(ResponseFactory $response)
    {
        $credentials = $this->request->only(['username', 'password']);

        if(! $this->auth->once($credentials)){
            return $response->make('Invalid credentials', 401);
        }

        return [
            'token' => $this->getUserToken($this->auth->user()),
            //'role' =>  $this->createSalt().$this->auth->user()->role_id.$this->createPepper()
            'role' =>  $this->auth->user()->role_id
        ];
    }

   /**
     * Refresh access tokens. This is a null route, the refreshing is handled
     * by middleware
     *
     * @return void
     */
    public function refreshToken()
    {
        return;
    }

    /**
     * Validate Token
     *
     * @return void
     */
    public function validateToken()
    {
        try {

        if (! $user = $this->jwt->parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

    } catch (TokenExpiredException $e) {

        return response()->json(['token_expired'], $e->getStatusCode());

    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

        return response()->json(['token_invalid'], $e->getStatusCode());

    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

        return response()->json(['token_absent'], $e->getStatusCode());

    }

    // the token is valid and we have found the user via the sub claim
    return response()->json(compact('user'));

         //$credentials = $this->request->only('token');

        echo $user = $this->jwt->parseToken()->authenticate();
    }


    protected function getUserToken($user){
        return $this->jwt->fromUser($user, $this->createClaims($user));
    }

    protected function createClaims($user){
        return [
            'username' => $user->username,
            'pabebe' => $user->role_id
        ];
    }

    protected function createSalt(){
        return md5('JEMPOOGI');
    }

    protected function createPepper(){
        return md5('123');
    }
}