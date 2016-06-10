<?php

use ApiGfccm\Models\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableUserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('role_id');
            $table->timestamps();
        });

        $this->insertDefaultUserRoles();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_roles');
    }

    private function insertDefaultUserRoles()
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
