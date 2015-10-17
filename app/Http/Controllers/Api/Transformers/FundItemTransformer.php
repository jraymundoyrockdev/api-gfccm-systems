<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\FundItem;
use League\Fractal\TransformerAbstract;

class FundItemTransformer extends TransformerAbstract
{
    public function transform(FundItem $item)
    {
        return [
            'id' => $item->id,
            'fund_id' => $item->fund_id,
            'name' => $item->name,
            'status' => $item->status
        ];
    }
}