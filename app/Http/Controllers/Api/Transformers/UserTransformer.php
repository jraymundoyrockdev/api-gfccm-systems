<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\Member;
use ApiGfccm\Models\Role;
use League\Fractal\TransformerAbstract;
use ApiGfccm\Models\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        $role = new RoleTransformer();
        $roles = [];

        foreach ($user->roles as $urole) {
            if (!is_null($urole->pivot)) {
                $roles[] = $role->transform($urole);
            }
        }

        return [
            'id' => (int) $user->id,
            'username' => $user->username,
            'status' => $user->status,
            'avatar' => $user->avatar,
            'member' => $this->transformMember($user->member),
            'role' => $roles
        ];
    }

    /**
     * @param Member $member
     * @return array
     */
    private function transformMember(Member $member)
    {
        return [
            'firstname' => $member->firstname,
            'lastname' => $member->lastname,
            'fullname' => $member->full_name,
            'fullname_with_apellation' => $member->full_name_with_apellation,
            'middlename' => $member->middlename,
            'apellation' => $member->apellation
        ];
    }
}