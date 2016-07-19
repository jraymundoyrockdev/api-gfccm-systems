<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */


$factory->define(\ApiGfccm\Models\Fund::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 10000),
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'category' => $faker->randomElement(['service', 'others']),
        'status' => $faker->randomElement(['active', 'inactive'])
    ];
});