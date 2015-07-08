<?php

namespace KyokaiAccSys\Http\Controllers\Api;

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
    {
        $this->authenticator = $authenticator;
        $this->request = $request;
    }

    public function authorize()
    {
        $credentials = $this->request->only(['username', 'password']);
        $token = $this->authenticator->attempt($credentials);
        if (!$token) {
            // fucked up
        }
        return ['token' => $token];
    }

    public function refreshToken()
    {
        $token = $this->request->only(['token']);
        $refresh = $this->authenticator->refresh($token['token']);
        if (!$refresh) {
            // fucked up
        }
        return ['token' => $refresh];
    }
}