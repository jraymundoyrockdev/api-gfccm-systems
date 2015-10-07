<?php namespace ApiGfccm\Repositories\Interfaces;

interface MinistryRepositoryInterface
{
    /**
     * Returns all Ministry
     *
     * @return Collection|null
     */
    public function getAllMinistry();

    /**
     * Get a certain Ministry
     *
     * @return Collection|null
     */
    public function getById($id);

    /**
     * @param $payload
     * @return static
     */
    public function createNewMinistry($payload);

    /**
     * @param $id
     * @param $payload
     * @return Ministry|null
     */
    public function updateMinistry($id, $payload);

    /**
     * @param $value
     * @param $key
     * @return mixed
     */
    public function getAllMinistryAsList($value, $key);

}
