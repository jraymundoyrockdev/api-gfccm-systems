<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\Fund;
use League\Fractal\TransformerAbstract;

class FundTransformer extends TransformerAbstract
{
    public function transform(Fund $fund)
    {
        return [
            'id' => (int)$fund->id,
            'name' => $fund->name,
            'description' => $fund->description,
            'category' => $fund->category
        ];
    }
}