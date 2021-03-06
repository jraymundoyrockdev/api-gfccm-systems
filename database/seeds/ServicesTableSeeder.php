<?php

use ApiGfccm\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateNow = date("Y-m-d H:i:s");

        Service::insert([
            [
                'name' => '1st Service',
                'description' => '1st service',
                'start_time' => $this->convertUnixToLocalTime('7am'),
                'end_time' => $this->convertUnixToLocalTime('9am'),
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ],
            [
                'name' => '2nd Service',
                'description' => '2nd service',
                'start_time' => $this->convertUnixToLocalTime('10am'),
                'end_time' => $this->convertUnixToLocalTime('12pm'),
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]
        ]);
    }

    /**
     * Convert Unix to Local time
     *
     * @param $time
     * @param string $format
     * @return bool|string
     */
    private function convertUnixToLocalTime($time, $format = 'H:i:s')
    {
        return date($format, strtotime($time));
    }
}
