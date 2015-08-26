<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use League\Fractal\TransformerAbstract;
use ApiGfccm\Models\Member;

class MemberTransformer extends TransformerAbstract
{
    public function transform(Member $member)
    {
        return [
            'id' => (int)$member->id,
            'firstname' => $member->firstname,
            'lastname' => $member->lastname,
            'middlename' => $member->middlename,
            'gender' => $member->gender,
            'birthdate' => $member->birthdate,
            'address' => $member->address,
            'phone_mobile' => $member->phone_mobile,
            'email' => $member->email
        ];
    }
}