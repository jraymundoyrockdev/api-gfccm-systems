<?php

use ApiGfccm\Models\Fund;
use ApiGfccm\Models\FundItem;
use Faker\Factory as Faker;

trait FundTestsHelper
{
    /**
     * @return array
     */
    public function invalidCreateFundInput()
    {
        return [
            ['name_missing' => []],
            ['duplicate_name' => ['name' => 'testName']]
        ];
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return mixed
     */
    private function createFund($count = 1, $attributes = [])
    {
        return factory(Fund::class, $count)->create($attributes);
    }

    /**
     * @param int $fundCount
     * @param int $fundItemCount
     * @param array $fundAttributes
     * @return mixed
     */
    private function createFundWithFundItems($fundCount = 1, $fundItemCount = 1, $fundAttributes = [])
    {
        $fund = factory(Fund::class, $fundCount)->create($fundAttributes);

        if (count($fund) == 1) {
            factory(FundItem::class, $fundItemCount)->create(['fund_id' => $fund->id]);

            return $fund;
        }

        foreach ($fund as $fnd) {
            factory(FundItem::class, $fundItemCount)->create(['fund_id' => $fnd->id]);
        }

        return $fund;
    }
}
