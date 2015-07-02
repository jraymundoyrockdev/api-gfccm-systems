<?php namespace ApiGfccm\Repositories\Interfaces;

interface DenominationRepositoryInterface
{
    /**
     * Returns all Denomination
     *
     * @return Collection|null
     */
    public function getAllDenomination();

    /**
     * Get a certain Denomination
     *
     * @return Collection|null
     */
    public function getById($id);

    /**
     * @param $payload
     * @return static
     */
    public function createNewDenomination($payload);

    /**
     * @param $id
     * @param $payload
     * @return Denomination|null
     */
    public function updateDenomination($id, $payload);

}
