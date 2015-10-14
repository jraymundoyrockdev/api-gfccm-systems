<?php namespace ApiGfccm\Repositories\Interfaces;

interface FundRepositoryInterface
{
    /**
     * Returns all fund
     *
     * @return Collection|null
     */
    public function all();

    /**
     * Get a certain fund
     *
     * @return Fund|null
     */
    public function show($id);

    /**
     * Create|Update Fund
     *
     * @param $payload
     * @param null $id
     * @return Fund|null|static
     */
    public function save($payload, $id = null);

}
