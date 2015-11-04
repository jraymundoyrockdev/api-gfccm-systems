<?php namespace ApiGfccm\Repositories\Interfaces;

interface FundRepositoryInterface
{
    /**
     * Returns all Fund Items under a Fund
     *
     * @return mixed
     */
    public function all();

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

    /**
     * Get all Active Fund Items
     * @return mixed
     */
    public function getActive();
}
