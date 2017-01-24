<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\IncomeServiceDenomination;
use League\Fractal\TransformerAbstract;

class IncomeServiceDenominationTransformer extends TransformerAbstract
{
    /**
     * @param IncomeServiceDenomination $denominationStructure
     * @return array
     */
    public function transform(IncomeServiceDenomination $denominationStructure)
    {
        return [
            'id' => (int) $denominationStructure->id,
            'income_service_id' => (int) $denominationStructure->income_service_id,
            'denomination_id' => (int) $denominationStructure->denomination_id,
            'description' => $denominationStructure->description,
            'amount' => $denominationStructure->amount,
            'piece' => $denominationStructure->piece,
            'total' => $denominationStructure->total
        ];
    }
}