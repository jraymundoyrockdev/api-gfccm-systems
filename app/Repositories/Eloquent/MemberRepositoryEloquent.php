<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Repositories\Interfaces\MemberRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\UserRepositoryInterface;
use ApiGfccm\Models\Member;

class MemberRepositoryEloquent implements MemberRepositoryInterface
{
    /**
     * @var Member
     */
    protected $member;

    /**
     * @var User
     */
    protected $user;

    public function __construct(Member $member, UserRepositoryInterface $user)
    {
        $this->member = $member;
        $this->user = $user;
    }

    /**
     * Returns all Services
     *
     * @return Service|null
     */
    public function getAllMembers()
    {
        return $this->member->all();
    }

    /**
     * Get a certain service
     *
     * @return Service|null
     */
    public function getById($id)
    {
        return $this->member->find($id);
    }

    /**
     * @param $payload
     * @return static
     */
    public function createNewMember($payload)
    {
        $member = $this->member->create($payload);

        $this->user->createNewUserAccountFromMember($member->toArray());
    }

    /**
     * @param $id
     * @param $payload
     * @return Service|null
     */
    public function updateMember($id, $payload)
    {

    }

}
