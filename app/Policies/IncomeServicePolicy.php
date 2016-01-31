<?php namespace ApiGfccm\Policies;

use ApiGfccm\Models\UserRole;
use Illuminate\Support\Facades\Config;

class IncomeServicePolicy
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
        $this->authorizedRoles = Config::get('authorized_roles.roleId');
    }

    /**
     * @param $user
     * @return bool
     */
    public function putPostDelete($user)
    {
        $userProfile = $this->userRole->where('user_id', ($user->id))->get();

        $currentUserRoles = $this->getUserRoleIds($userProfile);

        if ($this->isAuthorized($currentUserRoles)) {
            return true;
        }

        return false;
    }

    /**
     * Get all current user roles
     *
     * @param array $roles
     * @return array
     */
    private function getUserRoleIds($roles = [])
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
    private function isAuthorized($currentUserRoles = [])
    {
        if (array_intersect($currentUserRoles, $this->authorizedRoles)) {
            return true;
        }

        return false;
    }

}
