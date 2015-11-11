<?php namespace ApiGfccm\Events;

use Illuminate\Queue\SerializesModels;

class IncomeServiceMemberFundWasUpdated extends Event
{
    use SerializesModels;

    public $funds;

    public $incomeServiceId;

    public $memberId;

    public $tithes = 0;

    public $offering = 0;

    public $others = 0;

    public $total = 0;

    /**
     * Create a new event instance.
     *
     * @param array $funds
     */
    public function __construct(Array $funds = [])
    {
        $this->getIncomeServiceAndMemberId($funds);
        $this->getFundAmounts($funds);
        $this->getTotal();
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

    /**
     * @param $funds
     */
    private function getIncomeServiceAndMemberId($funds)
    {
        $funds = array_shift($funds);
        $this->memberId = $funds['member_id'];
        $this->incomeServiceId = $funds['income_service_id'];
    }

    /**
     * Get Fund Amounts
     *
     * @param $funds
     */
    private function getFundAmounts($funds)
    {
        foreach ($funds as $fund) {
            $this->computeAmounts($fund['fund_item_id'], $fund['amount']);
        }
    }

    /**
     * Compute Amounts
     *
     * @param $fundItemId
     * @param $amount
     * @return bool
     */
    private function computeAmounts($fundItemId, $amount)
    {
        switch ($fundItemId) {
            case 1: {
                $this->tithes = $amount;
                break;
            }
            case 2: {
                $this->offering = $amount;
                break;
            }
            default: {
                $this->others+= $amount;
                break;
            }
        }

        return true;
    }

    private function getTotal()
    {
        $this->total = $this->tithes + $this->offering + $this->others;
    }
}
