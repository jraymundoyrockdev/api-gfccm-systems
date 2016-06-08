<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableIncomeServiceFundItemStructures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_service_fund_item_structures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fund_structure_id');
            $table->integer('fund_item_id');
            $table->string('name');
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
        Schema::drop('income_service_fund_item_structures');
    }
}
