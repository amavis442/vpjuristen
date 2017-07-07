<?php

namespace App\Providers;

use App\Policies\EmployeePolicy;
use App\Models\User;
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
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Action' => 'App\Policies\ActionPolicy',
        'App\Models\Comment' => 'App\Policies\CommentPolicy',
        'App\Models\Company' => 'App\Policies\CompanyPolicy',
        'App\Models\Invoice' => 'App\Policies\InvoicePolicy',
        'App\Models\Contact' => 'App\Policies\ContactPolicy',
        'App\Models\Dossier' => 'App\Policies\DossierPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\File' => 'App\Policies\FilePolicy',

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

        Gate::define('search', function ($user) {
            return $user->hasRole('admin') || $user->hasRole('employee');
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
