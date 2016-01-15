<?php

use ApiGfccm\Models\Service;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->timestamps();
        });

        $this->insertServices();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('services');
    }

    private function insertServices()
    {
        $dateNow = date("Y-m-d H:i:s");

        return Service::insert([
            ['name' => '1st Service', 'description' => '1st service', 'created_at' => $dateNow],
            ['name' => '2nd Service', 'description' => '2nd service', 'created_at' => $dateNow]
        ]);
    }
}
