<?php namespace ApiGfccm\Providers;

use ApiGfccm\Listeners\BuildIncomeServiceDenominationStructureData;
use ApiGfccm\Listeners\BuildIncomeServiceFundItemStructureData;
use ApiGfccm\Listeners\BuildIncomeServiceFundStructureData;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use ApiGfccm\Listeners\EventListener;

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
