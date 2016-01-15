<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use ApiGfccm\Models\Fund;

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

        $this->insertFunds();
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

    private function insertFunds()
    {
        $dateNow = date("Y-m-d H:i:s");

        return Fund::insert([
            ['name' => 'General / Operational Funds', 'category' => 'service', 'created_at' => $dateNow],
            ['name' => 'Mission Funds', 'category' => 'service', 'created_at' => $dateNow],
            ['name' => 'Pastoral Funds', 'category' => 'service', 'created_at' => $dateNow],
            ['name' => 'Ministry Funds', 'category' => 'service', 'created_at' => $dateNow],
        ]);
    }
}
