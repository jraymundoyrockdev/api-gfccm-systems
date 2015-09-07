<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Repositories\Interfaces\ServiceRepositoryInterface;
use ApiGfccm\Models\Service;

class ServiceRepositoryEloquent implements ServiceRepositoryInterface
{
    /**
     * @var Service
     */
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Returns all Services
     *
     * @return Service|null
     */
    public function getAllServices()
    {
        return $this->service->all();
    }

    /**
     * Get a certain service
     *
     * @return Service|null
     */
    public function getById($id)
    {
        return $this->service->find($id);
    }

    /**
     * @param $payload
     * @return static
     */
    public function createNewService($payload)
    {
        return $this->service->create($payload);
    }

    /**
     * @param $id
     * @param $payload
     * @return Service|null
     */
    public function updateService($id, $payload)
    {
        $service = $this->getById($id);
        $service->fill($payload)->save();

        return $service;
    }

}
