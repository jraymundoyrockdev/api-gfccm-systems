<?php namespace ApiGfccm\Events;

use Illuminate\Queue\SerializesModels;

class IncomeServiceWasCreated extends Event
{
    use SerializesModels;

    /**
     * @var
     */
    public $incomeServiceId;

    /**
     * Create a new event instance.
     *
     * @param int $incomeServiceId
     */
    public function __construct($incomeServiceId)
    {
        $this->incomeServiceId = $incomeServiceId;
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
