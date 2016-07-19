<?php

use ApiGfccm\Models\Fund;
use Faker\Factory as Faker;

trait FundTestsHelper
{
    public function invalidCreateFundInput()
    {
        $faker = (new Faker)->create();

        return [];
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return mixed
     */
    private function createNewFund($count = 1, $attributes = [])
    {
        return factory(Fund::class, $count)->create($attributes);
    }
}