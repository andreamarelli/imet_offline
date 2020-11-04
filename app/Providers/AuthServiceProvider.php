<?php

namespace App\Providers;

use App\Policies\StaffPolicy;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\Person\Person::class => \App\Policies\StaffPolicy::class,
        \App\Models\NationalIndicators\N1::class => \App\Policies\NationalIndicators\N1Policy::class,
        \App\Models\NationalIndicators\N2::class => \App\Policies\NationalIndicators\N2Policy::class,
        \App\Models\NationalIndicators\N3::class => \App\Policies\NationalIndicators\N3Policy::class,
        \App\Models\NationalIndicators\N4::class => \App\Policies\NationalIndicators\N4Policy::class,
        \App\Models\NationalIndicators\N5::class => \App\Policies\NationalIndicators\N5Policy::class,
        \App\Models\RegionalIndicators\RegionalIndicators::class => \App\Policies\RegionalIndicatorsPolicy::class,
        \App\Models\ConcessionIndicators\ConcessionIndicators::class => \App\Policies\ConcessionIndicatorsPolicy::class,
        \App\Models\Imet\Imet::class => \App\Policies\ImetPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Aliases to policies
        Gate::define('manage-staff', function ($user) { return $user->can('viewAny', \App\Models\Person\Person::class); });

        // Non model-related actions reserved to administrators
        Gate::define('manage-logs', function ($user) { return User::isAdmin($user); });


    }
}
