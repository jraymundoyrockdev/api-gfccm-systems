<?php

use ApiGfccm\Models\IncomeService;
use Faker\Factory as Faker;

trait IncomeServiceTestsHelper
{
    /**
     * @return array
     */
    public function invalidCreateIncomeServiceInput()
    {
        $faker = (new Faker)->create();

    }

    /**
     * Creates new IncomeService
     *
     * @param int $count
     * @param array $attributes
     * @return mixed
     */
    private function createIncomeService($count = 1, $attributes = [])
    {
        return factory(IncomeService::class, $count)->create($attributes);
    }


}