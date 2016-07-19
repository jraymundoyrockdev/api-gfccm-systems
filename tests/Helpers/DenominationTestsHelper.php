<?php

use ApiGfccm\Models\Denomination;
use Faker\Factory as Faker;

trait DenominationTestsHelper
{
    /**
     * Invalid Denomination Create Input
     *
     * @return array
     */
    public function invalidCreateDenominationInput()
    {
        $faker = (new Faker)->create();

        return [
            ['amount_missing' => ['description' => $faker->sentence]],
            ['amount_non_integer' => ['amount' => $faker->word]],
            ['description_missing' => ['amount' => $faker->numberBetween(100, 1000)]]
        ];
    }

    /**
     * Creates new denomination
     *
     * @param int $count
     * @param array $attributes
     * @return mixed
     */
    public function createDenomination($count = 1, $attributes = [])
    {
        return factory(Denomination::class, $count)->create($attributes);
    }
}