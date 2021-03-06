<?php

use ApiGfccm\Models\IncomeService;
use ApiGfccm\Models\IncomeServiceDenomination;
use ApiGfccm\Models\IncomeServiceFundStructure;
use ApiGfccm\Repositories\Eloquent\IncomeServiceRepositoryEloquent;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class IncomeServiceRepositoryEloquentTest extends ApiTestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration, IncomeServiceTestsHelper, ServiceTestHelper, UserTestHelper, FundTestsHelper, FundItemTestsHelper, DenominationTestsHelper;

    protected $repository;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->repository = $this->app->make(IncomeServiceRepositoryEloquent::class);
    }

    /** @test */
    public function it_returns_income_service_on_create()
    {
        $input = factory(IncomeService::class)->make();

        $result = $this->repository->create($input->toArray());

        $this->assertInstanceOf(IncomeService::class, $result);
        $this->seeInDatabase('income_services', [
            'service_id' => $input->service_id,
            'tithes' => $input->tithes,
            'offering' => $input->offering,
            'other_fund' => $input->other_fund,
            'service_date' => $input->service_date,
            'total' => $input->total,
            'status' => $input->status,
            'created_by' => $input->created_by
        ]);
        $this->attributeValuesEqualsToExpected([
            'service_id',
            'tithes',
            'offering',
            'other_fund',
            'service_date',
            'total',
            'status',
            'created_by'
        ], $input, $result);
    }

    /** @test */
    public function it_returns_income_service()
    {
        $incomeService = $this->prepareIncomeService();

        $result = $this->repository->findById($incomeService->id);

        $this->assertInstanceOf(IncomeService::class, $result);
        $this->assertEquals($incomeService->id, $result->id);
    }

    /** @test */
    public function it_returns_null_when_income_service_does_not_exist()
    {
        $result = $this->repository->findById(self::UNKNOWN_ID);

        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_a_collection_income_services()
    {
        $incomeService = $this->prepareIncomeService(5);

        $result = $this->repository->all();

        $this->assertInstanceOf(IncomeService::class, $result[0]);
        $this->assertEquals(5, count($incomeService));
    }

    /** @test */
    public function it_returns_an_empty_collection_if_no_income_service_exists()
    {
        $result = $this->repository->all();

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_returns_income_service_on_update()
    {
        $faker = (new Faker)->create();

        $incomeService = $this->prepareIncomeService();

        $updateInput = [
            'tithes' => $faker->randomFloat(2),
            'offering' =>  $faker->randomFloat(2),
            'other_fund' =>  $faker->randomFloat(2),
            'total' =>  $faker->randomFloat(2),
            'service_date' => $faker->date()
        ];

        $result = $this->repository->update($updateInput, $incomeService->id);

        $this->assertInstanceOf(IncomeService::class, $result);
        $this->assertEquals($incomeService->id, $result->id);
        $this->seeInDatabase('income_services', [
            'tithes' => $updateInput['tithes'],
            'offering' => $updateInput['offering'],
            'other_fund' => $updateInput['other_fund'],
            'service_date' => $updateInput['service_date'],
            'total' => $updateInput['total']
        ]);
        $this->attributeValuesEqualsToExpected([
            'tithes',
            'offering',
            'other_fund',
            'service_date',
            'total'
        ], $updateInput, $result);
    }

    /** @test */
    public function it_returns_null_on_update_if_income_service_does_not_exist()
    {
        $result = $this->repository->update([], self::UNKNOWN_ID);

        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_income_service_when_filter_by_year_and_month()
    {
        $toBeSearchedIncomeServices = $this->prepareIncomeService(3, ['service_date' => date('Y-m-d', strtotime('-1 month'))]);
        $newIncomeServices = $this->prepareIncomeService(2, ['service_date' => date('Y-m-d')]);

        $pastYear = date('Y', strtotime('-1 month'));
        $pastMonth = date('m', strtotime('-1 month'));

        $result = $this->repository->findByYearAndMonth($pastYear, $pastMonth);

        $this->assertInstanceOf(IncomeService::class, $result[0]);
        $this->assertEquals(3, count($result));
    }

    /** @test */
    public function it_returns_income_service_filtered_to_current_year_and_date_when_no_year_and_month_declared()
    {
        $toBeSearchedIncomeServices = $this->prepareIncomeService(3, ['service_date' => date('Y-m-d', strtotime('-1 month'))]);
        $newIncomeServices = $this->prepareIncomeService(2, ['service_date' => date('Y-m-d')]);

        $result = $this->repository->findByYearAndMonth();

        $this->assertInstanceOf(IncomeService::class, $result[0]);
        $this->assertEquals(2, count($result));
    }

    /** @test */
    public function it_returns_and_empty_collection_when_no_income_service_found_on_filter_by_year_and_month()
    {
        $result = $this->repository->findByYearAndMonth();

        $this->assertEmpty($result);
    }


    /** @test */
    public function it_creates_fund_structures()
    {
        $incomeService = $this->prepareIncomeService();
        $fundStructure = $this->buildFundStructure($incomeService->id);

        $result = $this->repository->createFundStructure($fundStructure);

        $this->assertTrue($result);
        $this->seeInDatabaseMultiple('income_service_fund_structures', $fundStructure);
    }

    /** @test */
    public function it_creates_fund_item_structures()
    {
        $fundItemsStructure = $this->buildFundItemStructure();

        $result = $this->repository->createFundItemStructure($fundItemsStructure);

        $this->assertTrue($result);
        $this->seeInDatabaseMultiple('income_service_fund_item_structures', $fundItemsStructure);
    }

    /** @test */
    public function it_creates_denomination_structures()
    {
        $incomeService = $this->prepareIncomeService();
        $denominationStructure = $this->buildDenominationStructure($incomeService->id);

        $result = $this->repository->createDenominationStructure($denominationStructure);

        $this->assertTrue($result);
        $this->seeInDatabaseMultiple('income_service_denominations', $denominationStructure);
    }

    /** @test */
    public function it_updates_denominations()
    {
        $incomeService = $this->prepareIncomeService();
        $denominationStructure = $this->buildDenominationStructure($incomeService->id);

        $this->repository->createDenominationStructure($denominationStructure);

        $savedDenomination = (new IncomeServiceDenomination)->where('income_service_id',$incomeService->id)->where('denomination_id', $denominationStructure[0]['denomination_id'])->first();

        $forUpdateInput = [['id' => $savedDenomination->id, 'piece' => 100, 'total' => 1000]];

        $result = $this->repository->updateDenomination($forUpdateInput);

        $this->assertEquals($forUpdateInput, $result);
        $this->seeInDatabase('income_service_denominations', [
            'piece' => 100,
            'total' => 1000,
        ]);
    }

    /** @test */
    public function it_returns_null_on_updating_denomination_when_payload_is_invalid()
    {
        $result = $this->repository->updateDenomination([]);

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_returns_income_service_when_updating_fund_by_adding_field_value()
    {
        $faker = (new Faker)->create();
        $incomeService = $this->prepareIncomeService();

        $payload = [
            'tithes' => $faker->numberBetween(1, 500),
            'offering' => $faker->numberBetween(1, 500),
            'other_fund' => $faker->numberBetween(1, 500),
            'total' => $faker->numberBetween(1, 500)
        ];

        $expectedPayload = [
            'tithes' => $incomeService->tithes + $payload['tithes'],
            'offering' => $incomeService->offering + $payload['offering'],
            'other_fund' => $incomeService->other_fund + $payload['other_fund'],
            'total' =>  $incomeService->total + $payload['total']
        ];

        $result = $this->repository->updateFunds($payload, $incomeService->id);

        $this->attributeValuesEqualsToExpected(['tithes', 'offering', 'other_fund', 'total'], $expectedPayload, $result);
    }

    /** @test */
    public function it_returns_null_on_updating_funds_when_income_service_does_not_exist()
    {
        $result = $this->repository->updateFunds([], self::UNKNOWN_ID);

        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_income_service_when_updating_fund_by_subtracting_field_value()
    {
        $faker = (new Faker)->create();
        $incomeService = $this->prepareIncomeService();

        $payload = [
            'tithes' => $faker->numberBetween(1, 500),
            'offering' => $faker->numberBetween(1, 500),
            'other_fund' => $faker->numberBetween(1, 500),
            'total' => $faker->numberBetween(1, 500)
        ];

        $expectedPayload = [
            'tithes' => $incomeService->tithes - $payload['tithes'],
            'offering' => $incomeService->offering - $payload['offering'],
            'other_fund' => $incomeService->other_fund - $payload['other_fund'],
            'total' =>  $incomeService->total - $payload['total']
        ];

        $result = $this->repository->deleteFunds($payload, $incomeService->id);

        $this->attributeValuesEqualsToExpected(['tithes'], $expectedPayload, $result);
    }

    /** @test */
    public function it_returns_null_on_deleting_funds_when_income_service_does_not_exist()
    {
        $result = $this->repository->deleteFunds([], self::UNKNOWN_ID);

        $this->assertNull($result);
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return IncomeService
     */
    private function prepareIncomeService($count = 1, $attributes = [])
    {
        $user = $this->createUser();
        $service = $this->createService();

        $input = array_merge(['service_id' => $service->id, 'created_by' => $user->id], $attributes);

        return $this->createIncomeService($count, $input);
    }

    /**
     * @param int $incomeServiceId
     * @return array
     */
    private function buildFundStructure($incomeServiceId)
    {
        $funds = $this->createFund(5);

        return collect($funds)->map(function($item, $key) use ($incomeServiceId){
            return [
                'income_service_id' => $incomeServiceId,
                'fund_id' => $item->id,
                'name' => $item->name,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        })->toArray();
    }

    /**
     * @return array
     */
    private function buildFundItemStructure()
    {
        $incomeService = $this->prepareIncomeService();
        $fund = $this->createFund();
        $fundItems = $this->createFundItem(5, ['fund_id' => $fund->id]);
        $fundStructure = factory(IncomeServiceFundStructure::class)->create(['income_service_id' => $incomeService->id, 'fund_id' => $fund->id]);

        return collect($fundItems)->map(function ($item, $key) use ($fundStructure) {
            return [
                'fund_structure_id' => $fundStructure->id,
                'fund_item_id' => $item->id,
                'name' => $item->name,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        })->toArray();
    }

    /**
     * @param int $incomeServiceId
     * @return array
     */

    private function buildDenominationStructure($incomeServiceId)
    {
        $denomination = $this->createDenomination(5);

        return collect($denomination)->map(function($item, $key) use ($incomeServiceId){
            return [
                'income_service_id' => $incomeServiceId,
                'denomination_id' => $item->id,
                'description' => $item->description,
                'amount' => $item->amount,
                'piece' => 0,
                'total' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        })->toArray();
    }
}
