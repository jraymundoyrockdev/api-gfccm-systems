<?php namespace ApiGfccm\Providers;

use Illuminate\Support\ServiceProvider;
use ApiGfccm\Repositories\Interfaces\UserRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\UserRepositoryEloquent;
use ApiGfccm\Repositories\Interfaces\UserRoleRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\UserRoleRepositoryEloquent;
use ApiGfccm\Repositories\Interfaces\MinistryRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\MinistryRepositoryEloquent;
use ApiGfccm\Repositories\Interfaces\DenominationRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\DenominationRepositoryEloquent;
use ApiGfccm\Repositories\Interfaces\ServiceRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\ServiceRepositoryEloquent;

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
        $this->app->bind(UserRoleRepositoryInterface::class, UserRoleRepositoryEloquent::class);
        $this->app->bind(MinistryRepositoryInterface::class, MinistryRepositoryEloquent::class);
        $this->app->bind(DenominationRepositoryInterface::class, DenominationRepositoryEloquent::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepositoryEloquent::class);
    }
}
