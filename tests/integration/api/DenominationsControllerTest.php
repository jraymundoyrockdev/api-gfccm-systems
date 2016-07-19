<?php

use ApiGfccm\Models\Denomination;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class DenominationsControllerTest extends ApiTestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration, DenominationTestsHelper;

    /** @test */
    public function it_returns_denomination_when_denomination_is_created()
    {
        $input = factory(Denomination::class)->make();

        $this->post('api/denominations', $input->toArray());

        $result = $this->getFirstKey($this->getContent('Denomination'));

        $this->attributeValuesEqualsToExpected(['amount', 'description'], $input, $result);
        $this->assertResponseOk();
    }

    /**
     * @test
     * @dataProvider invalidCreateDenominationInput
     */
    public function it_rejects_creation_request_if_the_payload_is_invalid($payload)
    {
        $this->post('api/denominations', $payload, ['accept' => 'application/json']);

        $this->assertResponseStatus(422);
    }

    /** @test */
    public function it_returns_denomination_when_denomination_is_updated()
    {
        $denomination = $this->createDenomination();

        $faker = (new Faker)->create();

        $input = ['amount' => $faker->numberBetween(1, 10000), 'description' => $faker->sentence];

        $this->put('api/denominations/' . $denomination->id, $input);

        $result = $this->getFirstKey($this->getContent('Denomination'));

        $this->attributeValuesEqualsToExpected(['amount', 'description'], $input, $result);
    }

    /** @test */
    public function it_rejects_update_when_input_is_invalid()
    {
        $denomination = $this->createDenomination();

        $input = factory(Denomination::class)->make(['amount' => '']);

        $this->put('api/denominations/' . $denomination->id, $input->toArray(),
            ['accept' => 'application/json']);

        $this->assertResponseStatus(422);
    }

    /** @test */
    public function it_rejects_update_when_denomination_does_not_exists()
    {
        $faker = (new Faker)->create();

        $input = ['amount' => $faker->numberBetween(1, 10000), 'description' => $faker->sentence];

        $this->put('api/denominations/0', $input);

        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_returns_empty_when_no_denomination_is_empty()
    {
        $this->get('api/denominations');

        $this->assertEmpty($this->getContent('Denominations'));
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_denominations()
    {
        $this->createDenomination(5);

        $this->get('api/denominations');

        $this->assertEquals(5, count($this->getContent('Denominations')));
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_a_denomination_when_searched_by_id()
    {
        $denomination = $this->createDenomination();

        $this->get('api/denominations/' . $denomination->id);

        $result = $this->getFirstKey($this->getContent('Denomination'));

        $this->attributeValuesEqualsToExpected(['id', 'amount', 'description'], $denomination, $result);
        $this->assertObjectHasOnlyAttributes(['id', 'amount', 'description'], $result);
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_an_invalid_response_when_denomination_does_not_exists()
    {
        $this->get('api/denominations/0');

        $this->assertResponseStatus(404);
    }

}