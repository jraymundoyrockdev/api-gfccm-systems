<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use League\Fractal\TransformerAbstract;
use ApiGfccm\Models\Denomination;

class DenominationTransformer extends TransformerAbstract
{
    public function transform(Denomination $denomination)
    {
        return [
            'id' => (int)$denomination->id,
            'amount' => (int)$denomination->amount,
            'description' => $denomination->description
        ];
    }
}