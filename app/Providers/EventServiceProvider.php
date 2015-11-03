<?php

namespace ApiGfccm\Providers;

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
            'ApiGfccm\Listeners\EventListener',
        ],
        'ApiGfccm\Events\IncomeServiceWasCreated'=>[
            'ApiGfccm\Listeners\BuildIncomeServiceStructureData',
            'ApiGfccm\Listeners\BuildIncomeServiceDenominationStructureData'
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
