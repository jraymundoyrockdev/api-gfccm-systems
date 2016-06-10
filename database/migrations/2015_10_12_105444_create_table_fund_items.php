<?php

use ApiGfccm\Models\FundItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableFundItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fund_id');
            $table->string('name');
            $table->string('status')->default('active');
            $table->timestamps();
        });

        $this->insertDefaultFundItems();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fund_items');
    }

    private function insertDefaultFundItems()
    {
        $dateNow = date("Y-m-d H:i:s");

        FundItem::insert([
            ['fund_id' => 1, 'name' => 'Tithes', 'created_at' => $dateNow],
            ['fund_id' => 1, 'name' => 'Offering', 'created_at' => $dateNow],
            ['fund_id' => 2, 'name' => 'Mission Fund', 'created_at' => $dateNow],
            ['fund_id' => 2, 'name' => 'Building Fund', 'created_at' => $dateNow],
            ['fund_id' => 2, 'name' => 'Scholarship Fund', 'created_at' => $dateNow],
            ['fund_id' => 2, 'name' => 'Equipping/Training Fund', 'created_at' => $dateNow],
            ['fund_id' => 2, 'name' => 'Love Gift', 'created_at' => $dateNow],
            ['fund_id' => 3, 'name' => 'Car', 'created_at' => $dateNow],
            ['fund_id' => 4, 'name' => 'Beautification', 'created_at' => $dateNow],
            ['fund_id' => 4, 'name' => 'Dance', 'created_at' => $dateNow],
            ['fund_id' => 4, 'name' => 'Music', 'created_at' => $dateNow],
            ['fund_id' => 4, 'name' => 'Pastoral', 'created_at' => $dateNow],
            ['fund_id' => 4, 'name' => 'Teaching', 'created_at' => $dateNow],
            ['fund_id' => 4, 'name' => 'Theater', 'created_at' => $dateNow],
            ['fund_id' => 4, 'name' => 'Usher', 'created_at' => $dateNow]
        ]);
    }
}
