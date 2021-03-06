<?php namespace ApiGfccm\Providers;

use ApiGfccm\Models\IncomeService;
use ApiGfccm\Models\IncomeServiceMemberFund;
use ApiGfccm\Models\MinistryTransaction;
use ApiGfccm\Policies\IncomeServicePolicy;
use ApiGfccm\Policies\MinistryTransactionPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        IncomeService::class => IncomeServicePolicy::class,
        IncomeServiceMemberFund::class => IncomeServicePolicy::class,
        MinistryTransaction::class => MinistryTransactionPolicy::class
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
    }
}