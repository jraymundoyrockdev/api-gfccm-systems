<?php

use ApiGfccm\Models\Service;
use ApiGfccm\Repositories\Eloquent\ServiceRepositoryEloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServiceRepositoryEloquentTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, DenominationTestsHelper, ServiceTestHelper;

    protected $repository;

    public function setUp()
    {
        parent::setUp();

        $this->repository = $this->app->make(ServiceRepositoryEloquent::class);
    }

    /** @test */
    public function it_return_services()
    {
        $this->createService(5);

        $result = $this->repository->all();

        $this->assertEquals(5, count($result));
        $this->assertInstanceOf(Service::class, $result[0]);
    }

    /** @test */
    public function it_returns_empty_when_there_is_no_service_that_exists()
    {
        $result = $this->repository->all();

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_returns_a_service_when_find_by_id()
    {
        $service = $this->createService(1);

        $result = $this->repository->findById($service->id);

        $this->attributeValuesEqualsToExpected(['id', 'name', 'start_time','end_time','description', 'updated_at','created_at'],$service, $result);
        $this->assertInstanceOf(Service::class, $result);
    }

    /** @test */
    public function it_returns_null_when_service_does_not_exist()
    {
        $result = $this->repository->findById('unknownId');

        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_service_after_create()
    {
        $input = factory(Service::class)->make();

        $result = $this->repository->create($input->toArray());

        $this->assertInstanceOf(Service::class, $result);
        $this->attributeValuesEqualsToExpected(['name', 'start_time', 'end_time', 'description'], $input, $result);

    }

    /** @test */
    public function it_returns_service_after_update()
    {
        $service = $this->createService(1);

        $editedInput = factory(Service::class)->make();

        $result = $this->repository->update($service->id, $editedInput->toArray());

        $this->assertInstanceOf(Service::class, $result);
        $this->attributeValuesEqualsToExpected(['name', 'start_time', 'end_time', 'description'], $editedInput, $result);
        $this->assertEquals($result->id, $service->id);

    }

    /** @test */
    public function it_returns_null_on_update_when_service_does_not_exist()
    {
        $result = $this->repository->update('unknownId', []);

        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_a_collection_services_as_list()
    {
        $service = $this->createService(5);

        $result = $this->repository->getAllAsList('name', 'id');

        $this->assertEquals(5, count($result));
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertTrue(array_key_exists($service[0]->id, $result->toArray()));
        $this->assertTrue(in_array($service[0]->name, $result->toArray()));
    }

}
