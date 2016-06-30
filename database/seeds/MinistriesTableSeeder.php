<?php

use ApiGfccm\Models\Ministry;
use Illuminate\Database\Seeder;

class MinistriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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

        Ministry::insert($ministries);
    }
}
