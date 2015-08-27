<?php namespace ApiGfccm\Providers;

use Illuminate\Support\ServiceProvider;
use ApiGfccm\Repositories\Interfaces\UserRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\UserRepositoryEloquent;
use ApiGfccm\Repositories\Interfaces\UserRoleRepositoryInterface;
use ApiGfccm\Repositories\Eloquent\UserRoleRepositoryEloquent;

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
    }
}
