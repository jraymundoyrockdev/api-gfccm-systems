<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use League\Fractal\TransformerAbstract;
use ApiGfccm\Models\UserRole;

class UserRoleTransformer extends TransformerAbstract
{
    protected $role;

    public function __construct()
    {
        $this->role = new RoleTransformer();
    }

    public function transform(UserRole $userRole)
    {
        return [
            'id' => (int)$userRole->id,
            'user_id' => $userRole->user_id,
            'role_id' => $userRole->role_id,
            'user_role' =>  $this->role->transform($userRole->role)
        ];
    }
}