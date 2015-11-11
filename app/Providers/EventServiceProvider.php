<?php namespace ApiGfccm\Providers;

use ApiGfccm\Listeners\AddIncomeServiceMemberFundTotal;
use ApiGfccm\Listeners\BuildIncomeServiceDenominationStructureData;
use ApiGfccm\Listeners\BuildIncomeServiceFundItemStructureData;
use ApiGfccm\Listeners\BuildIncomeServiceFundStructureData;
use ApiGfccm\Listeners\EventListener;
use ApiGfccm\Listeners\UpdateIncomeServiceFund;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'ApiGfccm\Events\SomeEvent' => [
            EventListener::class
        ],
        'ApiGfccm\Events\IncomeServiceWasCreated' => [
            BuildIncomeServiceFundStructureData::class,
            BuildIncomeServiceFundItemStructureData::class,
            BuildIncomeServiceDenominationStructureData::class
        ],
        'ApiGfccm\Events\IncomeServiceMemberFundWasUpdated' => [
            AddIncomeServiceMemberFundTotal::class,
            UpdateIncomeServiceFund::class
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
