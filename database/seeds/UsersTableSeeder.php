<?php

use ApiGfccm\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'member_id' => 1,
            'username' => 'jraymundo',
            'password' => '$2y$10$HtTdAr6zASVsvxWo/Nv/jun0/FuB.hZfYYOqYHzTWw6BQ1PqxdJze',
            'status' => 'active'
        ]);//
    }
}
