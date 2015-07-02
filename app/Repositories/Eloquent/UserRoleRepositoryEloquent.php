<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Repositories\Interfaces\UserRoleRepositoryInterface;
use ApiGfccm\Models\UserRole;

class UserRoleRepositoryEloquent implements UserRoleRepositoryInterface
{
    /**
     * @var UserRole
     */
    protected $userRole;

    public function __construct(UserRole $userRole)
    {
        $this->userRole = $userRole;
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
     * Get a certain role
     *
     * @return User|null
     */
    public function getById($id)
    {
        return $this->userRole->where('id', $id)->first();
    }

}
