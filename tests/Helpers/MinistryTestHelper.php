<?php

use ApiGfccm\Models\Ministry;
use Faker\Factory as Faker;

trait MinistryTestHelper
{
    /**
     * Invalid Denomination Create Input
     *
     * @return array
     */
    public function invalidCreateMinistryInput()
    {
        $faker = (new Faker)->create();

        return [
            ['empty_input' => []],
            [
                'missing_name' => [
                    'name' => '',
                    'description' => $faker->sentences
                ]
            ],
            [
                'missing_description' => [
                    'name' => $faker->word,
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
    private function createMinistry($count = 1, $attributes = [])
    {
        return factory(Ministry::class, $count)->create($attributes);
    }

}
