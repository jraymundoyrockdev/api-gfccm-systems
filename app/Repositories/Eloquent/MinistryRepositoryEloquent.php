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
     * @return User|null
     */
    public function getAllMinistry()
    {
        return $this->ministry->all();
    }

    /**
     * Get a certain ministry
     *
     * @return User|null
     */
    public function getById($id)
    {
        return $this->ministry->where('id', $id)->first();
    }

    public function createNewMinistry($payload)
    {
        return $this->ministry->create($payload);
    }

}
