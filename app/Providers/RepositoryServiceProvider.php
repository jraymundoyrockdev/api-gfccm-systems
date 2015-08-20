<?php namespace ApiGfccm\Providers;

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
            'ApiGfccm\Repositories\Interfaces\UserRepositoryInterface',
            'ApiGfccm\Repositories\Eloquent\UserRepositoryEloquent'
        );
    }
}
