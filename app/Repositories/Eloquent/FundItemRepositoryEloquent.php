<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Fund;
use ApiGfccm\Models\FundItem;
use ApiGfccm\Repositories\Interfaces\AbstractApiInterface;
use ApiGfccm\Repositories\Interfaces\FundItemRepositoryInterface;

class FundItemRepositoryEloquent implements AbstractApiInterface, FundItemRepositoryInterface
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
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->fundItem->all();
    }

    /**
     * Get a certain fund
     *
     * @param int $id
     * @return mixed
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
     * @return mixed
     */
    public function findByFundId($fundId)
    {
        return $this->fundItem->where('fund_id', '=', $fundId)->get();
    }

    /**
     * @param array $payload
     * @return static
     */
    public function create($payload = [])
    {
        return $this->fundItem->create($payload);
    }

    /**
     * @param int $id
     * @param array $payload
     * @return FundItem|null
     */
    public function update($id, $payload = [])
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
     * @return mixed
     */
    public function getActive()
    {
        return $this->fundItem->where('status', 'active')->get();
    }
}
