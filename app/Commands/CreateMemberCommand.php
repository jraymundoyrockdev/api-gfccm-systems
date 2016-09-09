<?php

namespace ApiGfccm\Commands;

class CreateMemberCommand extends Command
{
    /**
     * @var
     */
    public $memberInput;

    /**
     * Create a new command instance.
     *
     * @param $input
     */
    public function __construct(array $input)
    {
        $this->memberInput = $input;
    }
}
