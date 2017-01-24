<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\IncomeServiceFundStructure;
use League\Fractal\TransformerAbstract;

class IncomeServiceFundStructureTransformer extends TransformerAbstract
{
    /**
     * @param IncomeServiceFundStructure $fundStructure
     * @return array
     */
    public function transform(IncomeServiceFundStructure $fundStructure)
    {
        $itemTransformer = new IncomeServiceFundItemStructureTransformer();
        $items = [];

        foreach ($fundStructure->item_structures as $structure) {
            $items[] = $itemTransformer->transform($structure);
        }

        return [
            'id' => (int) $fundStructure->id,
            'income_service_id' => (int) $fundStructure->income_service_id,
            'fund_id' => (int) $fundStructure->fund_id,
            'name' => $fundStructure->name,
            'item' => $items
        ];
    }
}
