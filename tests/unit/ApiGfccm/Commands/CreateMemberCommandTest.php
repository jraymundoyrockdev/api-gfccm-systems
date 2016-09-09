<?php

use ApiGfccm\Commands\CreateMemberCommand;
use ApiGfccm\Models\Member;

class CreateMemberCommandTest extends TestCase
{
    /** @test */
    public function it_instantiates_a_new_command()
    {
        $input = factory(Member::class)->make();

        $command = new CreateMemberCommand($input->toArray());

        $this->assertInstanceOf(CreateMemberCommand::class, $command);

        $this->assertEquals($command->memberInput, $input->toArray());
    }
}