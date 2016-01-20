<?php namespace ApiGfccm\Handlers\Commands;

use ApiGfccm\Commands\UpdateIncomeServiceMemberFund;
use ApiGfccm\Events\IncomeServiceMemberFundWasUpdated;
use ApiGfccm\Repositories\Interfaces\IncomeServiceMemberFundRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;

class UpdateIncomeServiceMemberFundHandler
{

    /**
     * @var IncomeServiceMemberFundRepositoryInterface
     */
    protected $memberFund;

    /**
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * Create the command handler.
     *
     * @param IncomeServiceMemberFundRepositoryInterface $memberFund
     * @param Dispatcher $dispatcher
     */
    public function __construct(IncomeServiceMemberFundRepositoryInterface $memberFund, Dispatcher $dispatcher)
    {
        $this->memberFund = $memberFund;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Handle the command.
     *
     * @param  UpdateIncomeServiceMemberFund $command
     * @return void
     */
    public function handle(UpdateIncomeServiceMemberFund $command)
    {
        $this->memberFund->create($this->addCreatedAndUpdatedDates($command->memberFund));

        $incomeService = $this->dispatcher->fire(new IncomeServiceMemberFundWasUpdated($command->memberFund));

        return ['memberFundTotal' => $incomeService[0], 'fundTotal' => $incomeService[1]];
    }

    private function addCreatedAndUpdatedDates($memberFund)
    {
        return array_map(function ($structure) {
            return [
                'income_service_id' => $structure['income_service_id'],
                'member_id' => $structure['member_id'],
                'fund_id' => $structure['fund_id'],
                'fund_item_id' => $structure['fund_item_id'],
                'amount' => $structure['amount'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }, $memberFund);
    }

}
