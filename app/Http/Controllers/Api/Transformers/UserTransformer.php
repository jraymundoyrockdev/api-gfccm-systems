<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use League\Fractal\TransformerAbstract;
use ApiGfccm\Models\User;


class UserTransformer extends TransformerAbstract
{

    protected $ministry;
    protected $member;

    public function __construct()
    {
        $this->ministry = new MinistryTransformer();
        $this->member = new MemberTransformer();
    }

    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'username' => $user->username,
            'ministry' => $this->ministry->transform($user->ministry),
            'member' => $this->member->transform($user->member)
        ];
    }
}