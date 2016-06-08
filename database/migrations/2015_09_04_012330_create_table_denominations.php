<?php

use ApiGfccm\Models\Denomination;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableDenominations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denominations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount')->unique();
            $table->string('description');
            $table->timestamps();
        });

        $this->insertDenominations();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('denominations');
    }

    private function insertDenominations()
    {
        $dateNow = date("Y-m-d H:i:s");

        Denomination::insert([
            ['amount' => 1, 'description' => 'one', 'created_at' => $dateNow],
            ['amount' => 5, 'description' => 'five', 'created_at' => $dateNow],
            ['amount' => 10, 'description' => 'ten', 'created_at' => $dateNow],
            ['amount' => 20, 'description' => 'twenty', 'created_at' => $dateNow],
            ['amount' => 50, 'description' => 'fifty', 'created_at' => $dateNow],
            ['amount' => 100, 'description' => 'one hundred', 'created_at' => $dateNow],
            ['amount' => 200, 'description' => 'two hundred', 'created_at' => $dateNow],
            ['amount' => 500, 'description' => 'five hundred', 'created_at' => $dateNow],
            ['amount' => 1000, 'description' => 'one thousand', 'created_at' => $dateNow]
        ]);
    }
}
