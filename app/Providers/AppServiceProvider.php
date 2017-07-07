<?php

namespace App\Providers;

use App\Domain\Contract\CompanyRepositoryInterface;
use App\Domain\Contract\DossierRepositoryInterface;
use App\Domain\Repository\CompanyRepository;
use App\Domain\Repository\DossierRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);

            // Aliases
            $this->app->alias('Debugbar', 'Barryvdh\Debugbar\Facade');
        }

    }
}
