<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use League\Fractal\TransformerAbstract;
use ApiGfccm\Models\Ministry;

class MinistryTransformer extends TransformerAbstract
{
    public function transform(Ministry $ministry)
    {
        return [
            'id' => (int)$ministry->id,
            'name' => $ministry->name,
            'description' => $ministry->description
        ];
    }
}