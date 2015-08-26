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
        return $this->user->with(['ministry', 'member'])->get();
    }

    /**
     * Get a certain user
     *
     * @return User|null
     */
    public function getById($id)
    {
        return $this->user->with(['ministry', 'member'])->where('id', $id)->first();

    }

}
