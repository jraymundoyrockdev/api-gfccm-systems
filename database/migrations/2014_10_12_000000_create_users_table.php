<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('ministry_id')->nullable()->default(DB::raw('NULL'));
            $table->integer('member_id')->nullable()->default(DB::raw('NULL'));
            $table->integer('role_id')->default(1);
            $table->string('username')->unique();
            $table->string('password', 60);
            $table->integer('active')->default(1);
            //$table->rememberToken();
            $table->timestamps();
        });
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
}
