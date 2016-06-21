<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\User;
use ApiGfccm\Repositories\Interfaces\UserRepositoryInterface;

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
        return $this->user->with(['member', 'roles'])->get();
    }

    /**
     * Get a certain user
     *
     * @return User|null
     */
    public function getById($id)
    {
        return $this->user->with(['member', 'roles'])->where('id', $id)->first();
    }

    /**
     * @param string $userName
     */
    public function getByUsername($userName)
    {
        return $this->user->where('username', $userName)->first();
    }

    /**
     * @param int $id
     * @param string $userName
     * @param string $password
     *
     * @return User
     */
    public function create($id, $userName, $password)
    {
        $userData = [
            'member_id' => $id,
            'role_id' => 1,
            'username' => $userName,
            'password' => $password
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

}
