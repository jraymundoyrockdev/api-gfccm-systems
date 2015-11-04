<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIncomeServiceFunds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_service_funds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('income_service_id');
            $table->integer('member_id');
            $table->integer('fund_id');
            $table->integer('fund_item_id');
            $table->double('amount');
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
        Schema::drop('income_service_funds');
    }
}
