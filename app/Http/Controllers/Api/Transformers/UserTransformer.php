<?php namespace KyokaiAccSys\Http\Controllers\Api\Transformers;

use League\Fractal\TransformerAbstract;
use KyokaiAccSys\User;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'username' => $user->username,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname
        ];
    }
}