<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIncomeServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id');
            $table->double('tithes');
            $table->double('offering');
            $table->double('other_fund');
            $table->double('total');
            $table->date('service_date');
            $table->string('status')->default('active');
            $table->integer('created_by');
            $table->integer('role_access');
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
        Schema::drop('income_services');
    }
}
