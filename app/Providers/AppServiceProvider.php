<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Dusk\DuskServiceProvider;
use App\Services\DossierService;
use App\Services\CompanyService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('APP_DEBUG', false)) {

            // Providers

            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);

            if ($this->app->environment('local', 'testing', 'development')) {
                $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
                $this->app->register(DuskServiceProvider::class);

                // Aliases
                $this->app->alias('Debugbar', 'Barryvdh\Debugbar\Facade');
            }


        }

        // Services (not Providers)
        $this->app->bind('DossierService', function ($app) {
            return new DossierService();
        });

        $this->app->bind('CompanyService', function ($app) {
            return new CompanyService();
        });
    }
}
