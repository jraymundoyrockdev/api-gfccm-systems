<?php

use ApiGfccm\Models\Service;
use Faker\Factory as Faker;

trait ServiceTestHelper
{
    /**
     * Invalid Service Create Input
     *
     * @return array
     */
    public function invalidCreateServiceInput()
    {
        $faker = (new Faker)->create();

        return [
            ['empty_input' => []],
            [
                'missing_name' => [
                    'name' => '',
                    'start_time' => $faker->time('H:i'),
                    'end_time' => $faker->time('H:i'),
                    'description' => $faker->sentences
                ]
            ],
            [
                'missing_start_time' => [
                    'name' => $faker->word,
                    'start_time' => '',
                    'end_time' => $faker->time('H:i'),
                    'description' => $faker->sentences
                ]
            ],
            [
                'missing_end_time' => [
                    'name' => $faker->word,
                    'start_time' => $faker->time('H:i'),
                    'end_time' => '',
                    'description' => $faker->sentences
                ]
            ],
            [
                'missing_description' => [
                    'name' => $faker->word,
                    'start_time' => $faker->time('H:i'),
                    'end_time' => $faker->time('H:i'),
                    'description' => ''
                ]
            ]
        ];
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return mixed
     */
    private function createService($count = 1, $attributes = [])
    {
        return factory(Service::class, $count)->create($attributes);
    }

}
