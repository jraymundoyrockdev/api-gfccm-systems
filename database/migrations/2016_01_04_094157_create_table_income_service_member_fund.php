<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableIncomeServiceMemberFund extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_service_member_funds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('income_service_id');
            $table->integer('member_id');
            $table->double('fund_id');
            $table->double('fund_item_id');
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
        Schema::drop('income_service_member_funds');
    }
}
