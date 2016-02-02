<?php namespace ApiGfccm\Policies;

use ApiGfccm\Models\UserRole;
use Illuminate\Support\Facades\Config;

class IncomeServicePolicy extends AbstractPolicy
{
    /**
     * @param UserRole $userRole
     */
    public function __construct(UserRole $userRole)
    {
        parent::__construct($userRole);

        $this->setAuthorizedRoles(Config::get('authorized_roles.kyokai'));
    }
}
