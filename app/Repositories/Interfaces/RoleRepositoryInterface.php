<?php namespace ApiGfccm\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    /**
     * Returns all user roles
     *
     * @return Collection|null
     */
    public function getAllRoles();

    /**
     * Get a certain user roles
     *
     * @return Collection|null
     */
    public function getById($id);

}
