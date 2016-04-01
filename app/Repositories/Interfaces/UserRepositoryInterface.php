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
     * Get by Username
     *
     * @param string $userName
     */
    public function getByUsername($userName);

    /**
     * Creates new Account from Members Creation
     *
     * @param $id
     * @param $firstname
     * @param $lastname
     * @return mixed
     */
    public function create($id, $firstname, $lastname);

    /**
     * @param $id
     * @param $payload
     * @return User|null
     */
    public function updateUser($id, $payload);
}
