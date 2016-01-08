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
     * Get Member Fund Total by Income Service ID and Member ID
     *
     * @param $incomeServiceId
     * @param $memberId
     * @return mixed
     */
    public function getByIdAndMemberId($incomeServiceId, $memberId)
    {
        return $this->memberFundTotal
            ->where('income_service_id', $incomeServiceId)
            ->where('member_id', $memberId)
            ->first();
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
     * Deletes Member Funds
     *
     * @param $incomeServiceId
     * @param $memberId
     * @return mixed
     */
    public function delete($incomeServiceId, $memberId)
    {
        return $this->memberFund
            ->where('income_service_id', $incomeServiceId)
            ->where('member_id', $memberId)
            ->delete();
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

    /**
     * Deletes Member Fund Total
     *
     * @param $id
     * @return mixed
     */
    public function deleteTotal($id)
    {
        return $this->memberFundTotal->find($id)->delete();
    }
}