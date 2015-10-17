<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\Fund;
use League\Fractal\TransformerAbstract;

class FundTransformer extends TransformerAbstract
{
    public function transform(Fund $fund)
    {
        $items = [];
        $itemTransformer = new FundItemTransformer();

        foreach ($fund->item as $item) {
            $items[] = $itemTransformer->transform($item);
        }

        return [
            'id' => (int) $fund->id,
            'name' => $fund->name,
            'description' => $fund->description,
            'category' => $fund->category,
            'item' => $items
        ];
    }
}