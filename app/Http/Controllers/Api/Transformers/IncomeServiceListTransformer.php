<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\IncomeService;
use League\Fractal\TransformerAbstract;

class IncomeServiceListTransformer extends TransformerAbstract
{
    /**
     * @param IncomeService $incomeService
     * @return array
     */
    public function transform(IncomeService $incomeService)
    {
        return [
            'id' => (int) $incomeService->id,
            'service_id' => (int) $incomeService->service_id,
            'tithes' => $incomeService->tithes,
            'offering' => $incomeService->offering,
            'other_fund' => $incomeService->other_fund,
            'total' => $incomeService->total,
            'service_date' => $this->reformatDateTime($incomeService->service_date),
            'service_start_time' => $this->reformatDateTime($incomeService->service->start_time, 'H:i'),
            'service_end_time' => $this->reformatDateTime($incomeService->service->end_time, 'H:i'),
            'status' => $incomeService->status,
            'created_by' => $incomeService->user->member->fullname,
            'updated_at' => $incomeService->updated_at,
            'role_access' => $incomeService->role_access,
            'service_name' => $incomeService->service->name,
            'user' => $incomeService->user->username
        ];
    }

    /**
     * @param $date
     * @param string $format
     *
     * @return false|string
     */
    private function reformatDateTime($date, $format = 'Y-m-d')
    {
        return date($format, strtotime($date));
    }

}