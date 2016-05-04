<?php namespace ApiGfccm\Repositories\Interfaces;


interface MinistryTransactionRepositoryInterface
{
    /**
     * Create
     *
     * @param array $payload
     * @return mixed
     */
    public function create($payload = []);

    /**
     * @param null $id
     * @param null $year
     * @return mixed
     */
    public function getAllByMinistryId($id = null, $year = null);

    /**
     * @param null $id
     * @param null $year
     * @param null $monthFrom
     * @param null $monthTo
     * @return mixed
     */
    public function getCashFlow($id = null, $year = null, $monthFrom = null, $monthTo = null);

    public function getAllMinistryCurrentBalance();
}
