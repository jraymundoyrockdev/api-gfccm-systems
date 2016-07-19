<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */
$factory->define(\ApiGfccm\Models\Denomination::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 10000),
        'amount' => $faker->numberBetween(1, 10000),
        'description' => $faker->word
    ];
});