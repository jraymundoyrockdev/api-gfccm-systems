<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\IncomeServiceFundItemStructure;
use League\Fractal\TransformerAbstract;

class IncomeServiceFundItemStructureTransformer extends TransformerAbstract
{
    /**
     * @param IncomeServiceFundItemStructure $fundItemStructure
     * @return array
     */
    public function transform(IncomeServiceFundItemStructure $fundItemStructure)
    {
        return [
            'id' => (int) $fundItemStructure->id,
            'fund_item_id' => (int) $fundItemStructure->fund_item_id,
            'name' => $fundItemStructure->name
        ];
    }
}