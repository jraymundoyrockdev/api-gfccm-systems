<?php

namespace KyokaiAccSys\Http\Controllers\Api;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use KyokaiAccSys\Http\Requests;
use KyokaiAccSys\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth as Authenticator;

class AuthenticationController extends Controller
{
    /**
     * @var Authenticator
     */
    protected $authenticator;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Authenticator $authenticator, Request $request)
    {die;
        $this->authenticator = $authenticator;
        $this->request = $request;
    }

    public function authorize()
    {
        die;
        $credentials = $this->request->only(['username', 'password']);
        $token = $this->authenticator->attempt($credentials);
        if (!$token) {
            return $response->make('Invalid credentials', 401);
        }
        return ['token' => $token];
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
}