<?php namespace ApiGfccm\Repositories\Interfaces;

interface MemberRepositoryInterface
{
    /**
     * Returns all Members
     *
     * @return Collection|null
     */
    public function getAllMembers();

    /**
     * Get a certain Member
     *
     * @return Collection|null
     */
    public function getById($id);

    /**
     * @param $payload
     * @return static
     */
    public function createNewMember($payload);

    /**
     * @param $id
     * @param $payload
     * @return Member|null
     */
    public function updateMember($id, $payload);

}
