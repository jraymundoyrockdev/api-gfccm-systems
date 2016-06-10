<?php

use ApiGfccm\Models\Fund;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableFunds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('category');
            $table->string('status')->default('active');
            $table->timestamps();
        });

        $this->insertDefaultFunds();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('funds');
    }

    private function insertDefaultFunds()
    {
        $dateNow = date("Y-m-d H:i:s");

        Fund::insert([
            ['name' => 'General / Operational Fund', 'category' => 'service', 'created_at' => $dateNow],
            ['name' => 'Special Fund', 'category' => 'service', 'created_at' => $dateNow],
            ['name' => 'Pastoral Fund', 'category' => 'service', 'created_at' => $dateNow],
            ['name' => 'Ministry Fund', 'category' => 'service', 'created_at' => $dateNow],
        ]);
    }
}
