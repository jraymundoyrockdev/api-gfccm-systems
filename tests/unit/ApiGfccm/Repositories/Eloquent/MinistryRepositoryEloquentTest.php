<?php

use ApiGfccm\Models\Ministry;
use ApiGfccm\Repositories\Eloquent\MinistryRepositoryEloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MinistryRepositoryEloquentTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, DenominationTestsHelper, MinistryTestHelper;

    protected $repository;

    public function setUp()
    {
        parent::setUp();

        $this->repository = $this->app->make(MinistryRepositoryEloquent::class);
    }

    /** @test */
    public function it_return_ministries()
    {
        $this->createMinistry(5);

        $result = $this->repository->all();

        $this->assertEquals(5, count($result));
        $this->assertInstanceOf(Ministry::class, $result[0]);
    }

    /** @test */
    public function it_returns_empty_when_there_is_no_ministry_that_exists()
    {
        $result = $this->repository->all();

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_returns_a_ministry_when_find_by_id()
    {
        $ministry = $this->createMinistry(1);

        $result = $this->repository->findById($ministry->id);

        $this->attributeValuesEqualsToExpected(['id', 'name','description', 'updated_at','created_at'],$ministry, $result);
        $this->assertInstanceOf(Ministry::class, $result);
    }

    /** @test */
    public function it_returns_null_when_Ministry_does_not_exist()
    {
        $result = $this->repository->findById('unknownId');

        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_ministry_after_create()
    {
        $input = factory(Ministry::class)->make();

        $result = $this->repository->create($input->toArray());

        $this->assertInstanceOf(Ministry::class, $result);
        $this->attributeValuesEqualsToExpected(['name', 'description'], $input, $result);

    }

    /** @test */
    public function it_returns_ministry_after_update()
    {
        $ministry = $this->createMinistry(1);

        $editedInput = factory(Ministry::class)->make();

        $result = $this->repository->update($ministry->id, $editedInput->toArray());

        $this->assertInstanceOf(Ministry::class, $result);
        $this->attributeValuesEqualsToExpected(['name', 'description'], $editedInput, $result);
        $this->assertEquals($result->id, $ministry->id);

    }

    /** @test */
    public function it_returns_null_on_update_when_ministry_does_not_exist()
    {
        $result = $this->repository->update('unknownId', []);

        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_a_collection_of_ministry_as_list()
    {
        $ministry = $this->createMinistry(5);

        $result = $this->repository->getAllAsList('name', 'id');

        $this->assertEquals(5, count($result));
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertTrue(array_key_exists($ministry[0]->id, $result->toArray()));
        $this->assertTrue(in_array($ministry[0]->name, $result->toArray()));
    }

}
