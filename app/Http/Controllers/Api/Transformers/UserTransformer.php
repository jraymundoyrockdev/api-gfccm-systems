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

        foreach ($user->role as $urole) {
            if (!is_null($urole->pivot)) {
                $roles[] = $role->transform($urole);
            }
        }

        return [
            'id' => (int) $user->id,
            'username' => $user->username,
            'status' => $user->status,
            'avatar' => $user->avatar,
            'member' => $member->transform($user->member),
            'role' => $roles
        ];
    }
}