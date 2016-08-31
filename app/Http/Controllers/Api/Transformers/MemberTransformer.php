<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\Member;
use Illuminate\Database\Eloquent\Collection;
use League\Fractal\TransformerAbstract;

class MemberTransformer extends TransformerAbstract
{
    /**
     * @param Member $member
     * @return array
     */
    public function transform(Member $member)
    {
        $ministries = $this->transformMinistry($member->ministries);

        return [
            'id' => (int)$member->id,
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
            'ministries' => $ministries
        ];
    }

    /**
     * @param Collection $ministries
     * @return array
     */
    private function transformMinistry(Collection $ministries)
    {
        if (empty($ministries)) {
            return [];
        }

        foreach ($ministries as $ministry) {
            return [
                'name' => $ministry->name,
                'description' => $ministry->description
            ];
        }
    }
}