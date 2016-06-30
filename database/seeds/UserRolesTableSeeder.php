<?php

use ApiGfccm\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateNow = date('Y-m-d H:i:s');

        $userRoles = [
            ['user_id' => 1, 'role_id' => 1, 'created_at' => $dateNow],
            ['user_id' => 1, 'role_id' => 3, 'created_at' => $dateNow],
            ['user_id' => 1, 'role_id' => 4, 'created_at' => $dateNow],
        ];

        UserRole::insert($userRoles);
    }
}
