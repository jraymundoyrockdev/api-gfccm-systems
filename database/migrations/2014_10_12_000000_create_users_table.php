<?php

use ApiGfccm\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->string('username')->unique();
            $table->string('password', 60);
            $table->string('status', 10)->default('inactive');
            $table->string('avatar')->default('default-avatar.png');
            //$table->rememberToken();
            $table->timestamps();
        });

        $this->insertDefaultUser();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }

    protected function insertDefaultUser()
    {
        User::create([
            'member_id' => 1,
            'username' => 'jraymundo',
            'password' => '$2y$10$HtTdAr6zASVsvxWo/Nv/jun0/FuB.hZfYYOqYHzTWw6BQ1PqxdJze',
            'status' => 'active'
        ]);
    }
}



