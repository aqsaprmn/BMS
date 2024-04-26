<?php

namespace App\Providers;

use App\Models\Approval\ApApproval;
use App\Models\User;
use App\Models\CsCustomer;
use App\Models\DsDisturbance;
use App\Policies\ApApprovalPolicy;
use App\Policies\CsCustomerPolicy;
use Illuminate\Support\Facades\Gate;
use App\Policies\DsDisturbancePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        CsCustomer::class => CsCustomerPolicy::class,
        DsDisturbance::class => DsDisturbancePolicy::class,
        ApApproval::class => ApApprovalPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("admin", function (User $user) {
            return $user->is_admin;
        });
    }
}
