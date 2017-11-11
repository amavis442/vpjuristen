<?php

namespace App\Providers;

use App\Policies\EmployeePolicy;
use App\Models\User;
use App\Policies\InvoicePolicy;
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
        'App\Models\Model'         => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-employees', function ($user) {
            return $user->isAdmin() || $user->isManager();
        });

        Gate::define('search', function ($user) {
            return $user->isAdmin() || $user->isEmployee() || $user->isManager();
        });

        Gate::define('download','App\Policies\InvoicePolicy@download');

        /*Gate::define('see-comment', function ($user, $comment) {
            if ($user->id == $comment->user_id) {
                return true;
            }
        });

        Gate::define('see-action', function ($user, $action) {
            if ($user->id == $action->user_id) {
                return true;
            }
        });*/
    }
}
