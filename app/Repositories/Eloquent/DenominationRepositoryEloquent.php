<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Denomination;
use ApiGfccm\Repositories\Interfaces\AbstractApiInterface;
use ApiGfccm\Repositories\Interfaces\DenominationRepositoryInterface;

class DenominationRepositoryEloquent implements AbstractApiInterface, DenominationRepositoryInterface
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
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->denomination->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById($id)
    {
        $denomination = $this->denomination->find($id);

        if (!$denomination) {
            return null;
        }

        return $denomination;
    }

    /**
     * @param array $payload
     * @return static
     */
    public function create($payload = [])
    {
        return $this->denomination->create($payload);
    }

    /**
     * @param int $id
     * @param array $payload
     * @return Denomination|null
     */
    public function update($id, $payload = [])
    {
        $denomination = $this->denomination->find($id);

        if (!$denomination) {
            return null;
        }

        $denomination->fill($payload)->save();

        return $denomination;
    }

    /**
     * @return mixed
     */
    public function allOrderByAmount()
    {
        return $this->denomination->orderBy('amount')->get();
    }
}
