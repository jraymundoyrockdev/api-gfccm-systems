<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Ministry;
use ApiGfccm\Repositories\Interfaces\AbstractApiInterface;
use ApiGfccm\Repositories\Interfaces\MinistryRepositoryInterface;

class MinistryRepositoryEloquent implements AbstractApiInterface, MinistryRepositoryInterface
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
    public function all()
    {
        return $this->ministry->all();
    }

    /**
     * Get a certain ministry
     *
     * @return Ministry|null
     */
    public function findById($id)
    {
        return $this->ministry->find($id);
    }

    /**
     * @param array $payload
     * @return Ministry
     */
    public function create($payload = [])
    {
        return $this->ministry->create($payload);
    }

    /**
     * @param $id
     * @param $payload
     * @return Ministry|null
     */
    public function update($id, $payload = [])
    {
        $ministry = $this->ministry->find($id);

        if (!$ministry) {
            return null;
        }

        $ministry->fill($payload)->save();

        return $ministry;
    }

    /**
     * @param $value
     * @param $key
     * @return array
     */
    public function getAllAsList($value, $key)
    {
        return $this->ministry->all()->lists($value, $key);
    }

}
