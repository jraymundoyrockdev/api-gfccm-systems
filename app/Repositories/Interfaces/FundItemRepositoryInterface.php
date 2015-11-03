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
     * @param $id
     * @return mixed
     */
    public function show($id);

    /**
     * Create|Update FundItem
     *
     * @param $payload
     * @param null $id
     * @return mixed
     */
    public function save($payload, $id = null);

    /**
     * Get all Active Fund Items
     * @return mixed
     */
    public function getActive();
}
