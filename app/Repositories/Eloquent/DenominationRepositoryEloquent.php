<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Repositories\Interfaces\DenominationRepositoryInterface;
use ApiGfccm\Models\Denomination;

class DenominationRepositoryEloquent implements DenominationRepositoryInterface
{
    /**
     * @var Ministry
     */
    protected $denomination;

    public function __construct(Denomination $denomination)
    {
        $this->denomination = $denomination;
    }

    /**
     * Returns all Denomination
     *
     * @return Ministry|null
     */
    public function getAllDenomination()
    {
        return $this->denomination->orderBy('amount')->get();
    }

    /**
     * Get a certain denomination
     *
     * @return Denomination|null
     */
    public function getById($id)
    {
        return $this->denomination->find($id);
    }

    /**
     * @param $payload
     * @return static
     */
    public function createNewDenomination($payload)
    {
        return $this->denomination->create($payload);
    }

    /**
     * @param $id
     * @param $payload
     * @return Denomination|null
     */
    public function updateDenomination($id, $payload)
    {
        $denomination = $this->getById($id);
        $denomination->fill($payload)->save();

        return $denomination;
    }

}
