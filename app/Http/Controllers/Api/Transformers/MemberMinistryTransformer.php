<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use League\Fractal\TransformerAbstract;
use ApiGfccm\Models\MemberMinistry;

class MemberMinistryTransformer extends TransformerAbstract
{
    public function transform(MemberMinistry $memMinistry)
    {
        $ministry = new MinistryTransformer();

        return [
            'id' => (int) $memMinistry->id,
            'member_id' => (int) $memMinistry->member_id,
            'ministry_id' => (int) $memMinistry->ministry_id,
            'ministry' =>  $ministry->transform($memMinistry->ministry)
        ];
    }
}