<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */

$factory->define(\ApiGfccm\Models\IncomeServiceFundItemStructure::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 1000),
        'fund_structure_id' => $faker->numberBetween(1, 1000),
        'fund_item_id' => $faker->numberBetween(1, 1000),
        'name' => $faker->word
    ];
});