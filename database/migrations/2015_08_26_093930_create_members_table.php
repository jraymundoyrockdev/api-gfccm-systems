<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ministry_id')->nullable()->default(DB::raw('NULL'));
            $table->string('apellation', 32);
            $table->string('firstname', 32);
            $table->string('lastname', 32);
            $table->string('middlename', 32);
            $table->string('gender', 1); // M/F
            $table->date('birthdate');
            $table->string('address');
            $table->string('phone_mobile', 20);
            $table->string('email', 255);
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
        Schema::drop('members');
    }
}
