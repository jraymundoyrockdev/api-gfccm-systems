<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\IncomeServiceMemberFund;
use ApiGfccm\Models\IncomeServiceMemberFundTotal;
use ApiGfccm\Repositories\Interfaces\IncomeServiceMemberFundRepositoryInterface;

class IncomeServiceMemberFundRepositoryEloquent implements IncomeServiceMemberFundRepositoryInterface
{
    /**
     * @var IncomeServiceMemberFund
     */
    protected $memberFund;

    /**
     * @var IncomeServiceMemberFundTotal
     */
    protected $memberFundTotal;

    /**
     * @param IncomeServiceMemberFund $memberFund
     * @param IncomeServiceMemberFundTotal $memberFundTotal
     */
    public function __construct(IncomeServiceMemberFund $memberFund, IncomeServiceMemberFundTotal $memberFundTotal)
    {
        $this->memberFund = $memberFund;
        $this->memberFundTotal = $memberFundTotal;
    }

    /**
     * Insert Bulk data of member funds
     *
     * @param array $payload
     * @return mixed
     */
    public function create(array $payload)
    {
        return $this->memberFund->insert($payload);
    }

    /**
     * Create New Member Fund Total
     *
     * @param $payload
     * @return static
     */
    public function createTotal($payload)
    {
        return $this->memberFundTotal->create($payload);
    }

}