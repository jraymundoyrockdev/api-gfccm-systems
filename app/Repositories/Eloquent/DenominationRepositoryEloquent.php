<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Denomination;
use ApiGfccm\Repositories\Interfaces\DenominationRepositoryInterface;

class DenominationRepositoryEloquent implements DenominationRepositoryInterface
{
    /**
     * @var Denomination
     */
    protected $denomination;

    /**
     * DenominationRepositoryEloquent constructor.
     * @param Denomination $denomination
     */
    public function __construct(Denomination $denomination)
    {
        $this->denomination = $denomination;
    }

    /**
     * @return mixed
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

    /**
     * Get all Active Fund Items
     * @return mixed
     */
    public function getActive()
    {
        return $this->denomination->all();
    }

}
