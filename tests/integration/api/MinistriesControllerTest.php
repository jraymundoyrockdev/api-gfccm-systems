<?php

use ApiGfccm\Models\Ministry;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class MinistriesControllerTest extends ApiTestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration, MinistryTestHelper;

    /** @test */
    public function it_returns_a_collection_of_ministries()
    {
        $this->createMinistry(5);

        $this->get('api/ministries');

        $result = $this->getContent('Ministries');

        $this->assertEquals(5, count($result));
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_an_empty_collection_when_services_does_not_exist()
    {
        $this->get('api/ministries');

        $result = $this->getContent('Ministries');

        $this->assertEmpty($result);
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_a_ministry_on_create()
    {
        $input = factory(Ministry::class)->make();

        $this->post('api/ministries', $input->toArray());

        $result = $this->getFirstKey($this->getContent('Ministry'));

        $this->attributeValuesEqualsToExpected([
            'name',
            'description'
        ], $input, $result);

        $this->assertResponseOk();
    }

    /**
     * @test
     * @dataProvider invalidCreateMinistryInput
     */
    public function it_rejects_create_when_payload_is_invalid($payload)
    {
        $this->post('api/ministries', $payload, ['accept' => 'application/json']);

        $this->assertResponseStatus(422);
    }

    /** @test */
    public function it_returns_a_ministry_if_ministry_exist()
    {
        $ministry = $this->createMinistry();

        $this->get('api/ministries/' . $ministry->id);

        $result = $this->getFirstKey($this->getContent('Ministry'));

        $this->assertEquals($ministry->id, $result->id);
        $this->assertResponseOk();

    }

    /** @test */
    public function it_returns_error_if_ministry_does_not_exist()
    {
        $this->get('api/ministries/unknownId');

        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_returns_a_ministry_on_update()
    {
        $ministry = $this->createMinistry();
        $payloadForUpdate = factory(Ministry::class)->make();

        $this->put('api/ministries/' . $ministry->id, $payloadForUpdate->toArray());

        $result = $this->getFirstKey($this->getContent('Ministry'));

        $this->assertEquals($ministry->id, $result->id);
        $this->assertEquals($payloadForUpdate->description, $result->description);
        $this->assertResponseOk();
    }

    /** @test */
    public function it_rejects_update_if_payload_is_invalid()
    {
        $payload = ['name' => 'duplicateName'];

        $ministry = factory(Ministry::class)->create($payload);

        $this->put('api/ministries/' . $ministry->id, $payload, ['accept' => 'application/json']);

        $this->assertResponseStatus(422);
    }

    /** @test */
    public function it_rejects_update_if_ministry_does_not_exist()
    {
        $ministry = factory(Ministry::class)->make();

        $this->put('api/ministries/unknownId', $ministry->toArray());

        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_returns_services_as_list()
    {
        $this->createMinistry(5);

        $this->get('api/ministries/list');

        $result = $this->getContent();

        $this->assertEquals(5, count((array) $result));
        $this->assertResponseOk();
    }
}