<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Member;
use ApiGfccm\Models\User;
use ApiGfccm\Repositories\Interfaces\MemberRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\RepositoryInterface;
use ApiGfccm\Repositories\Interfaces\UserRepositoryInterface;

class MemberRepositoryEloquent implements RepositoryInterface, MemberRepositoryInterface
{
    /**
     * @var Member
     */
    protected $member;

    /**
     * @var User
     */
    protected $user;

    /**
     * MemberRepositoryEloquent constructor.
     * @param Member $member
     * @param UserRepositoryInterface $user
     */
    public function __construct(Member $member, UserRepositoryInterface $user)
    {
        $this->member = $member;
        $this->user = $user;
    }

    /**
     * @return Member|null
     */
    public function all()
    {
        return $this->member->all();
    }

    /**
     * @param int $id
     * @return Member|null
     */
    public function findById($id)
    {
        return $this->member->find($id);
    }

    /**
     * @param array $payload
     * @return Member
     */
    public function create(array $payload)
    {
        return $this->member->create($payload);
    }

    /**
     * @param array $payload
     * @param int $id
     * @return Member|null
     */
    public function update(array $payload, $id)
    {
        $member = $this->member->find($id);

        if(! $member){
            return null;
        }

        $member->fill($payload)->save();

        return $member;
    }

}
