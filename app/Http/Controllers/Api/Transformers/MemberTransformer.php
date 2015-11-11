<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use League\Fractal\TransformerAbstract;
use ApiGfccm\Models\Member;

class MemberTransformer extends TransformerAbstract
{
    public function transform(Member $member)
    {
        $ministry = new MinistryTransformer();
        $memMinistry = [];

        foreach ($member->member_ministry as $memMin) {
            $memMinistry[] = $ministry->transform($memMin->ministry);
        }

        return [
            'id' => (int) $member->id,
            'firstname' => $member->firstname,
            'lastname' => $member->lastname,
            'fullname' => $member->full_name,
            'fullname_with_apellation' => $member->full_name_with_apellation,
            'middlename' => $member->middlename,
            'apellation' => $member->apellation,
            'gender' => $member->gender,
            'birthdate' => $member->birthdate,
            'address' => $member->address,
            'phone_mobile' => $member->phone_mobile,
            'email' => $member->email,
            'ministry' => $memMinistry
        ];
    }
}