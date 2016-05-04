<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMinistryTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministry_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ministry_id');
            $table->string('type');
            $table->date('transaction_date');
            $table->double('amount');
            $table->double('running_balance');
            $table->text('description')->required();
            $table->string('document_image')->nullable();
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
        Schema::drop('ministry_transactions');
    }
}
