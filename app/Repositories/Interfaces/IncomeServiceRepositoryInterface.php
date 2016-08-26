<?php namespace ApiGfccm\Repositories\Interfaces;

interface IncomeServiceRepositoryInterface
{

    /**
     * @param null $year
     * @param null $month
     * @return mixed
     */
    public function findByYearAndMonth($year = null, $month = null);

    /**
     * Create a bulk of Structural Fund
     *
     * @param array $payload
     * @return mixed
     */
    public function createFundStructure(array $payload);

    /**
     * Create a bulk of Structural Fund
     *
     * @param array $payload
     * @return mixed
     */
    public function createFundItemStructure(array $payload);

    /**
     * Create a bulk of Denomination Structural Fund
     *
     * @param array $payload
     * @return mixed
     */
    public function createDenominationStructure(array $payload);

    /**
     * Updates funds amount
     *
     * @param int $id
     * @param array $payload
     * @param string $method
     * @return mixed
     */
    public function updateFunds($id, $payload, $method);

    /**
     * Update Denomination
     *
     * @param array $payload
     * @return mixed
     */
    public function updateDenomination($payload);

    /**
     * Compute the totals of each income service
     *
     * @param int $year
     * @param null $month
     * @return mixed
     */
    public function getTotal($year, $month = null);
}