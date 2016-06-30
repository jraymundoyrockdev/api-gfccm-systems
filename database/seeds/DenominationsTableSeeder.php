<?php

use ApiGfccm\Models\Denomination;
use Illuminate\Database\Seeder;

class DenominationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateNow = date("Y-m-d H:i:s");

        Denomination::insert([
            ['amount' => 1, 'description' => 'one', 'created_at' => $dateNow],
            ['amount' => 5, 'description' => 'five', 'created_at' => $dateNow],
            ['amount' => 10, 'description' => 'ten', 'created_at' => $dateNow],
            ['amount' => 20, 'description' => 'twenty', 'created_at' => $dateNow],
            ['amount' => 50, 'description' => 'fifty', 'created_at' => $dateNow],
            ['amount' => 100, 'description' => 'one hundred', 'created_at' => $dateNow],
            ['amount' => 200, 'description' => 'two hundred', 'created_at' => $dateNow],
            ['amount' => 500, 'description' => 'five hundred', 'created_at' => $dateNow],
            ['amount' => 1000, 'description' => 'one thousand', 'created_at' => $dateNow]
        ]);
    }
}
