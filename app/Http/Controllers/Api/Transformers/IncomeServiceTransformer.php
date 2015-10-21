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
        $service = new ServiceTransformer();
        $user = new UserTransformer();

        return [
            'id' => (int) $incomeService->id,
            'service_id' => $incomeService->service_id,
            'tithes' => $incomeService->tithes,
            'offering' => $incomeService->offering,
            'other_fund' => $incomeService->other_fund,
            'service_date' => $incomeService->service_date,
            'status' => $incomeService->status,
            'created_by' => $incomeService->created_by,
            'role_access' => $incomeService->role_access,
            'service' => $service->transform($incomeService->service),
            'user' => $user->transform($incomeService->user)
        ];
    }
}