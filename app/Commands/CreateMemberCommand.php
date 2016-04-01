<?php

namespace ApiGfccm\Commands;

class CreateMemberCommand extends Command
{
    /**
     * @var
     */
    public $member;

    /**
     * Create a new command instance.
     *
     * @param $member
     */
    public function __construct($member)
    {
        $this->member = $member;
    }
}
