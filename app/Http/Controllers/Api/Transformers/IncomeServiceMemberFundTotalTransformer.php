<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\IncomeServiceMemberFundTotal;
use League\Fractal\TransformerAbstract;

class IncomeServiceMemberFundTotalTransformer extends TransformerAbstract
{
    public function transform(IncomeServiceMemberFundTotal $fund)
    {
        return [
            'id' => (int) $fund->id,
            'income_service_id' => $fund->income_service_id,
            'member_id' => $fund->member_id,
            'member' => $fund->member->full_name,
            'tithes' => $fund->tithes,
            'offering' => $fund->offering,
            'others' => $fund->others,
            'total' => $fund->total
        ];
    }
}
