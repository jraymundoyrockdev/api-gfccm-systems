<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

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
        $member = new MemberTransformer();
        $role = new RoleTransformer();
        $roles = [];

        foreach ($user->roles as $urole) {
            if (!is_null($urole->pivot)) {
                $roles[] = $role->transform($urole);
            }
        }

        return [
            'id' => $user->id,
            'username' => $user->username,
            'status' => $user->status,
            'member' => $member->transform($user->member),
            'user_role' => $roles
        ];
    }
}