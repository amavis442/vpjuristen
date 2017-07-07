<?php
namespace App\Repositories\Providers;

use \Illuminate\Support\ServiceProvider;
use \App\Repositories\Contracts\ActionRepositoryInterface;
use \App\Repositories\Eloquent\ActionRepository;

class InvoiceRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ActionRepositoryInterface::class,
             ActionRepository::class

        );
    }

}