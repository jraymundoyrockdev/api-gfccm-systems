<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */

$factory->define(\ApiGfccm\Models\FundItem::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 100000),
        'fund_id' => $faker->numberBetween(1, 100000),
        'name' => $faker->word,
        'status' => $faker->randomElement(['active', 'inactive'])
    ];
});