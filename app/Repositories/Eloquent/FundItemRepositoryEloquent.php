<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\FundItem;
use ApiGfccm\Repositories\Interfaces\FundItemRepositoryInterface;

class FundItemRepositoryEloquent implements FundItemRepositoryInterface
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
     * Returns all Fund Items under a Fund
     *
     * @param int $fundId
     * @return mixed
     */
    public function all($fundId)
    {
        return $this->fundItem->where('fund_id', '=', $fundId)->get();
    }

    /**
     * Get a certain fund
     *
     * @param int $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->fundItem->find($id);
    }

    /**
     * Create|Update FundItem
     *
     * @param $payload
     * @param null $id
     * @return FundItem|null|static
     */
    public function save($payload, $id = null)
    {
        if ($id) {
            $fundItem = $this->show($id);
            $fundItem->fill($payload)->save();

            return $fundItem;
        }

        return $this->fundItem->create($payload);
    }
}
