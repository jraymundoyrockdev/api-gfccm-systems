<?php namespace KyokaiAccSys\Repositories\Eloquent;

use KyokaiAccSys\Repositories\Interfaces\UserRepositoryInterface;
use KyokaiAccSys\User;

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
     * @return Collection|null
     */
    public function getAllUsers()
    {
        return $this->user->all();
    }

}
