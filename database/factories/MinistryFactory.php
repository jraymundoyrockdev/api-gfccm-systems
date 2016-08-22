<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */
$factory->define(\ApiGfccm\Models\Ministry::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 10000),
        'name' => $faker->name,
        'description' => $faker->paragraph,
    ];
});