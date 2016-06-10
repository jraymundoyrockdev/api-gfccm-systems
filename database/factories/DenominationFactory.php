<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */


$factory->define(\ApiGfccm\Models\Denomination::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->randomDigitNotNull,
        'amount' => $faker->randomDigit,
        'description' => $faker->word
    ];
});