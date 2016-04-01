<?php

namespace ApiGfccm\Events;

use Illuminate\Queue\SerializesModels;

class MemberWasCreated extends Event
{
    use SerializesModels;

    public $id;

    public $firstName;

    public $lastName;

    /**
     * Create a new event instance.
     *
     * MemberWasCreated constructor.
     * @param $id
     * @param $firstName
     * @param $lastName
     */
    public function __construct($id, $firstName, $lastName)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
