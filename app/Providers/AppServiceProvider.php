<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
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
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');

            // Aliases
            $this->app->alias('Debugbar', 'Barryvdh\Debugbar\Facade');
            
        }
    }
}
