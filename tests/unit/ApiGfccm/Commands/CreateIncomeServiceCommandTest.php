<?php

use ApiGfccm\Commands\CreateIncomeServiceCommand;

class CreateIncomeServiceCommandTest extends TestCase
{
    /** @test */
    public function it_instantiates_a_new_command()
    {
        $command = new CreateIncomeServiceCommand(1, date('Y-m-d'), 1, 'active');

        $this->assertInstanceOf(CreateIncomeServiceCommand::class, $command);

        $this->assertEquals($command->serviceId, 1);
        $this->assertEquals($command->serviceDate, date('Y-m-d'));
        $this->assertEquals($command->userId, 1);
        $this->assertEquals($command->status, 'active');
    }
}