<?php

use ApiGfccm\Commands\CreateIncomeServiceCommand;
use ApiGfccm\Handlers\Commands\CreateIncomeServiceCommandHandler;
use ApiGfccm\Models\IncomeService;
use ApiGfccm\Repositories\Eloquent\IncomeServiceRepositoryEloquent;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateIncomeServiceCommandHandlerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @test
     */
    public function it_handles_the_command()
    {
        $incomeServiceRepository = $this->app->make(IncomeServiceRepositoryEloquent::class);
        $dispatcher = $this->app->make(Dispatcher::class);

        $command = new CreateIncomeServiceCommand(1, date('Y-m-d'), 2, 'active');
        $handler = new CreateIncomeServiceCommandHandler($incomeServiceRepository, $dispatcher);

        $result = $handler->handle($command);

        $this->assertInstanceOf(IncomeService::class, $result);
        $this->seeInDatabase('income_services', [
            'service_date' => date('Y-m-d'),
            'status' => 'active',
            'service_id' => 1
        ]);
    }
}