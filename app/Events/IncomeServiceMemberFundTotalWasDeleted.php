<?php namespace ApiGfccm\Events;

use Illuminate\Queue\SerializesModels;

class IncomeServiceMemberFundTotalWasDeleted extends Event
{
    use SerializesModels;

    /**
     * @var integer
     */
    public $incomeServiceId;

    /**
     * @var integer
     */
    public $memberId;

    /**
     * @var integer
     */
    public $tithes;

    /**
     * @var integer
     */
    public $offering;

    /**
     * @var integer
     */
    public $others;

    /**
     * @var integer
     */
    public $total;

    /**
     * Create a new event instance.
     *
     * @param integer $incomeServiceId
     * @param integer $memberId
     * @param integer $tithes
     * @param integer $offering
     * @param integer $others
     * @param integer $total
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
}
