<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Service;
use ApiGfccm\Repositories\Interfaces\RepositoryInterface;
use ApiGfccm\Repositories\Interfaces\ServiceRepositoryInterface;

class ServiceRepositoryEloquent implements RepositoryInterface, ServiceRepositoryInterface
{
    /**
     * @var Service
     */
    protected $service;

    /**
     * ServiceRepositoryEloquent constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Returns all Services
     *
     * @return Service|null
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Get a certain service
     *
     * @return Service|null
     */
    public function findById($id)
    {
        return $this->service->find($id);
    }

    /**
     * Create new Service
     *
     * @param array $payload
     * @return Service
     */
    public function create(array $payload)
    {
        return $this->service->create($payload);
    }

    /**
     * @param array $payload
     * @param int $id
     * @return Service|null
     */
    public function update(array $payload, $id)
    {
        $service = $this->service->find($id);

        if (!$service) {
            return null;
        }

        $service->fill($payload)->save();

        return $service;
    }

    /**
     * Return service as list
     *
     * @param string $value
     * @param string $key
     * @return array
     */
    public function getAllAsList($value, $key)
    {
        return $this->service->all()->lists($value, $key);
    }

}
