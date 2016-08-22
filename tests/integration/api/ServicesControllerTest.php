<?php

use ApiGfccm\Models\Service;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class ServicesControllerTest extends ApiTestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration, ServiceTestHelper;

    /** @test */
    public function it_returns_a_collection_services()
    {
        $this->createService(5);

        $this->get('api/services');

        $result = $this->getContent('Services');

        $this->assertEquals(5, count($result));
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_an_empty_collection_when_services_does_not_exist()
    {
        $this->get('api/services');

        $result = $this->getContent('Services');

        $this->assertEmpty($result);
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_a_service_on_create()
    {
        $input = factory(Service::class)->make();

        $this->post('api/services', $input->toArray());

        $result = $this->getFirstKey($this->getContent('Service'));

        $this->attributeValuesEqualsToExpected([
            'name',
            'start_time',
            'end_time',
            'description'
        ], $input, $result);

        $this->assertResponseOk();
    }

    /**
     * @test
     * @dataProvider invalidCreateServiceInput
     */
    public function it_rejects_create_when_payload_is_invalid($payload)
    {
        $this->post('api/services', $payload, ['accept' => 'application/json']);

        $this->assertResponseStatus(422);
    }

    /** @test */
    public function it_returns_a_service_if_service_exist()
    {
        $service = $this->createService();

        $this->get('api/services/' . $service->id);

        $result = $this->getFirstKey($this->getContent('Service'));

        $this->assertEquals($service->id, $result->id);
        $this->assertResponseOk();

    }

    /** @test */
    public function it_returns_error_if_service_does_not_exist()
    {
        $this->get('api/services/unknownId');

        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_returns_a_service_on_update()
    {
        $service = $this->createService();
        $payloadForUpdate = factory(Service::class)->make();

        $this->put('api/services/' . $service->id, $payloadForUpdate->toArray());

        $result = $this->getFirstKey($this->getContent('Service'));

        $this->assertEquals($service->id, $result->id);
        $this->assertEquals($payloadForUpdate->description, $result->description);
        $this->assertResponseOk();
    }

    /** @test */
    public function it_rejects_update_if_payload_is_invalid()
    {
        $payload = ['name' => 'duplicateName'];

        $service = factory(Service::class)->create($payload);

        $this->put('api/services/' . $service->id, $payload, ['accept' => 'application/json']);

        $this->assertResponseStatus(422);
    }

    /** @test */
    public function it_rejects_update_if_service_does_not_exist()
    {
        $service = factory(Service::class)->make();

        $this->put('api/services/unknownId', $service->toArray());

        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_returns_services_as_list()
    {
        $this->createService(5);

        $this->get('api/services/list');

        $result = $this->getContent();

        $this->assertEquals(5, count((array) $result));
        $this->assertResponseOk();
    }
}