<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Requests;
use ApiGfccm\Models\UserRole;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\JWTAuth as JWT;

class AuthenticationController extends ApiController
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
        $credentials = array_merge($this->request->only(['username', 'password']), ['status' => 'active']);

        if (!$this->auth->once($credentials)) {
            return $response->make('Invalid credentials', 401);
        }

        /*
                if (!$this->isAuthorized($userRoles)) {
                    return $response->make('Unauthorized user', 401);
                }*/

        return [
            'token' => $this->getUserToken($this->auth->user())
        ];
    }

    /**
     * @param $userRoles
     * @return array
     */
    private function getUserRoles($userRoles)
    {
        $roles = [];
        foreach ($userRoles as $userRole) {
            $roles[] = $userRole->pivot->role_id;
        }

        return $roles;

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
     * Invalidate access tokens. This is a null route, the refreshing is handled
     * by middleware
     *
     * @return void
     */
    public function invalidateToken()
    {
        return;
    }

    /**
     * @param $user
     * @return string
     */
    protected function getUserToken($user)
    {
        return $this->jwt->fromUser($user, $this->createClaims($user));
    }

    /**
     * @param $user
     * @return array
     */
    protected function createClaims($user)
    {
        return [
            'username' => $user->username,
            'userRoles' => $this->getUserRoles($user->roles),
            'userAvatar' => $user->avatar
        ];
    }

    /**
     * @param array $userRoles
     * @return bool
     */
    protected function isAuthorized($userRoles = [])
    {
        $authorizedRoles = array_merge(
            Config::get('authorized_roles.ministry-accountant'),
            Config::get('authorized_roles.kyokai')
        );

        if (array_intersect($userRoles, $authorizedRoles)) {
            return true;
        }

        return false;
    }
}