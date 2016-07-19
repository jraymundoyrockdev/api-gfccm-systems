<?php namespace ApiGfccm\Repositories\Interfaces;

use ApiGfccm\Models\Fund;

interface FundItemRepositoryInterface
{
    /**
     * @param Fund|null $fundId
     * @return mixed
     */
    public function findByFundId(Fund $fundId);

    /**
     * Get all Active Fund Items
     * @return mixed
     */
    public function getActive();
}
