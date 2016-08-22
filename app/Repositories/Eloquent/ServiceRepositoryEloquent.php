<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Service;
use ApiGfccm\Repositories\Interfaces\AbstractApiInterface;
use ApiGfccm\Repositories\Interfaces\ServiceRepositoryInterface;

class ServiceRepositoryEloquent implements AbstractApiInterface, ServiceRepositoryInterface
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
    public function create($payload = [])
    {
        return $this->service->create($payload);
    }

    /**
     * @param int $id
     * @param array $payload
     * @return Service|null
     */
    public function update($id, $payload = [])
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
     * @return Service|null
     */
    public function getAllAsList($value, $key)
    {
        return $this->service->all()->lists($value, $key);
    }

}
