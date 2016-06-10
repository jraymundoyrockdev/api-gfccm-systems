<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableIncomeServiceMemberFundTotals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_service_member_fund_totals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('income_service_id');
            $table->integer('member_id');
            $table->double('tithes');
            $table->double('offering');
            $table->double('others');
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
        Schema::drop('income_service_member_fund_totals');
    }
}
