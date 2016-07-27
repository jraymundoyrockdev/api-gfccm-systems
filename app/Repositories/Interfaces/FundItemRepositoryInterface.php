<?php namespace ApiGfccm\Repositories\Interfaces;

interface FundItemRepositoryInterface
{
    /**
     * @param $fundId
     * @return mixed
     */
    public function findByFundId($fundId);

    /**
     * Get all Active Fund Items
     * @return mixed
     */
    public function getActive();
}
