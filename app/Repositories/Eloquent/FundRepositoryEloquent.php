<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Fund;
use ApiGfccm\Repositories\Interfaces\FundRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\RepositoryInterface;

class FundRepositoryEloquent implements RepositoryInterface, FundRepositoryInterface
{
    /**
     * @var Fund
     */
    protected $fund;

    /**
     * @param Fund $fund
     */
    public function __construct(Fund $fund)
    {
        $this->fund = $fund;
    }

    /**
     * Returns all Funds
     *
     * @return Fund|null
     */
    public function all()
    {
        return $this->fund->with('item')->get();
    }

    /**
     * @param int $id
     * @return Fund|null
     */
    public function findById($id)
    {
        return $this->fund->with('item')->find($id);
    }

    /**
     * @param array $payload
     * @return Fund
     */
    public function create(array $payload)
    {
        return $this->fund->create($payload);
    }

    /**
     * @param array $payload
     * @param int $id
     * @return Fund|null
     */
    public function update(array $payload, $id)
    {
        $fund = $this->fund->with('item')->find($id);

        if (!$fund) {
            return null;
        }

        $fund->fill($payload)->save();

        return $fund;
    }

    /**
     * Get all Active Fund Items
     * @return mixed
     */
    public function getActive()
    {
        return $this->fund->where('status', 'active')->get();
    }

}
