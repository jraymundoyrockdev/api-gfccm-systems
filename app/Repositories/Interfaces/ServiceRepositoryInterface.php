<?php namespace ApiGfccm\Repositories\Interfaces;

interface ServiceRepositoryInterface
{
    /**
     * Returns all Services
     *
     * @return Collection|null
     */
    public function getAllServices();

    /**
     * Get a certain Service
     *
     * @return Collection|null
     */
    public function getById($id);

    /**
     * Create new Service
     *
     * @param array $payload
     * @return static
     */
    public function createNewService($payload);

    /**
     * @param int $id
     * @param array $payload
     * @return Ministry|null
     */
    public function updateService($id, $payload);

    /**
     * Return service as list
     *
     * @param string $value
     * @param string $key
     * @return mixed
     */
    public function getAllServicesAsList($value, $key);

}
