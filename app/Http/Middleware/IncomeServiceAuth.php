<?php

namespace ApiGfccm\Http\Middleware;

use ApiGfccm\Models\UserRole;
use Illuminate\Auth\Guard;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class IncomeServiceAuth extends IndexShowCreateUpdateAuth
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
        parent::__construct($userRole, $guard, $response);

        $this->setAuthorizedRoles(Config::get('authorized_roles.kyokai'));
    }

}
