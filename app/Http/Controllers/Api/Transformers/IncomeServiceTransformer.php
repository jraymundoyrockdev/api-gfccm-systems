<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\IncomeService;
use League\Fractal\TransformerAbstract;

class IncomeServiceTransformer extends TransformerAbstract
{
    /**
     * @param IncomeService $incomeService
     * @return array
     */
    public function transform(IncomeService $incomeService)
    {
        $result = $this->getFundTotal($incomeService->member_fund_totals);

        return [
            'id' => (int)$incomeService->id,
            'service_id' => (int)$incomeService->service_id,
            'tithes' => $incomeService->tithes,
            'offering' => $incomeService->offering,
            'other_fund' => $incomeService->other_fund,
            'total' => $incomeService->total,
            'service_date' => $incomeService->service_date,
            'status' => $incomeService->status,
            'created_by' => $incomeService->user->member->fullname,
            'role_access' => $incomeService->role_access,
            'service' => $incomeService->service->name,
            'user' => $incomeService->user->username,
            'funds_structure' => $this->getStructure(
                $incomeService->fund_structures,
                new IncomeServiceFundStructureTransformer()
            ),
            'denominations_structure' => $this->getStructure(
                $incomeService->denomination_structures,
                new IncomeServiceDenominationTransformer()
            ),
            'member_fund_total' => $this->getFundTotal($incomeService->member_fund_totals)
        ];
    }

    /**
     * Get Structures
     *
     * @param $structures
     * @param $transformer
     * @return array
     */
    private function getStructure($structures, $transformer)
    {
        $transformedStructures = [];

        foreach ($structures as $structure) {
            $transformedStructures[] = $transformer->transform($structure);
        }

        return $transformedStructures;
    }

    /**
     * @param $memberFundTotals
     *
     * @codeCoverageIgnore
     * @return array
     */
    private function getFundTotal($memberFundTotals)
    {
        $memberFundTotal = [];
        $memberFundTotalTransformer = new IncomeServiceMemberFundTotalTransformer();

        foreach ($memberFundTotals as $memberFundTotal) {
            $memberFundTotal[] = $memberFundTotalTransformer->transform($memberFundTotal);
        }

        return $memberFundTotal;
    }

}