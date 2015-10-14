<?php namespace ApiGfccm\Repositories\Interfaces;

interface FundItemRepositoryInterface
{
    /**
     * Returns all Fund Items under a Fund
     *
     * @param int $fundId
     * @return mixed
     */
    public function all($fundId);

    /**
     * Get a certain Fund Item
     *
     * @return FundItem|null
     */
    public function show($id);

    /**
     * Create|Update FundItem
     *
     * @param $payload
     * @param null $id
     * @return FundItem|null|static
     */
    public function save($payload, $id = null);
}
