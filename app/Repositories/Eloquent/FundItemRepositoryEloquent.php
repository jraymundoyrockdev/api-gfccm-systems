<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\FundItem;
use ApiGfccm\Repositories\Interfaces\FundItemRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\RepositoryInterface;

class FundItemRepositoryEloquent implements RepositoryInterface, FundItemRepositoryInterface
{
    /**
     * @var FundItem
     */
    protected $fundItem;

    /**
     * @param FundItem $fundItem
     */
    public function __construct(FundItem $fundItem)
    {
        $this->fundItem = $fundItem;
    }

    /**
     * @return FundItem|null
     */
    public function all()
    {
        return $this->fundItem->all();
    }

    /**
     * Get a certain fund
     *
     * @param int $id
     * @return FundItem|null
     */
    public function findById($id)
    {
        $fundItem = $this->fundItem->find($id);

        if (!$fundItem) {
            return null;
        }

        return $fundItem;
    }

    /**
     * @param $fundId
     * @return FundItem|null
     */
    public function findByFundId($fundId)
    {
        return $this->fundItem->where('fund_id', '=', $fundId)->get();
    }

    /**
     * @param array $payload
     * @return FundItem
     */
    public function create(array $payload)
    {
        return $this->fundItem->create($payload);
    }

    /**
     * @param array $payload
     * @param int $id
     * @return FundItem|null
     */
    public function update(array $payload, $id)
    {
        $fundItem = $this->fundItem->find($id);

        if (!$fundItem) {
            return null;
        }

        $fundItem->fill($payload)->save();

        return $fundItem;
    }

    /**
     * Get all Active Fund Items
     * @return array
     */
    public function getActive()
    {
        return $this->fundItem->where('status', 'active')->get();
    }
}
