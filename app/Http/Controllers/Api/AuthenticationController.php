<?php

namespace ApiGfccm\Http\Controllers\Api;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth as JWT;
use Crypt;

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
            return $response->make('Invalid credentisls', 401);
        }

        return ['token' => $this->getUserToken($this->auth->user())];
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

    protected function getUserToken($user){
        return $this->jwt->fromUser($user, $this->createClaims($user));
    }

    protected function createClaims($user){
        return [
            'username' => $user->username,
            'role' => Crypt::encrypt($this->createSalt().$user->username.$this->createPepper()),
        ];
    }

    protected function createSalt(){
        return Crypt::encrypt('JEMPOOGI');
    }

    protected function createPepper(){
        return Crypt::encrypt('123');
    }
}