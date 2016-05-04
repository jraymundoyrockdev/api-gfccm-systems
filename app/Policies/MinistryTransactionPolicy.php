<?php

namespace ApiGfccm\Policies;

use ApiGfccm\Models\MinistryTransaction;
use ApiGfccm\Models\User;
use ApiGfccm\Models\UserRole;
use Illuminate\Support\Facades\Config;

class MinistryTransactionPolicy extends AbstractPolicy
{
    protected $ministryMap = [
        4 => 1,
        5 => 2,
        6 => 3,
        7 => 4,
        8 => 5,
        9 => 6,
        10 => 7
    ];

    /**
     * Create a new policy instance.
     *
     * MinistryTransactionPolicy constructor.
     * @param UserRole $userRole
     */
    public function __construct(UserRole $userRole)
    {
        parent::__construct($userRole);

        $this->setAuthorizedRoles(Config::get('authorized_roles.ministry-accountant'));
    }

    /**
     * @param User $user
     * @param MinistryTransaction $ministryTransaction
     * @return bool
     */
    public function userCredential(User $user, MinistryTransaction $ministryTransaction)
    {
        $this->setCurrentUserRoles($user->id);

        if (!$this->isUserAllowedOnMinistry($this->currentUserRoles, $ministryTransaction->ministry_id)) {
            return false;
        }

        return true;
    }

    /**
     * @param array $currentUserRoles
     * @param null $ministryId
     * @return bool
     */
    private function isUserAllowedOnMinistry($currentUserRoles = [], $ministryId = null)
    {
        $allowedMinistries = array_flatten(array_intersect($currentUserRoles, $this->authorizedRoles));

        return (in_array($ministryId, $this->mapAllowedMinistries($allowedMinistries)));
    }

    /**
     * @param array $allowedMinistries
     * @return array
     */
    private function mapAllowedMinistries($allowedMinistries = [])
    {
        return array_map(function ($allowedMinistries) {
            return $this->ministryMap[$allowedMinistries];
        }, $allowedMinistries);
    }

}
