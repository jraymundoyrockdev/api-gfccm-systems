<?php

use ApiGfccm\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateNow = date('Y-m-d H:i:s');

        $ministries = [
            ['name' => 'admin', 'created_at' => $dateNow],
            ['name' => 'user', 'created_at' => $dateNow],
            ['name' => 'accountant', 'created_at' => $dateNow]
        ];

        Role::insert($ministries);//
    }
}
