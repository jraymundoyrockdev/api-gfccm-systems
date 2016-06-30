<?php

use ApiGfccm\Models\MemberMinistry;
use Illuminate\Database\Seeder;

class MemberMinistriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MemberMinistry::create([
            'member_id' => 1,
            'ministry_id' => 3
        ]);
    }
}
