<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Denomination;
use ApiGfccm\Repositories\Interfaces\RepositoryInterface;
use ApiGfccm\Repositories\Interfaces\DenominationRepositoryInterface;

class DenominationRepositoryEloquent implements RepositoryInterface, DenominationRepositoryInterface
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
     * @return Denomination|null
     */
    public function all()
    {
        return $this->denomination->all();
    }

    /**
     * @param int $id
     * @return Denomination|null
     */
    public function findById($id)
    {
        return $this->denomination->find($id);
    }

    /**
     * @param array $payload
     * @return Denomination|null
     */
    public function create(array $payload)
    {
        return $this->denomination->create($payload);
    }

    /**
     * @param array $payload
     * @param int $id
     * @return Denomination|null
     */
    public function update(array $payload, $id)
    {
        $denomination = $this->denomination->find($id);

        if (!$denomination) {
            return null;
        }

        $denomination->fill($payload)->save();

        return $denomination;
    }

    /**
     * @return Denomination
     */
    public function allActiveOrderByAmount()
    {
        return $this->denomination->where('status', 'active')->orderBy('amount')->get();
    }
}
