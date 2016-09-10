<?php namespace ApiGfccm\Listeners;

use ApiGfccm\Events\IncomeServiceWasCreated;
use ApiGfccm\Repositories\Interfaces\FundRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;

class BuildIncomeServiceFundItemStructureData
{
    /**
     * @var FundRepositoryInterface
     */
    private $fund;

    /**
     * @var IncomeServiceRepositoryInterface
     */
    private $incomeService;

    /**
     *  Create the event listener.
     *
     * @param FundRepositoryInterface $fund
     * @param IncomeServiceRepositoryInterface $incomeService
     */
    public function __construct(FundRepositoryInterface $fund, IncomeServiceRepositoryInterface $incomeService)
    {
        $this->fund = $fund;
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
        $incomeService = $this->incomeService->findById($event->incomeServiceId);

        foreach ($incomeService->fund_structures as $fundStructure) {
            $this->incomeService->createFundItemStructure(
                $this->buildStructure(
                    $event->incomeServiceId,
                    $fundStructure->id,
                    $this->getActive($fundStructure->item->toArray())));
        }
    }

    /**
     * Build Structure fields
     *
     * @param $incomeServiceId
     * @param $fundStructureId
     * @param array $fundItems
     * @return array
     */
    private function buildStructure($incomeServiceId, $fundStructureId, Array $fundItems = [])
    {
        return array_map(function ($structure) use ($incomeServiceId, $fundStructureId) {
            return [
                'fund_structure_id' => $fundStructureId,
                'fund_item_id' => $structure['id'],
                'name' => $structure['name'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }, $fundItems);
    }

    /**
     * Filter all actie fund Items only
     *
     * @param $items
     * @return array
     */
    private function getActive($items)
    {
        return (array_filter($items, function ($items) {
            return $items['status'] == 'active';
        }));
    }
}
