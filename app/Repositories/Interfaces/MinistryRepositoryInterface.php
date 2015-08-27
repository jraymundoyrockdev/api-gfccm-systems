<?php namespace ApiGfccm\Repositories\Interfaces;

interface MinistryRepositoryInterface
{
    /**
     * Returns all Ministry
     *
     * @return Collection|null
     */
    public function getAllMinistry();

    /**
     * Get a certain Ministry
     *
     * @return Collection|null
     */
    public function getById($id);

}
