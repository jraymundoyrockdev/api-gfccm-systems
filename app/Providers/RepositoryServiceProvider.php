<?php namespace ApiGfccm\Providers;

use Illuminate\Support\ServiceProvider;
use ApiGfccm\Repositories\Interfaces\UserRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\UserRepositoryEloquent;
use ApiGfccm\Repositories\Interfaces\RoleRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\RoleRepositoryEloquent;
use ApiGfccm\Repositories\Interfaces\MinistryRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\MinistryRepositoryEloquent;
use ApiGfccm\Repositories\Interfaces\DenominationRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\DenominationRepositoryEloquent;
use ApiGfccm\Repositories\Interfaces\ServiceRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\ServiceRepositoryEloquent;
use ApiGfccm\Repositories\Interfaces\MemberRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\MemberRepositoryEloquent;
use ApiGfccm\Repositories\Interfaces\FundRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\FundRepositoryEloquent;
use ApiGfccm\Repositories\Interfaces\FundItemRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\FundItemRepositoryEloquent;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register repository IoC bindings
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryEloquent::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepositoryEloquent::class);
        $this->app->bind(MinistryRepositoryInterface::class, MinistryRepositoryEloquent::class);
        $this->app->bind(DenominationRepositoryInterface::class, DenominationRepositoryEloquent::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepositoryEloquent::class);
        $this->app->bind(MemberRepositoryInterface::class, MemberRepositoryEloquent::class);
        $this->app->bind(FundRepositoryInterface::class, FundRepositoryEloquent::class);
        $this->app->bind(FundItemRepositoryInterface::class, FundItemRepositoryEloquent::class);
    }
}