<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Repositories\Interfaces\RoleRepositoryInterface;
use ApiGfccm\Models\Role;

class RoleRepositoryEloquent implements RoleRepositoryInterface
{
    /**
     * @var UserRole
     */
    protected $userRole;

    public function __construct(Role $role)
    {
        $this->userRole = $role;
    }

    /**
     * Returns all Role
     *
     * @return User|null
     */
    public function getAllRoles()
    {
        return $this->userRole->all();
    }

    /**
     * Get a certain user_role
     *
     * @return User|null
     */
    public function getById($id)
    {
        return $this->userRole->where('id', $id)->first();
    }

}
