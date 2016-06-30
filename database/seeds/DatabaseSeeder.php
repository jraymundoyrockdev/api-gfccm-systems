<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(MinistriesTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(DenominationsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(MemberMinistriesTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(FundsTableSeeder::class);
        $this->call(FundItemsTableSeeder::class);

        Model::reguard();
    }
}
