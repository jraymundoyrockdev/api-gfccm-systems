<?php

namespace ApiGfccm\Events;

use Illuminate\Queue\SerializesModels;

class MemberWasCreated extends Event
{
    use SerializesModels;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * MemberWasCreated constructor.
     *
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct($id, $firstName, $lastName)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}
