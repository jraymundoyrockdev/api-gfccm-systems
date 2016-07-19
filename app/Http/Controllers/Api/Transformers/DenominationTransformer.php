<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\Denomination;
use League\Fractal\TransformerAbstract;

class DenominationTransformer extends TransformerAbstract
{
    /**
     * @param Denomination $denomination
     * @return array
     */
    public function transform(Denomination $denomination)
    {
        return [
            'id' => $denomination->id,
            'amount' => (int)$denomination->amount,
            'description' => $denomination->description
        ];
    }
}