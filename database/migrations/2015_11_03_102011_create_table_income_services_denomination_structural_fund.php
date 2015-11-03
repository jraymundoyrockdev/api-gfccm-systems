<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIncomeServicesDenominationStructuralFund extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_service_denomination_structural_funds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('income_service_id');
            $table->double('denomination_id');
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
        Schema::drop('income_service_denomination_structural_funds');
    }
}
