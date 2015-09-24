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
        return $this->user->with(['member', 'user_role'])->get();
    }

    /**
     * Get a certain user
     *
     * @return User|null
     */
    public function getById($id)
    {
        return $this->user->with(['member', 'user_role'])->where('id', $id)->first();

    }


    public function createNewUserAccountFromMember($id, $firstname, $lastname)
    {
        $userData = [
            'member_id' => $id,
            'role_id' => 1,
            'username' => $this->buildUsernameFromMembersCreation($firstname, $lastname),
            'password' => $this->buildPasswordFromMembersCreation($firstname, $lastname)
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

    private function buildUsernameFromMembersCreation($firstname, $lastname)
    {
        return strtolower($firstname . $lastname);
    }

    private function buildPasswordFromMembersCreation($firstname, $lastname)
    {
        return bcrypt(strtolower($firstname . $lastname . 'abc123'));
    }

}
