<?php

use ApiGfccm\Models\FundItem;
use Faker\Factory as Faker;

trait FundItemTestsHelper
{
    /**
     * @return array
     */
    public function invalidCreateFundItemInput()
    {
        $faker = (new Faker)->create();

        return [
            ['fund_id_missing' => ['name' => $faker->word]],
            ['name_missing' => ['fund_id' => $faker->numberBetween(1, 10000)]]
        ];
    }

    /**
     * Creates new FundItem
     *
     * @param int $count
     * @param array $attributes
     * @return mixed
     */
    private function createFundItem($count = 1, $attributes = [])
    {
        return factory(FundItem::class, $count)->create($attributes);
    }

}