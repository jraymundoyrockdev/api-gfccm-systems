<?php

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use ApiGfccm\Repositories\Interfaces\FundRepositoryInterface;
use ApiGfccm\Models\Fund;

class FundsControllerTest extends ApiTestCase
{
    use MockeryPHPUnitIntegration;

    /** @test */
    public function it_responds_with_empty_collection_if_index_called_with_no_funds()
    {

        /*        $users = factory(User::class, 0)->make();
                $this->makeRepositoryStub('all', $users);
                $this->visit('/api/users')
                    ->seeJson([
                        'Users' => []
                    ]);
        */
        $fund = factory(Fund::class, 0)->make();

        $repository = Mockery::mock(FundRepositoryInterface::class)
            ->shouldReceive('all')
            ->andReturn($fund)
            ->getMock();

        $this->app->instance(FundRepositoryInterface::class, $repository);

        $this->visit('/api/funds')
            ->seeJson([
                'Funds' => []
            ]);


    }

    public function it_responds_with_empty_collection_if_index_called_with_no_users()
    {
        $users = factory(User::class, 0)->make();

        $this->makeRepositoryStub('all', $users);

        $this->visit('/api/users')
            ->seeJson([
                'Users' => []
            ]);
    }


    /*    private function makeRepositoryStub($shouldReceive, $andReturn)
        {
            $stub = Mockery::mock(UserRepositoryInterface::class)
                ->shouldReceive($shouldReceive)
                ->andReturn($andReturn)
                ->getMock();
            $this->app->instance(UserRepositoryInterface::class, $stub);
        }*/
}
