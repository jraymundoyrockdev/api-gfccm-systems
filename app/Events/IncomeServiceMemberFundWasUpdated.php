<?php namespace ApiGfccm\Events;

use Illuminate\Queue\SerializesModels;

class IncomeServiceMemberFundWasUpdated extends Event
{
    use SerializesModels;

    /**
     * @var int
     */
    public $funds;

    /**
     * @var int
     */
    public $incomeServiceId;

    /**
     * @var int
     */
    public $memberId;

    /**
     * @var int
     */
    public $tithes = 0;

    /**
     * @var int
     */
    public $offering = 0;

    /**
     * @var int
     */
    public $others = 0;

    /**
     * @var int
     */
    public $total = 0;

    /**
     * Create a new event instance.
     *
     * @param array $funds
     */
    public function __construct($funds = [])
    {
        $this->getIncomeServiceAndMemberId($funds);
        $this->getFundAmounts($funds);
        $this->getTotal();
    }

    /**
     * @param array $funds
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
     * @param array $funds
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
     * @param int $fundItemId
     * @param int $amount
     *
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
                $this->others += $amount;
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
