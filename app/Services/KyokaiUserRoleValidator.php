<?php
namespace ApiGfccm\Services;

class KyokaiUserRoleValidator
{
    protected $authUser = [3];

    public function validate($user)
    {
        $roles = array_column($user->user_role->toArray(), 'role_id');

        if (!array_intersect($this->authUser, $roles)) {
            return false;
        }

        return true;
    }
}