<?php

use ApiGfccm\Models\Member;
use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::create([
            'apellation' => 'Jem',
            'firstname' => 'Jeremuel',
            'lastname' => 'Raymundo',
            'middlename' => 'Manlapaz',
            'gender' => 'M',
            'birthdate' => '1988-08-09',
            'address' => 'Golden City Subdivision, City of Santa Rosa, Laguna',
            'phone_mobile' => '09227430185',
            'email' => 'jeremuelraymundo.yrockdev@gmail.com'
        ]);
    }
}
