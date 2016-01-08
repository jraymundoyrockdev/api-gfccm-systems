<?php namespace ApiGfccm\Events;

use Illuminate\Queue\SerializesModels;

class IncomeServiceMemberFundTotalWasDeleted extends Event
{
    use SerializesModels;

    /**
     * @var
     */
    public $incomeServiceId;

    /**
     * @var
     */
    public $memberId;

    /**
     * @var
     */
    public $tithes;

    /**
     * @var
     */
    public $offering;

    /**
     * @var
     */
    public $others;

    /**
     * @var
     */
    public $total;

    /**
     * Create a new event instance.
     *
     * @param $incomeServiceId
     * @param $memberId
     * @param $tithes
     * @param $offering
     * @param $others
     * @param $total
     */
    public function __construct($incomeServiceId, $memberId, $tithes, $offering, $others, $total)
    {
        $this->incomeServiceId = $incomeServiceId;
        $this->memberId = $memberId;
        $this->tithes = $tithes;
        $this->offering = $offering;
        $this->others = $others;
        $this->total = $total;
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
