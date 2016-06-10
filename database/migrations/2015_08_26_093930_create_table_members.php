<?php

use ApiGfccm\Models\Member;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableMembers extends Migration
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

        $this->insertDefaultMember();
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

    private function insertDefaultMember()
    {
        Member::create([
            'apellation' => 'Jem',
            'firstname' => 'Jeremuel',
            'lastname' => 'Raymundo',
            'middlename' => 'Manlapaz',
            'gender' => 'M',
            'birthdate' => '1988-08-09',
            'address' => 'Golden City Subdivision, City of Santa Rosa, Laguna',
            'phone_mobile' => '09227430185',
            'email' => 'jeremuelraymundo.yrockdev@gmail.com'
        ]);
    }
}
