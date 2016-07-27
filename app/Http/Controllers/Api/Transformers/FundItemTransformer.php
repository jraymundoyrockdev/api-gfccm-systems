<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\FundItem;
use League\Fractal\TransformerAbstract;

class FundItemTransformer extends TransformerAbstract
{
    /**
     * @param FundItem $item
     * @return array
     */
    public function transform(FundItem $item)
    {
        $fund = new FundTransformer();

        return [
            'id' => $item->id,
            'name' => $item->name,
            'status' => $item->status,
            'fund' => $fund->transform($item->fund)
        ];
    }
}