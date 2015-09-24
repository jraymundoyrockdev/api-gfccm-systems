<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use League\Fractal\TransformerAbstract;
use ApiGfccm\Models\User;


class UserTransformer extends TransformerAbstract
{
    protected $member;
    protected $userRole;

    public function __construct()
    {
        $this->member = new MemberTransformer();
        $this->userRole = new UserRoleTransformer();
    }

    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'username' => $user->username,
            'status' => $user->status,
            'member' => $this->member->transform($user->member),
            'role' => $this->userRole->transform($user->role)
        ];
    }
}