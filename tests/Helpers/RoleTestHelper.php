<?php

use ApiGfccm\Models\Role;

trait RoleTestsHelper
{
    /**
     * @param int $count
     * @param array $attributes
     * @return mixed
     */
    private function createRole($count = 1, $attributes = [])
    {
        return factory(Role::class, $count)->create($attributes);
    }

}
