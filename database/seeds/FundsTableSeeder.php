<?php

use ApiGfccm\Models\Fund;
use Illuminate\Database\Seeder;

class FundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateNow = date("Y-m-d H:i:s");

        Fund::insert([
            ['name' => 'General / Operational Fund', 'category' => 'service', 'created_at' => $dateNow],
            ['name' => 'Special Fund', 'category' => 'service', 'created_at' => $dateNow],
            ['name' => 'Pastoral Fund', 'category' => 'service', 'created_at' => $dateNow],
            ['name' => 'Ministry Fund', 'category' => 'service', 'created_at' => $dateNow],
        ]);
    }
}
