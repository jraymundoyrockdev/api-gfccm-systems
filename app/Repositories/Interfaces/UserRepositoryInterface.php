<?php namespace KyokaiAccSys\Repositories\Interfaces;

interface UserRepositoryInterface
{
    /**
     * Returns all userss
     *
     * @return Collection|null
     */
    public function getAllUsers();

}
