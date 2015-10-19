<?php namespace ApiGfccm\Listeners;

use ApiGfccm\Events\IncomeServiceWasCreated;
use ApiGfccm\Repositories\Interfaces\FundItemRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;

class BuildIncomeServiceStructureData
{
    /**
     * @var FundItemRepositoryInterface
     */
    private $fundItem;

    /**
     * @var IncomeServiceRepositoryInterface
     */
    private $incomeService;

    /**
     *  Create the event listener.
     *
     * @param FundItemRepositoryInterface $fundItem
     * @param IncomeServiceRepositoryInterface $incomeService
     */
    public function __construct(FundItemRepositoryInterface $fundItem, IncomeServiceRepositoryInterface $incomeService)
    {
        $this->fundItem = $fundItem;
        $this->incomeService = $incomeService;
    }

    /**
     * Handle the event.
     *
     * @param  IncomeServiceWasCreated $event
     * @return void
     */
    public function handle(IncomeServiceWasCreated $event)
    {
        $this->incomeService->createStructuralFund($this->buildStructure($event->incomeServiceId));
    }

    /**
     * Build Structure fields
     *
     * @param $incomeServiceId
     * @return array
     */
    private function buildStructure($incomeServiceId)
    {
        return array_map(function ($structure) use ($incomeServiceId) {
            return [
                'income_service_id' => $incomeServiceId,
                'fund_id' => $structure['fund_id'],
                'fund_item_id' => $structure['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }, $this->fundItem->getActive()->toArray());
    }
}
