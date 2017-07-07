<?php
namespace App\Repositories\Providers;

use \Illuminate\Support\ServiceProvider;
use \App\Repositories\Contracts\DossierRepositoryInterface;
use \App\Repositories\Eloquent\DossierRepository;

class DossierRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            DossierRepositoryInterface::class,
             DossierRepository::class

        );
    }

}