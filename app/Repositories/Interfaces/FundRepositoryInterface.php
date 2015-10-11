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
     * @return Collection|null
     */
    public function show($id);

}
