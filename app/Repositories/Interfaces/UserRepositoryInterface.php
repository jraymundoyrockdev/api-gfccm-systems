<?php namespace ApiGfccm\Repositories\Interfaces;

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

    /**
     * @param $id
     * @param $payload
     * @return User|null
     */
    public function updateUser($id, $payload);
}
