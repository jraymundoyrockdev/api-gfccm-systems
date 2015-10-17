<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */


$factory->define(\ApiGfccm\Models\Fund::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->randomDigit,
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'category' => $faker->randomElement(['service', 'others']),
        'status' => $faker->randomElement(['active', 'inactive'])
    ];
});