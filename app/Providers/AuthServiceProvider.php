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
        \App\Models\Action::class  => \App\Policies\ActionPolicy::class,
        \App\Models\Comment::class => \App\Policies\CommentPolicy::class,
        \App\Models\Company::class => \App\Policies\CompanyPolicy::class,
        \App\Models\Invoice::class => \App\Policies\InvoicePolicy::class,
        \App\Models\Contact::class => \App\Policies\ContactPolicy::class,
        \App\Models\Dossier::class => \App\Policies\DossierPolicy::class,
        \App\Models\User::class    => \App\Policies\EmployeePolicy::class,
        \App\Models\File::class    => \App\Policies\FilePolicy::class,

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
