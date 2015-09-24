<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Repositories\Interfaces\UserRepositoryInterface;
use ApiGfccm\Models\User;

class UserRepositoryEloquent implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Returns all Users
     *
     * @return User|null
     */
    public function getAllUsers()
    {
        return $this->user->with(['member','role'])->get();
    }

    /**
     * Get a certain user
     *
     * @return User|null
     */
    public function getById($id)
    {
        return $this->user->with(['member','role'])->where('id', $id)->first();

    }


    public function createNewUserAccountFromMember(Array $payload)
    {
        $userData = [
            'username' => $this->buildUsernameFromMembersCreation($payload),
            'password' => bcrypt($payload['firstname'].$payload['lastname']),

        ];

        return $this->user->create($userData);
    }

    /**
     * @param $id
     * @param $payload
     * @return User|null
     */
    public function updateUser($id, $payload)
    {
        $user = $this->getById($id);
        $user->fill($payload)->save();

        return $user;
    }

    private function buildUsernameFromMembersCreation(Array $payload)
    {
        return 'test'.date('i');
    }

}
