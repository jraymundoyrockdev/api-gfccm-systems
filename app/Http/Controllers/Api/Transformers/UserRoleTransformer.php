<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use League\Fractal\TransformerAbstract;
use ApiGfccm\Models\UserRole;

class UserRoleTransformer extends TransformerAbstract
{
    public function transform(UserRole $userRole)
    {
        return [
            'id' => (int)$userRole->id,
            'name' => $userRole->name,
            'description' => $userRole->description
        ];
    }
}