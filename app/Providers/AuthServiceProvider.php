<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // dd(auth()->guard());

        // Implicitly grant "Super-Admin" role all permission checks using can()
        Gate::before(function ($user, $ability) {

            if ($user->hasRole(['Portal Admin', 'Company Admin', 'Client Admin'])) {
                return true;
            }

            /* if(auth()->guard('portal_user')->check()) {
                return $user->full_name == 'Mini';
            }
            if(auth()->guard('company_user')->check()) {
                dd($user);
            }
            if(auth()->guard('client_user')->check()) {
                dd($user);
            }
            dd($ability); */
        });
    }
}
