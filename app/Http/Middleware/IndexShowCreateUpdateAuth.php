<?php

namespace ApiGfccm\Http\Middleware;

use ApiGfccm\Models\UserRole;
use Closure;
use Illuminate\Auth\Guard;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

abstract class IndexShowCreateUpdateAuth
{
    /**
     * @var UserRole
     */
    protected $userRole;

    /**
     * @var Guard
     */
    protected $guard;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $authorizedRoles = [];

    /**
     * @param UserRole $userRole
     * @param Guard $guard
     * @param Response $response
     */
    public function __construct(UserRole $userRole, Guard $guard, Response $response)
    {
        $this->userRole = $userRole;
        $this->guard = $guard;
        $this->response = $response;

        $this->authorizedRoles = Config::get('authorized_roles.default');
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
        $currentUserRoles = $this->grantedRoles();

        if (!$this->isAuthorized($currentUserRoles)) {
            return $this->response->setContent('Unauthorized')->setStatusCode(401);
        }

        return $next($request);
    }

    /**
     * Get all roles of the current user
     * @return array
     */
    protected function grantedRoles()
    {
        $userRoles = $this->guard->user()->roles->toArray();

        return array_map(function ($roles) {
            return $roles['pivot']['role_id'];
        }, $userRoles);
    }

    /**
     * @param null $roles
     */
    protected function setAuthorizedRoles($roles = null)
    {
        if (!is_null($roles)) {
            $this->authorizedRoles = $roles;
        }
    }

    /**
     * Get all current user roles
     *
     * @param array $roles
     * @return array
     */
    protected function getUserRoleIds($roles)
    {
        $userRoles = [];

        foreach ($roles as $role) {
            $userRoles[] = $role->pivot->role_id;
        }

        return $userRoles;
    }

    /**
     * @param array $currentUserRoles
     * @return bool
     */
    protected function isAuthorized($currentUserRoles = [])
    {
        if (array_intersect($currentUserRoles, $this->authorizedRoles)) {
            return true;
        }

        return false;
    }
}
