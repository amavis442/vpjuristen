<?php

namespace App\Providers;

use App\Policies\EmployeePolicy;
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
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Action' => 'App\Policies\ActionPolicy',
        'App\Comment' => 'App\Policies\CommentPolicy',
        'App\Company' => 'App\Policies\CompanyPolicy',
        'App\Invoice' => 'App\Policies\InvoicePolicy',
        'App\Contact' => 'App\Policies\ContactPolicy',
        'App\Dossier' => 'App\Policies\DossierPolicy',
        'App\User' => 'App\Policies\UserPolicy',
        //User::class => EmployeePolicy::class,
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
            return $user->hasRole('admin');
        });

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
