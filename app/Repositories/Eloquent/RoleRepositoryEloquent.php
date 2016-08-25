<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Role;
use ApiGfccm\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepositoryEloquent implements RoleRepositoryInterface
{
    /**
     * @var Role
     */
    protected $role;

    /**
     * RoleRepositoryEloquent constructor.
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * @return Role|null
     */
    public function all()
    {
        return $this->role->all();
    }

    /**
     * @param int $id
     * @return Role|null
     */
    public function findById($id)
    {
        return $this->role->find($id);
    }
}
