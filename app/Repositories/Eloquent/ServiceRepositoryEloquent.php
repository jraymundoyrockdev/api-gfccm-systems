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
     * Create new Service
     *
     * @param array $payload
     * @return static
     */
    public function createNewService($payload)
    {
        return $this->service->create($payload);
    }

    /**
     * @param int $id
     * @param array $payload
     * @return Service|null
     */
    public function updateService($id, $payload)
    {
        $service = $this->getById($id);
        $service->fill($payload)->save();

        return $service;
    }

    /**
     * Return service as list
     *
     * @param string $value
     * @param string $key
     * @return mixed
     */
    public function getAllServicesAsList($value, $key)
    {
        return $this->getAllServices()->lists($value, $key);
    }

}
