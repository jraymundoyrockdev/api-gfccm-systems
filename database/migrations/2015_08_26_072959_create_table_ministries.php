<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use ApiGfccm\Models\Ministry;

class CreateTableMinistries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        $this->insertMinistries();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ministries');
    }

    private function insertMinistries()
    {
        $dateNow = date('Y-m-d H:i:s');

        $ministries = [
            ['name' => 'Beautification', 'created_at' => $dateNow],
            ['name' => 'Dance', 'created_at' => $dateNow],
            ['name' => 'Music', 'created_at' => $dateNow],
            ['name' => 'Pastoral', 'created_at' => $dateNow],
            ['name' => 'Teaching', 'created_at' => $dateNow],
            ['name' => 'Theater', 'created_at' => $dateNow],
            ['name' => 'Usher', 'created_at' => $dateNow]
        ];

        return Ministry::insert($ministries);
    }
}
