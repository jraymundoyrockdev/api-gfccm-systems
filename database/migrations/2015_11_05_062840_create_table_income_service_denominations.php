<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableIncomeServiceDenominations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_service_denominations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('income_service_id');
            $table->integer('denomination_id');
            $table->string('description');
            $table->double('amount');
            $table->double('piece');
            $table->double('total');
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
        Schema::drop('income_service_denominations');
    }
}
