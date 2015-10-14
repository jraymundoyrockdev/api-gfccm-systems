<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */

$factory->define(\ApiGfccm\Models\FundItem::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->randomDigit,
        'fund_id' => $faker->numberBetween(1),
        'name' => $faker->word,
        'status' => $faker->randomElement(['active', 'inactive'])
    ];
});