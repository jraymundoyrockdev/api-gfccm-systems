<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */
$factory->define(\ApiGfccm\Models\Denomination::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 1000),
        'amount' => $faker->numberBetween(1, 1000),
        'description' => $faker->word
    ];
});