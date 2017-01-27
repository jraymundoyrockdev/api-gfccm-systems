<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */
$factory->define(\ApiGfccm\Models\MinistryTransaction::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 10000),
        'ministry_id' => $faker->numberBetween(1, 10000),
        'type' => $faker->randomElement(['income', 'expense']),
        'transaction_date' => $faker->date(),
        'amount' => $faker->numberBetween(100, 1000),
        'running_balance' => $faker->numberBetween(100, 1000),
        'description' => $faker->sentence,
        'document_image' => $faker->imageUrl()
    ];
});
