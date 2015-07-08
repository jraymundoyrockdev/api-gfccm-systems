<?php namespace KyokaiAccSys\Repositories\Interfaces;

interface UserRepositoryInterface
{
    /**
     * Returns all userss
     *
     * @return Collection|null
     */
    public function getAllUsers();

    /**
    * Get a certain user
    *
    * @return Collection|null
    */
    public function getById($id);

}
