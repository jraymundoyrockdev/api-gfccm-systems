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

    protected $authorizedRoles = [];

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
    public function putPostDelete(User $user)
    {
        $userProfile = $this->userRole->where('user_id', ($user->id))->get(['role_id']);

        $currentUserRoles = $this->getUserRoleIds($userProfile);

        if ($this->isAuthorized($currentUserRoles)) {
            return true;
        }

        return false;
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
