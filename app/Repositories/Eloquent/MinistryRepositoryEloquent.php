<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Repositories\Interfaces\MinistryRepositoryInterface;
use ApiGfccm\Models\Ministry;

class MinistryRepositoryEloquent implements MinistryRepositoryInterface
{
    /**
     * @var Ministry
     */
    protected $ministry;

    public function __construct(Ministry $ministry)
    {
        $this->ministry = $ministry;
    }

    /**
     * Returns all Ministry
     *
     * @return Ministry|null
     */
    public function getAllMinistry()
    {
        return $this->ministry->all();
    }

    /**
     * Get a certain ministry
     *
     * @return Ministry|null
     */
    public function getById($id)
    {
        return $this->ministry->find($id);
    }

    /**
     * @param $payload
     * @return static
     */
    public function createNewMinistry($payload)
    {
        return $this->ministry->create($payload);
    }

    /**
     * @param $id
     * @param $payload
     * @return Ministry|null
     */
    public function updateMinistry($id, $payload)
    {
        $ministry = $this->getById($id);
        $ministry->fill($payload)->save();

        return $ministry;
    }

    public function getAllMinistryAsList($value, $key)
    {
        return $this->getAllMinistry()->lists($value, $key);
    }

}
