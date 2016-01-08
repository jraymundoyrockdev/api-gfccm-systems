<?php namespace ApiGfccm\Repositories\Interfaces;

interface IncomeServiceMemberFundRepositoryInterface
{
    /**
     * Get Member Fund Total by Income Service ID and Member ID
     *
     * @param $incomeServiceId
     * @param $memberId
     * @return mixed
     */
    public function getByIdAndMemberId($incomeServiceId, $memberId);

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

    /**
     * Deletes Member Funds
     *
     * @param $incomeServiceId
     * @param $memberId
     * @return mixed
     */
    public function delete($incomeServiceId, $memberId);

    /**
     * Deletes Member Fund Total
     *
     * @param $id
     * @return mixed
     */
    public function deleteTotal($id);

}