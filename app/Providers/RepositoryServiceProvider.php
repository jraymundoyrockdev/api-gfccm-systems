<?php namespace KyokaiAccSys\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register repository IoC bindings
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'KyokaiAccSys\Repositories\Interfaces\UserRepositoryInterface',
            'KyokaiAccSys\Repositories\Eloquent\UserRepositoryEloquent'
        );
    }
}
