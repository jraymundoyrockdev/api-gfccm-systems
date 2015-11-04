<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\IncomeServiceDenominationStructure;
use League\Fractal\TransformerAbstract;

class IncomeServiceDenominationStructureTransformer extends TransformerAbstract
{
    /**
     * @param IncomeServiceDenominationStructure $denominationStructure
     * @return array
     */
    public function transform(IncomeServiceDenominationStructure $denominationStructure)
    {
        return [
            'id' => (int) $denominationStructure->id,
            'denomination_id' => (int) $denominationStructure->denomination_id,
            'amount' => $denominationStructure->amount
        ];
    }
}