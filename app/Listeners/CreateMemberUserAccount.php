<?php

namespace ApiGfccm\Listeners;

use ApiGfccm\Events\MemberWasCreated;
use ApiGfccm\Repositories\Interfaces\UserRepositoryInterface;

class CreateMemberUserAccount
{
    /**
     * @var UserRepositoryInterface
     */
    private $user;

    /**
     * Create the event listener.
     *
     * @param UserRepositoryInterface $user
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  MemberWasCreated $event
     * @return void
     */
    public function handle(MemberWasCreated $event)
    {
        $userName = $this->buildUsername($event->firstName, $event->lastName);

        if ($this->user->getByUsername($userName)) {
            $userName = $this->reCreateUsername($userName);
        }

        $password = $this->buildPassword($userName);

        return $this->user->create($event->id, $userName, $password);
    }

    /**
     * @param $firstName
     * @param $lastName
     * @return mixed
     */
    private function buildUsername($firstName, $lastName)
    {
        return str_replace(' ', '', strtolower($firstName . $lastName));
    }

    /**
     * @param $userName
     * @return mixed
     */
    private function buildPassword($userName)
    {
        return bcrypt(strtolower($userName . 'abc123'));
    }

    /**
     * @param $userName
     * @return string
     */
    private function reCreateUsername($userName)
    {
        return $userName . '_' . str_random(3);
    }

}
