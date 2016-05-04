<?php namespace ApiGfccm\Policies;

use ApiGfccm\Models\User;
use ApiGfccm\Models\UserRole;
use Illuminate\Support\Facades\Config;

abstract class AbstractPolicy
{
    /**
     * @var UserRole
     */
    protected $userRole;

    /**
     * @var array
     */
    protected $authorizedRoles = [];

    /**
     * @var array
     */
    protected $currentUserRoles = [];

    /**
     * @param UserRole $userRole
     */
    public function __construct(UserRole $userRole)
    {
        $this->userRole = $userRole;
        $this->authorizedRoles = Config::get('authorized_roles.default');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function putPostDelete(User $user = null)
    {
        $this->setCurrentUserRoles($user->id);

        return $this->isAuthorized($this->currentUserRoles);
    }

    /**
     * @param null $userId
     */
    protected function setCurrentUserRoles($userId = null)
    {
        $user = $this->userRole->where('user_id', $userId)->get(['role_id']);

        $this->currentUserRoles = $this->getUserRoleIds($user);
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
    protected function getUserRoleIds($roles = [])
    {
        $userRoles = [];

        foreach ($roles as $role) {
            $userRoles[] = $role->role_id;
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
