<?php namespace ApiGfccm\Repositories\Interfaces;

interface ServiceRepositoryInterface
{
    /**
     * Returns all Ministry
     *
     * @return Collection|null
     */
    public function getAllServices();

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
    public function createNewService($payload);

    /**
     * @param $id
     * @param $payload
     * @return Ministry|null
     */
    public function updateService($id, $payload);

}
