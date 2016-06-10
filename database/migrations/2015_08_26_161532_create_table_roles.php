<?php

use ApiGfccm\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->timestamps();
        });

        $this->insertRoles();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
    }

    private function insertRoles()
    {
        $dateNow = date('Y-m-d H:i:s');

        $ministries = [
            ['name' => 'admin', 'created_at' => $dateNow],
            ['name' => 'user', 'created_at' => $dateNow],
            ['name' => 'accountant', 'created_at' => $dateNow]
        ];

        Role::insert($ministries);
    }
}
