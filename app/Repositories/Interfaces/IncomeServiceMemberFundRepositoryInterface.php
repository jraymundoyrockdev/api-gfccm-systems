<?php namespace ApiGfccm\Repositories\Interfaces;

interface IncomeServiceMemberFundRepositoryInterface
{

    /**
     * Create Totals of Member
     *
     * @param array $payload
     * @return mixed
     */
    public function create(array $payload);

    /**
     * Create New Member Fund Total
     *
     * $param array $payload
     * @return mixed
     */
    public function createTotal($payload);

}