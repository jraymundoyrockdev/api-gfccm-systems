<?php

namespace ApiGfccm\Handlers\Commands;

use ApiGfccm\Commands\CreateMemberCommand;
use ApiGfccm\Events\MemberWasCreated;
use ApiGfccm\Repositories\Interfaces\MemberRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;

class CreateMemberCommandHandler
{
    /**
     * @var MemberRepositoryInterface
     */
    private $member;
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * Create the command handler.
     *
     * @param MemberRepositoryInterface $member
     * @param Dispatcher $dispatcher
     */
    public function __construct(MemberRepositoryInterface $member, Dispatcher $dispatcher)
    {
        $this->member = $member;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Handle the command.
     *
     * @param  CreateMemberCommand $command
     * @return void
     */
    public function handle(CreateMemberCommand $command)
    {
        $member = $this->member->create($command->member);

        if ($member) {
            $this->dispatcher->fire(new MemberWasCreated($member->id, $member->firstname, $member->lastname));
        }

        return $member;
    }
}
