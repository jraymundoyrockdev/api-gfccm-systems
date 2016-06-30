<?php

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
        if (!Schema::hasTable('denominations')) {
            Schema::create('denominations', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('amount')->unique();
                $table->string('description');
                $table->timestamps();
            });
        }
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
}
